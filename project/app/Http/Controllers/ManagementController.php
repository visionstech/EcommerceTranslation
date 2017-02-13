<?php namespace App\Http\Controllers;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Input;
use App\User;
use App\Section;
use App\Order;
use App\Project;
use App\Language;
use App\ProjectFile;
use App\ProjectGlossary;
use App\ProjectStyle;
use App\ProjectBrief;
use App\TranslationCorrection;
use App\ProjectFeedback;
use Illuminate\Contracts\Auth\Guard;
use Session;
use Auth;
use DB;
use File;

class ManagementController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Customer Controller
    |--------------------------------------------------------------------------
    |
    | This controller manages user's profile.
    |
    */
    /**
     * Create a new dashboard controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->middleware('auth', ['except' => 'getSocialRedirect','getSocialCallback']);
        $this->auth = $auth;
    }

    /**
      * get all projects.
      * @param null       
      * @return Response
      * Created on: 13/02/2017
      * Updated on: 13/02/2017
    **/

    public function getAllProjects()
    {
      try {
          if(Auth::user()->role_id==1){
            $orders=Order::join('users','users.id','=','orders.user_id')->select('users.email as useremail','orders.*')->get();  
          }
          $allProjects=array();
          if(count($orders)){
            foreach($orders as $key=>$order){

                $allProjects[$key]['order_id']=$order->id;
                $allProjects[$key]['useremail']=$order->useremail;
                $allProjects[$key]['orderDate']=$order->created_at;
                //Get all Projects per order wise
                $projects=Project::join('languages','languages.id','=','projects.to_lang_id')
                    ->select('projects.*','languages.name as destinationLanguage')
                    ->where('projects.order_id',$order->id)->get();
                
                if(count($projects)){
                    $fromLang=$projects[0]->from_lang_id;
                    $allProjects[$key]['languagePackage']=$projects[0]->language_package;
                    $allProjects[$key]['languagePurpose']=$projects[0]->translation_purpose;
                    $sourceLang=Language::where('id',$fromLang)->first();
                    $sourceLang=($sourceLang!=null)?$sourceLang->name:'';
                    $allProjects[$key]['sourceLang']=$sourceLang;
                    $allProjects[$key]['finalPrice']=$projects[0]->final_price;
                    $toLangs=array();
                    foreach($projects as $pkey=>$projects){
                        $toLangs[]=$projects->destinationLanguage;                        
                        $allProjects[$key]['languagePrice']=($projects->language_price + $projects->package_price);
                        $allProjects[$key]['languageStatus']=ucfirst($projects->status);
                    }
                    $toLangs=implode(',', $toLangs);
                    $allProjects[$key]['destinationLanguage']=$toLangs;
                }
                //Get all Projects Files Information as per order wise
                $projectFiles=ProjectFile::where('order_id',$order->id)->groupBy('file_name')->get();
                $allProjects[$key]['totalWords']=0;
                if(count($projectFiles)){
                    $totalWords=0;
                    foreach($projectFiles as $fkey=>$projectFile){                   
                       $totalWords=$totalWords+$projectFile->content_words;
                       $filenames[]=$projectFile->file_name;
                    }
                    $allProjects[$key]['totalWords']=$totalWords;
                }         
            }
          }
          return view('backend/orders-data/orders',compact('allProjects'));
        }
        catch (\Exception $e) 
        {   
            $result = [
                    'exception_message' => $e->getMessage()
             ];
            return view('errors.error', $result);
        }
    }

    /**
      * View single Order
      * @param $pageType('review' or 'view') order id       
      * @return Response
      * Created on: 13/02/2017
      * Updated on: 13/02/2017
    **/

    public function getViewOrder($type=null,$orderId=null)
    {
      try {
          if(Auth::user()->role_id==1){
            $order=Order::join('users','users.id','=','orders.user_id')->select('users.email as useremail','orders.*')->where('orders.id',decrypt($orderId))->first();  
          }
          $singleProject=array();
          if($order!=null){
              $singleProject['order_id']=$order->id;
              $singleProject['transaction_id']=$order->transaction_id;
              $singleProject['paymentStatus']=$order->payment_status;
              $singleProject['useremail']=$order->useremail;
              $singleProject['orderDate']=$order->created_at;
              //Get Single Project per order id
              $projects=Project::join('languages','languages.id','=','projects.to_lang_id')
                  ->select('projects.*','projects.status as translationStatus','languages.name as destinationLanguage')
                  ->where('projects.order_id',$order->id)->get();
              
              if(count($projects)){
                  $fromLang=$projects[0]->from_lang_id;
                  $singleProject['languagePackage']=$projects[0]->language_package;
                  $singleProject['languagePurpose']=$projects[0]->translation_purpose;
                  $sourceLang=Language::where('id',$fromLang)->first();
                  $sourceLang=($sourceLang!=null)?$sourceLang->name:'';
                  $singleProject['finalPrice']=$projects[0]->final_price;
                 // $singleProject['sourceLang']=$sourceLang;
                  
                  $toLangs=array();
                  foreach($projects as $pkey=>$projects){
                      $toLangs[$pkey]['id']=$projects->id;
                      $toLangs[$pkey]['source']=$sourceLang;
                      $toLangs[$pkey]['destination']=$projects->destinationLanguage;
                      $toLangs[$pkey]['status']=$projects->translationStatus;
                      $toLangs[$pkey]['singlelangprice']=$projects->language_price;
                      $toLangs[$pkey]['packagePrice']=$projects->package_price;
                      $singleProject['languagePrice']=($projects->language_price + $projects->package_price);
                      $singleProject['languageStatus']=ucfirst($projects->status);
                  }
                  $singleProject['languages']=$toLangs;
              }
              //Get Project Files Information as per order id
              $projectFiles=ProjectFile::where('order_id',$order->id)->groupBy('file_name')->get();
              $singleProject['totalWords']=0;
              if(count($projectFiles)){
                  $totalWords=0;
                  $filenames=array();
                  foreach($projectFiles as $fkey=>$projectFile){                   
                     $totalWords=$totalWords+$projectFile->content_words;
                     $filenames[$fkey]['id']=$projectFile->id;
                     $filenames[$fkey]['name']=$projectFile->file_name;
                     $filenames[$fkey]['words']=$projectFile->content_words;
                     $filenames[$fkey]['upload_path']=$projectFile->file_path;
                     $filetype=explode('.', $projectFile->file_name);
                     $getExtensionGet=$filetype[sizeof($filetype)-1];
                     switch($getExtensionGet){
                        case 'ppt':
                        $imageLogo='power-point.png';
                        break;
                        case 'pptx':
                        $imageLogo='power-point.png';
                        break;
                        case 'doc':
                        $imageLogo='word.png';
                        break;
                        case 'docx':
                        $imageLogo='word.png';
                        break;
                        case 'xls':
                        $imageLogo='excel.png';
                        break;
                        case 'xlsm':
                        $imageLogo='excel.png';
                        break;
                        case 'xlsx':
                        $imageLogo='excel.png';
                        break;
                        case 'rtf':
                        $imageLogo='rich-text-format.png';
                        break;
                        case 'odt':
                        $imageLogo='open-office.png';
                        break;
                        case 'txt':
                        $imageLogo='plain-text.png';
                        break;
                        case 'pdf':
                        $imageLogo='acrobat.png';
                        break;
                        default:
                        $imageLogo='acrobat.png';
                        break;
                      }
                      $filenames[$fkey]['type']=$imageLogo;
                      $filenames[$fkey]['title']=$getExtensionGet;
                  }
                  $singleProject['totalWords']=$totalWords;
                  $singleProject['files']=$filenames;

              }
              $singleProject['packagePriceTotal']=($toLangs[0]['packagePrice']*$totalWords);           
          }
          if($type=='view'){
            return view('backend/orders-data/viewOrder',compact('singleProject'));
          }
          return view('customer/dashboard/404');
        }
        catch (\Exception $e) 
        {   
            $result = [
                    'exception_message' => $e->getMessage()
             ];
            return view('errors.error', $result);
        }
    }

    /**
      * View request changes
      * @param null
      * @return Response
      * Created on: 13/02/2017
      * Updated on: 13/02/2017
    **/
    public function getFeedbacks()
    {
      try {
          
          $feedbacks=ProjectFeedback::join('projects','projects.id','=','project_feedbacks.project_id')->join('project_files','project_files.id','=','project_feedbacks.file_id')->join('languages','languages.id','=','projects.to_lang_id')->select('projects.*','project_feedbacks.*','languages.name as destinationLanguage','project_files.file_name as FileName','project_files.file_path as FilePath','project_files.content_words as FileWords','project_files.status as FileStatus')->get();  
          //echo "<pre>";print_r($feedbacks);exit;
          if(count($feedbacks)){
            $feedbackData=array();
            foreach ($feedbacks as $key => $value) {
                $sourceLang=Language::where('id',$value->from_lang_id)->first();
                $sourceLang=($sourceLang!=null)?$sourceLang->name:'';
                $corrections=TranslationCorrection::select('name')->whereIn('id',unserialize($value->corrections))->get();
               $correct=array();
               foreach($corrections as $correction){
                  $correct[]=$correction->name;
               }
              $feedbackData[$key]['order_id']=$value->order_id;
              $feedbackData[$key]['sourceLang']=$sourceLang;
              $feedbackData[$key]['destinationLang']=$value->destinationLanguage;
              $feedbackData[$key]['corrections']=implode(', ', $correct);
              $feedbackData[$key]['comment']=$value->comment;
              $feedbackData[$key]['language_package']=$value->language_package;
              $feedbackData[$key]['translation_purpose']=$value->translation_purpose;
              $feedbackData[$key]['destinationLang']=$value->destinationLanguage;
              $feedbackData[$key]['FileName']=$value->FileName;
              $feedbackData[$key]['FilePath']=$value->FilePath;
              $feedbackData[$key]['FileWords']=$value->FileWords; 
              $feedbackData[$key]['feedbackDate']=$value->created_at;
              $feedbackData[$key]['FileStatus']=$value->FileStatus;  
                          
            }
          }
          return view('backend/orders-data/feedbacks',compact('feedbackData'));
        }
        catch (\Exception $e) 
        {   
          $result = [
                    'exception_message' => $e->getMessage()
             ];
          return view('errors.error', $result);
        }
    }

    
}
