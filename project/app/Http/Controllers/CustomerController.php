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

class CustomerController extends Controller {
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
      * get pending projects of customer.
      * @param null         
      * @return Response
      * Created on: 06/02/2017
      * Updated on: 06/02/2017
    **/

    public function getDashboard()
    {
       try {
          $sections=Section::where('status','Active')->get();
          $orders=Order::where('orders.user_id',Auth::user()->id)->where('orders.payment_status','success')->get();
          $pendingProjects=array();
          foreach($orders as $key=>$order){

              $pendingProjects[$key]['order_id']=$order->id;
              $pendingProjects[$key]['orderDate']=$order->created_at;
              //Get Projects per order wise
              $projects=Project::join('languages','languages.id','=','projects.to_lang_id')
                  ->select('projects.*','languages.name as destinationLanguage')
                  ->where('projects.order_id',$order->id)->where('projects.status','pending')->get();
              
              if(count($projects)){
                  $fromLang=$projects[0]->from_lang_id;
                  $pendingProjects[$key]['languagePackage']=$projects[0]->language_package;
                  $pendingProjects[$key]['languagePurpose']=$projects[0]->translation_purpose;
                  $sourceLang=Language::where('id',$fromLang)->first();
                  $sourceLang=($sourceLang!=null)?$sourceLang->name:'';
                  $pendingProjects[$key]['sourceLang']=$sourceLang;
                  $pendingProjects[$key]['finalPrice']=$projects[0]->final_price;
                  $toLangs=array();
                  foreach($projects as $pkey=>$projects){
                      $toLangs[]=$projects->destinationLanguage;
                      
                      $pendingProjects[$key]['languagePrice']=($projects->language_price + $projects->package_price);
                      $pendingProjects[$key]['languageStatus']=ucfirst($projects->status);
                  }
                  $toLangs=implode(',', $toLangs);
                  $pendingProjects[$key]['destinationLanguage']=$toLangs;
              }
              //Get Projects Files Information as per order wise
              $projectFiles=ProjectFile::where('order_id',$order->id)->groupBy('file_name')->get();
              $pendingProjects[$key]['totalWords']=0;
              if(count($projectFiles)){
                  $totalWords=0;
                  $filenames=array();
                  $fileTypes=array();
                  foreach($projectFiles as $fkey=>$projectFile){                   
                     $totalWords=$totalWords+$projectFile->content_words;
                     $filenames[]=$projectFile->file_name;
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
                      if(!in_array($imageLogo, $fileTypes)){
                          $fileTypes[]=$imageLogo;
                      }
                  }
                  $pendingProjects[$key]['totalWords']=$totalWords;
                  $pendingProjects[$key]['fileTypes']=$fileTypes;
                  $filenames=implode(',', $filenames);
                  $pendingProjects[$key]['files']=$filenames;

              }            
          }
          return view('customer/dashboard/dashboard',compact('sections','pendingProjects'));
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
      * get all projects of customer.
      * @param null       
      * @return Response
      * Created on: 06/02/2017
      * Updated on: 06/02/2017
    **/

    public function getAllProjects()
    {
      try {
          $sections=Section::where('status','Active')->get();
          $orders=Order::where('orders.user_id',Auth::user()->id)->where('orders.payment_status','success')->get();
          $allProjects=array();
          foreach($orders as $key=>$order){

              $allProjects[$key]['order_id']=$order->id;
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
                  $filenames=array();
                  $fileTypes=array();
                  foreach($projectFiles as $fkey=>$projectFile){                   
                     $totalWords=$totalWords+$projectFile->content_words;
                     $filenames[]=$projectFile->file_name;
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
                      if(!in_array($imageLogo, $fileTypes)){
                          $fileTypes[]=$imageLogo;
                      }
                  }
                  $allProjects[$key]['totalWords']=$totalWords;
                  $allProjects[$key]['fileTypes']=$fileTypes;
                  $filenames=implode(',', $filenames);
                  $allProjects[$key]['files']=$filenames;

              }            
          }
          return view('customer/dashboard/allProjects',compact('sections','allProjects'));
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
      * Created on: 06/02/2017
      * Updated on: 08/02/2017
    **/

    public function getViewOrder($type=null,$orderId=null)
    {
      try {
          $sections=Section::where('status','Active')->get();
          $order=Order::where('orders.user_id',Auth::user()->id)->where('orders.id',decrypt($orderId))->first();
          $singleProject=array();
          if($order!=null){
              $singleProject['order_id']=$order->id;
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
          }
          if($type=='view'){
            return view('customer/dashboard/viewOrder',compact('sections','singleProject'));
          }
          if($type=='review'){
            return view('customer/dashboard/reviewTranslation',compact('sections','singleProject'));
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
      * View Assets
      * @param type
      * @return Response
      * Created on: 07/02/2017
      * Updated on: 07/02/2017
    **/
    
    public function getAssets($type=null)
    {
      try {
          $sections=Section::where('status','Active')->get();
          $assets=array();
          if($type=='glossaries'){
            $assets=ProjectGlossary::where('user_id',Auth::user()->id)->paginate(1);
          }
          if($type=='styles'){
            $assets=ProjectStyle::where('user_id',Auth::user()->id)->paginate(1);
          }
          if($type=='briefs'){
            $assets=ProjectBrief::where('user_id',Auth::user()->id)->paginate(1);
          }
          return view('customer/dashboard/allAssets',compact('sections','assets','type'));
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
      * View Single Asset detail as per id
      * @param id (Gloosary id or style id or briefs id)
      * @return Response
      * Created on: 07/02/2017
      * Updated on: 07/02/2017
    **/

    public function getSingleAsset($type=null,$id=null)
    {
      try {
          $sections=Section::where('status','Active')->get();
          $asset=array();
          if($type=='glossaries'){
            $asset=ProjectGlossary::where('user_id',Auth::user()->id)->where('id',decrypt($id))->first();
          }
          if($type=='styles'){
            $asset=ProjectStyle::where('user_id',Auth::user()->id)->where('id',decrypt($id))->first();
          }
          if($type=='briefs'){
            $asset=ProjectBrief::where('user_id',Auth::user()->id)->where('id',decrypt($id))->first();
          }
          return view('customer/dashboard/singleAsset',compact('sections','asset','type'));
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
      * Update Single Asset File as per id
      * @param id (Gloosary id or style id or briefs id)
      * @return Response
      * Created on: 07/02/2017
      * Updated on: 07/02/2017
    **/

    public function postUpdateAsset(Request $request)
    {
      try {
        $data  =  $request->all();
        $dataUrl=url('/');
        $sections=Section::where('status','Active')->get();
        if($data['file']){
          $filetype=explode('.', $data['file']->getClientOriginalName());
          $getExtensionGet=$filetype[sizeof($filetype)-1];
          switch($getExtensionGet){
            case 'ppt':
              $imageLogo=$dataUrl.'/customer/img/power-point.png';
            break;
            case 'pptx':
              $imageLogo=$dataUrl.'/customer/img/power-point.png';
            break;
            case 'doc':
              $imageLogo=$dataUrl.'/customer/img/word.png';
            break;
            case 'docx':
              $imageLogo=$dataUrl.'/customer/img/word.png';
            break;
            case 'xls':
              $imageLogo=$dataUrl.'/customer/img/excel.png';
            break;
            case 'xlsm':
              $imageLogo=$dataUrl.'/customer/img/excel.png';
            break;
            case 'xlsx':
              $imageLogo=$dataUrl.'/customer/img/excel.png';
            break;
            case 'rtf':
              $imageLogo=$dataUrl.'/customer/img/rich-text-format.png';
            break;
            case 'odt':
              $imageLogo=$dataUrl.'/customer/img/open-office.png';
            break;
            case 'txt':
              $imageLogo=$dataUrl.'/customer/img/plain-text.png';
            break;
            case 'pdf':
              $imageLogo=$dataUrl.'/customer/img/acrobat.png';
            break;
            default:
              $imageLogo=$dataUrl.'/customer/img/acrobat.png';
            break;
          }       
          $fileName = $data['asset_type'].'_'.app('App\Http\Controllers\HomepageSectionController')->getRandomString(20).'.'.$data['file']->getClientOriginalName();
          $destinationPath = url('/').'/uploads/files';
          $projectPath=base_path();
          $projectPath=explode('project', $projectPath);
          $data['file']->move($projectPath[0].'/uploads/files/', $fileName);
          chmod($projectPath[0].'/uploads/files/'.$fileName, 0777);
        }
        if($data['asset_type']=='glossaries'){
          $asset=ProjectGloosary::where('user_id',Auth::user()->id)->where('id',$data['asset_id'])->update(['file_name'=>$fileName]);
        }
        if($data['asset_type']=='styles'){
          $asset=ProjectStyle::where('user_id',Auth::user()->id)->where('id',$data['asset_id'])->update(['file_name'=>$fileName]);
        }
        if($data['asset_type']=='briefs'){
          $asset=ProjectBrief::where('user_id',Auth::user()->id)->where('id',$data['asset_id'])->update(['file_name'=>$fileName]);
        }
        $asset=array();
        $fileName='';
        if($data['asset_type']=='glossaries'){
          $asset=ProjectGlossary::where('user_id',Auth::user()->id)->where('id',$data['asset_id'])->first();
          $fileName=$asset->file_name;
        }
        if($data['asset_type']=='styles'){
          $asset=ProjectStyle::where('user_id',Auth::user()->id)->where('id',$data['asset_id'])->first();
          $fileName=$asset->file_name;
        }
        if($data['asset_type']=='briefs'){
          $asset=ProjectBrief::where('user_id',Auth::user()->id)->where('id',$data['asset_id'])->first();
          $fileName=$asset->file_name;
        }
        $response=array('fileName'=>$fileName,'imageLogo'=>$imageLogo);
        echo json_encode($response);exit;
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
      * Request changes page
      * @param  project id
      * @return Response
      * Created on: 08/02/2017
      * Updated on: 08/02/2017
    **/

    public function getRequestChanges($projectId=null)
    {
      try {
          $sections=Section::where('status','Active')->get();
          $translationCorrection=TranslationCorrection::where('status','Active')->get();
          $singleProject=array();
          //Get Single Project as per project id
          $project=Project::join('languages','languages.id','=','projects.to_lang_id')
                  ->select('projects.*','projects.status as translationStatus','languages.name as destinationLanguage')
                  ->where('projects.id',decrypt($projectId))->where('projects.user_id',Auth::user()->id)->first();              
          if($project != null){
            $singleProject['order_id']=$project->order_id;
            $singleProject['project_id']=$project->id;
            $singleProject['orderDate']=$project->created_at;
            $fromLang=$project->from_lang_id;
            $singleProject['languagePackage']=$project->language_package;
            $singleProject['languagePurpose']=$project->translation_purpose;
            $sourceLang=Language::where('id',$fromLang)->first();
            $sourceLang=($sourceLang!=null)?$sourceLang->name:'';
            $singleProject['finalPrice']=$project->final_price;
            $singleProject['language']['id']=$project->id;
            $singleProject['language']['source']=$sourceLang;
            $singleProject['language']['destination']=$project->destinationLanguage;
            $singleProject['language']['status']=$project->translationStatus;
            $singleProject['language']['languagePrice']=($project->language_price + $project->package_price);
            $singleProject['language']['languageStatus']=ucfirst($project->status);
          }
          //Get Project Files Information as per project id
          $projectFiles=ProjectFile::where('project_id',decrypt($projectId))->get();
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
          return view('customer/dashboard/requestChanges',compact('sections','singleProject','translationCorrection'));
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
      * post feedback form
      * @param  Request
      * @return Response
      * Created on: 08/02/2017
      * Updated on: 08/02/2017
    **/

    public function postCustomerFeedback(Requests\ManageFeedback $request)
    {
      try {
        $data  =  $request->all();
        $file  =  $request->file('requested_file');
        $feedback=ProjectFeedback::where('file_id',$data['translated_file'])->get();
        $filename='';
        if($file){
          $files[]=$file;
          $returnFileData=app('App\Http\Controllers\TranslationApplicationController')->uploadAssets($files);
          $filename=$returnFileData[0];
        }
        if($data['submit']=='Approve translation'){
          $status='Approved'; 
        }else{
          $status='Changes';
        }
        echo $status;exit;
        if(count($feedback)){
          //Update
          $feedback=ProjectFeedback::where('id',$data['translated_file'])->update(['corrections'=>serialize($data['corrections']),'comment'=>$data['comment'],'feedback_file'=>$filename,'status'=>$status]);
        }else{
          //Insert
          $feedback=ProjectFeedback::insert(['file_id'=>$data['translated_file'],'corrections'=>serialize($data['corrections']),'comment'=>$data['comment'],'feedback_file'=>$filename,'project_id'=>$data['project_id'],'status'=>$status]);
        }
        return redirect()->back()->with('success', 'Request feedback sent Successfully.');

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
      * post feedback form
      * @param  Request
      * @return Response
      * Created on: 08/02/2017
      * Updated on: 08/02/2017
    **/

    public function getDeleteSingleAsset($type=null,$id=null)
    {
      try {
          if($type=='glossaries'){
              $asset=ProjectGlossary::where('id',decrypt($id))->delete();
            }
            if($type=='styles'){
              $asset=ProjectStyle::where('id',decrypt($id))->delete();
            }
            if($type=='briefs'){
              $asset=ProjectBrief::where('id',decrypt($id))->delete();
            }
          return redirect()->back()->with('success', 'Asset deleted successfully.');
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