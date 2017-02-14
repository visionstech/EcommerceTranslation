<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use Session;
use App\Section;
use App\Language;
use App\LanguagePackage;
use App\CartItem;
use App\CartLanguage;
use App\LanguagePrice;
use App\Order;
use App\Role;
use App\User;
use App\Project;
use App\ProjectFile;
use App\ProjectInstruction;
use App\ProjectBrief;
use App\ProjectGlossary;
use App\ProjectStyle;
use App\ProjectTranslator;
use App\Company;
use File;

class TranslationApplicationController extends Controller {
  
    /*
    |--------------------------------------------------------------------------
    | Translation Application Controller
    |--------------------------------------------------------------------------
    |
    | This controller manages Customer's translation submission steps.
    |
    */

    public function __construct()
    {
       $defaultCurrency= \Config::get('app.currency');
        /*$this->middleware('auth', ['except' => 'index']);
        $this->auth = $auth;*/
    }
  
    /**
      * Step one will get form of Translation application submit.
      * @param  none             
      * @return Response
      * Created on: 20/01/2017
      * Updated on: 23/01/2017
    **/
    public function getStepOne()
    {
      try {
        //echo $sessionId =Session::getId();exit;
          $sections=Section::where('status','Active')->get();
          return view('customer.translation-application.step-one',compact('sections'));
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
      * Step one will post form of Translation application Cart submit.
      * @param Request data            
      * @return Response
      * Created on: 20/01/2017
      * Updated on: 27/01/2017
    **/

    public function postCartItem(Request $request)
    {
      try {
          $dataUrl=url('/');                
          $url=explode('index.php',$dataUrl);         
          $data=$request->all();
          $file  =  $request->file('files');
          $cartData=array();
          $CountedWords=0;
          $filenames=array();
          $fileWords=array();
          $sessionId =Session::getId();
          $userId=(Auth::user())?Auth::user()->id:0;           
          if($file){
            foreach ($file as $key => $value){                
                $validFiles=array('ppt','pptx','doc','docx','xls','xlsm','xlsx','rtf','odt','txt','pdf');
                $dummypath = $value->getClientOriginalName();
                $extention = pathinfo($dummypath, PATHINFO_EXTENSION);
                $fileType=$value->getMimeType();
                if (in_array($extention, $validFiles)) {
                  $random=app('App\Http\Controllers\HomepageSectionController')->getRandomString(10);
                  $fileName= $random.'_'.$value->getClientOriginalName();
                  $filenames[]=$fileName;
                  $projectPath=base_path();
                  $projectPath=explode('project', $projectPath);
                  $value->move($projectPath[0].'/uploads/files/', $fileName);
                  chmod($projectPath[0].'/uploads/files/'.$fileName, 0777);

                  $dataUrl=url('/');                
                  $url=explode('index.php',$dataUrl);
                  $fileUrl=$url[0].'uploads/'.$fileName;

                  $contents = File::get('uploads/files/'.$fileName);
                  $number_of_words=count(explode(' ', $contents));
                  $fileWords[]=$number_of_words;
                  $CountedWords  += $number_of_words;
                }
            }
          }
          //Cart Update Data
        if($userId==0){
          $whereValue=$sessionId;
          $whereCondition='session_id';
          $getContentCart=CartItem::where('file',null)->where($whereCondition,$whereValue)->first();
          $getFileCart=CartItem::where('file','!=',null)->where($whereCondition,$whereValue)->get();
          //echo "<pre>";print_r($getContentCart);exit;
        }else{
            $columns=array();
            $columns['userId']=$userId;
            $columns['sessionId']=$sessionId;
            $getContentCart=CartItem::where('file',null)->where(function($query) use($columns) {
                                                                  $query->where('user_id', $columns['userId'])
                                                                  ->orWhere('session_id', $columns['sessionId']);
                                                          })->first();
            $getFileCart=CartItem::where('file','!=',null)->where(function($query) use($columns) {
                                                              $query->where('user_id', $columns['userId'])
                                                              ->orWhere('session_id', $columns['sessionId']);
                                                          })->get();
        }
         
          $CartDataFinal=array();
          
          $content_words=(isset($data['content']))?(str_word_count($data['content'])):'';
            
            if($content_words != '' ){
              if($getContentCart != null){
                //Update textarea content
                  $cartUpdate = CartItem::where('id',$getContentCart->id)->update(['content'=>$data['content'],'content_words'=>$content_words]);

              }else{
                //insert textarea content
                  $insertCart= CartItem::Create([
                      'user_id' => (Auth::user())?Auth::user()->id:0,
                      'content' => (isset($data['content']))?$data['content']:'',
                      'file'=>null,
                      'file_path'=> null,
                      'content_words'=>$content_words,
                      'total_words'=>($CountedWords+$content_words),
                      'session_id'=>$sessionId
                    ]);
              }
            }
            
            if($filenames){
              $totalWords=($CountedWords+$content_words);
                foreach($filenames as $key=>$file){
                  $insertFilesCart= CartItem::Create([
                        'user_id' => (Auth::user())?Auth::user()->id:0,
                        'content' => null,
                        'file' =>$file,
                        'file_path'=> 'uploads/files',
                        'content_words'=>$fileWords[$key],
                        'total_words'=>$totalWords,
                        'session_id'=>$sessionId
                      ]);
                }
            }
          if($userId==0){
            $whereValue=$sessionId;
            $whereCondition='session_id';
            $getContentCartUpdated=CartItem::where('file',null)->where('status','Active')->where($whereCondition,$whereValue)->first();
            $getFileCartUpdated=CartItem::where('file','!=',null)->where('status','Active')->where($whereCondition,$whereValue)->get(); 
          }else{
            $columns=array();
            $columns['userId']=$userId;
            $columns['sessionId']=$sessionId;
            $getContentCartUpdated=CartItem::where('file',null)->where('status','Active')
                                                            ->where(function($query) use($columns) {
                                                                $query->where('user_id', $columns['userId'])
                                                                ->orWhere('session_id', $columns['sessionId']);
                                                              })->first();
            $getFileCartUpdated=CartItem::where('file','!=',null)->where('status','Active')
                                                            ->where(function($query) use($columns) {
                                                                $query->where('user_id', $columns['userId'])
                                                                ->orWhere('session_id', $columns['sessionId']);
                                                            })->get();        
          }            
            
          
          $totalWordsCounted=0;
          $cartHtml='<table border="0">';
          if($getContentCartUpdated != null){
            if($getContentCartUpdated->content){
              $cartHtml .='<tr>
                        <td class="type"><img src="'.$url[0].'/customer/img/plain-text.png" title="plain-text" alt="plain-text"></td>
                        <td class="perview">text...</td>
                        <td class="switch"><span class="words">'.$getContentCartUpdated->content_words.' words</span><span class="close"><a href="#" onclick="editContent();" title="Edit">Edit</a> <i class="fa fa-times-circle-o" onclick="trashElement('.$getContentCartUpdated->id.');" aria-hidden="true"></i></span></td>
                      </tr>';
              $totalWordsCounted=($totalWordsCounted+$getContentCartUpdated->content_words);
            }
           $content_words=$getContentCartUpdated->content;
          }else{
            $content_words='';
          }
          if(count($getFileCartUpdated)){
            foreach($getFileCartUpdated as $key=>$file){
              $filetype=explode('.', $file->file);
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
               
                $cartHtml .='<tr>
                        <td class="type"><img src="'.$url[0].'/customer/img/'.$imageLogo.'" title="'.$getExtensionGet.'" alt="'.$getExtensionGet.'" /></td>
                        <td class="perview">'.$file->file.'</td>
                        <td class="switch"><span class="words">'.$file->content_words.' words</span><span class="close"><i class="fa fa-times-circle-o" onclick="trashElement('.$file->id.');" aria-hidden="true"></i></span></td>
                      </tr>';
                $totalWordsCounted=($totalWordsCounted+$file->content_words);
            }
        }
        $cartHtml .='<tr>
                      <td class="type"><img src="'.$url[0].'/customer/img/multiple-docs.png" title="multiple-docs" alt="multiple-docs" /></td>
                      <td class="perview">'.(count($getFileCartUpdated)+count($getContentCartUpdated)).' Items</td>
                      <td class="switch"><span class="switch_total">'.$totalWordsCounted.'</span> words</td>
                    </tr>';

          $cartHtml .='</table>';

          // Get Trashed Items Of The Cart And Update It In Trashed Div
          if($userId==0){
            $whereValue=$sessionId;
            $whereCondition='session_id';
            $getContentCartTrashed=CartItem::where('file',null)->where('status','Trashed')->where($whereCondition,$whereValue)->first();
            $getFileCartTrashed=CartItem::where('file','!=',null)->where('status','Trashed')->where($whereCondition,$whereValue)->get(); 
          }else{
              $columns=array();
              $columns['userId']=$userId;
              $columns['sessionId']=$sessionId;
              $getContentCartTrashed=CartItem::where('file',null)->where('status','Trashed')
                                                            ->where(function($query) use($columns) {
                                                                $query->where('user_id', $columns['userId'])
                                                                ->orWhere('session_id', $columns['sessionId']);
                                                            })->first();
              $getFileCartTrashed=CartItem::where('file','!=',null)->where('status','Trashed')
                                                            ->where(function($query) use($columns) {
                                                                $query->where('user_id', $columns['userId'])
                                                                ->orWhere('session_id', $columns['sessionId']);
                                                              })->get();       
          }
          
          
          $totalWordsCountedTrashed=0;
          $cartHtmlTrashed='';
          if($getContentCartTrashed != null || count($getFileCartTrashed)){
            $cartHtmlTrashed='<table border="0">';
          }
          if($getContentCartTrashed != null){
            if($getContentCartTrashed->content){
              $cartHtmlTrashed .='<tr>
                        <td class="type"><img src="'.$url[0].'/customer/img/plain-text.png" title="plain-text" alt="plain-text"></td>
                        <td class="perview">text...</td>
                        <td class="switch"><span class="words">'.$getContentCartTrashed->content_words.' words</span><span class="close"><a href="#" title="Edit">Edit</a> <span onclick="trashElement('.$getContentCartTrashed->id.')"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span></span></td>
                      </tr>';
              $totalWordsCountedTrashed=($totalWordsCountedTrashed+$getContentCartTrashed->content_words);
            }
           $content_wordsTrashed=$getContentCartUpdated->content;
          }else{
            $content_wordsTrashed='';
          }
          if(count($getFileCartTrashed)){
            foreach($getFileCartTrashed as $key=>$file){
              $filetype=explode('.', $file->file);
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
                $cartHtmlTrashed .='<tr>
                        <td class="type"><img src="'.$url[0].'/customer/img/'.$imageLogo.'" title="acrobat" alt="acrobat" /></td>
                        <td class="perview">'.$file->file.'</td>
                        <td class="switch"><span class="words">'.$file->content_words.' words</span><span class="close"><span onclick="trashElement('.$file->id.')"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span></span></td>
                      </tr>';
                $totalWordsCountedTrashed=($totalWordsCountedTrashed+$file->content_words);
            }
        }
        if($totalWordsCountedTrashed>0){
          $cartHtmlTrashed .='<tr>
                        <td class="type"><img src="'.$url[0].'/customer/img/multiple-docs.png" title="multiple-docs" alt="multiple-docs" /></td>
                        <td class="perview">'.(count($getFileCartTrashed)+count($getContentCartTrashed)).' Items</td>
                        <td class="switch"><span class="switch_total">'.$totalWordsCountedTrashed.'</span> words</td>
                      </tr>';
            $cartHtmlTrashed .='</table>';
            $totalDeletedItems=(count($getFileCartTrashed)+count($getContentCartTrashed));
          }else{
            $totalDeletedItems=''; 
          }
          $returnData=array($content_words,$cartHtml,$cartHtmlTrashed,$content_wordsTrashed,$totalDeletedItems,$totalWordsCounted);
          echo json_encode($returnData);exit;

      }catch (\Exception $e){   
        
        $result = [
                    'exception_message' => $e->getMessage()
             ];
        return view('errors.error', $result);
      }
    }

    /**
      * Step one will get cart data on page load.
      * @param status and item id        
      * @return Response
      * Created on: 20/01/2017
      * Updated on: 27/01/2017
    **/
    
    public function getCartItem($restore=null,$itemId=null)
    {
      try {
        $dataUrl=url('/');                
        $url=explode('index.php',$dataUrl);
        $sessionId =Session::getId();
        $userId=(Auth::user())?Auth::user()->id:0;
        //echo $userId;exit;
        if(($restore) && !($itemId)){
            if($restore=='delete_permanently'){
              $deletePermanent=CartItem::where('status','Trashed')->where('user_id', $userId)->orWhere('session_id',$sessionId)->delete(); 
            }else{
              $deleteAll=CartItem::where('user_id', $userId)->orWhere('session_id',$sessionId)->delete();  
            }
        }
        if(($itemId) && ($restore)){
          $UpdateStatus=CartItem::where('id',$itemId)->update(['status'=>$restore]);
        }
        if($userId==0){
          $whereValue=$sessionId;
          $whereCondition='session_id';
          $getContentCartUpdated=CartItem::where('file',null)->where('status','Active')->where($whereCondition,$whereValue)->first();
          $getFileCartUpdated=CartItem::where('file','!=',null)->where('status','Active')->where($whereCondition,$whereValue)->get();
        }else{
            $columns=array();
            $columns['userId']=$userId;
            $columns['sessionId']=$sessionId;
            $getContentCartUpdated=CartItem::where('file',null)->where('status','Active')
                                          ->where(function($query) use($columns) {
                                                  $query->where('user_id', $columns['userId'])
                                                  ->orWhere('session_id', $columns['sessionId']);
                                            })->first();
            $getFileCartUpdated=CartItem::where('file','!=',null)->where('status','Active')
                                                            ->where(function($query) use($columns) {
                                                                $query->where('user_id', $columns['userId'])
                                                                ->orWhere('session_id', $columns['sessionId']);
                                                            })->get();
        }
          $totalWordsCounted=0;
          $cartHtml='';
          if($getContentCartUpdated != null || count($getFileCartUpdated)){
           $cartHtml='<table border="0">';
          }
          if($getContentCartUpdated != null){
            if($getContentCartUpdated->content){
              $cartHtml .='<tr>
                        <td class="type"><img src="'.$url[0].'/customer/img/plain-text.png" title="plain-text" alt="plain-text"></td>
                        <td class="perview">text...</td>
                        <td class="switch"><span class="words">'.$getContentCartUpdated->content_words.' words</span><span class="close"><a href="#" onclick="editContent();" title="Edit">Edit</a> <i class="fa fa-times-circle-o" onclick="trashElement('.$getContentCartUpdated->id.');" aria-hidden="true" ></i></span></td>
                      </tr>';
              $totalWordsCounted=($totalWordsCounted+$getContentCartUpdated->content_words);
            }
            $content_words=$getContentCartUpdated->content;
          }else{
            $content_words='';
          }
          if(count($getFileCartUpdated)){
            foreach($getFileCartUpdated as $key=>$file){
               $filetype=explode('.', $file->file);
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
                $cartHtml .='<tr>
                        <td class="type"><img src="'.$url[0].'/customer/img/'.$imageLogo.'" title="acrobat" alt="acrobat" /></td>
                        <td class="perview">'.$file->file.'</td>
                        <td class="switch"><span class="words">'.$file->content_words.' words</span><span class="close"><span class="close"><i class="fa fa-times-circle-o" onclick="trashElement('.$file->id.');" aria-hidden="true"></i></span></td>
                      </tr>';
                $totalWordsCounted=($totalWordsCounted+$file->content_words);
            }
        }
        if($getContentCartUpdated != null || count($getFileCartUpdated)){
          $cartHtml .='<tr>
                      <td class="type"><img src="'.$url[0].'/customer/img/multiple-docs.png" title="multiple-docs" alt="multiple-docs" /></td>
                      <td class="perview">'.(count($getFileCartUpdated)+count($getContentCartUpdated)).' Items</td>
                      <td class="switch"><span class="switch_total">'.$totalWordsCounted.'</span> words</td>
                    </tr>';
          $cartHtml .='</table>';
        } 
          // Get Trashed Items Of The Cart And Update It In Trashed Div
          if($userId==0){
            $whereValue=$sessionId;
            $whereCondition='session_id';
            $getContentCartTrashed=CartItem::where('file',null)->where('status','Trashed')->where($whereCondition,$whereValue)->first();
           
            $getFileCartTrashed=CartItem::where('file','!=',null)->where('status','Trashed')->where($whereCondition,$whereValue)->get(); 
          }else{
              $columns=array();
              $columns['userId']=$userId;
              $columns['sessionId']=$sessionId;
              $getContentCartTrashed=CartItem::where('file',null)->where('status','Trashed')
                                    ->where(function($query) use($columns) {
                                      $query->where('user_id', $columns['userId'])
                                            ->orWhere('session_id', $columns['sessionId']);
                                    })->first();
              $getFileCartTrashed=CartItem::where('file','!=',null)->where('status','Trashed')
                                  ->where(function($query) use($columns) {
                                      $query->where('user_id', $columns['userId'])
                                            ->orWhere('session_id', $columns['sessionId']);
                                    })->get();      
          }      

          $totalWordsCountedTrashed=0;
          $cartHtmlTrashed='';
          if($getContentCartTrashed != null || count($getFileCartTrashed)){
            $cartHtmlTrashed='<table border="0">';
          }
          if($getContentCartTrashed != null){
            if($getContentCartTrashed->content){
              $cartHtmlTrashed .='<tr>
                        <td class="type"><img src="'.$url[0].'/customer/img/plain-text.png" title="plain-text" alt="plain-text"></td>
                        <td class="perview"><del>text...</del></td>
                        <td class="switch"><span class="words">'.$getContentCartTrashed->content_words.' words</span><span class="close"><i class="fa fa-undo" onclick="restoreElement('.$getContentCartTrashed->id.');" aria-hidden="true"></i></span></td>
                      </tr>';
              $totalWordsCountedTrashed=($totalWordsCountedTrashed+$getContentCartTrashed->content_words);
            }
           $content_wordsTrashed=$getContentCartTrashed->content;
          }else{
            $content_wordsTrashed='';
          }
          if(count($getFileCartTrashed)){
            foreach($getFileCartTrashed as $key=>$file){
                $filetype=explode('.', $file->file);
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
                $cartHtmlTrashed .='<tr>
                        <td class="type"><img src="'.$url[0].'/customer/img/'.$imageLogo.'" title="acrobat" alt="acrobat" /></td>
                        <td class="perview"><del>'.$file->file.'</del></td>
                        <td class="switch"><span class="words">'.$file->content_words.' words</span><span class="close"><i class="fa fa-undo" onclick="restoreElement('.$file->id.');" aria-hidden="true"></i></span></td>
                      </tr>';
                $totalWordsCountedTrashed=($totalWordsCountedTrashed+$file->content_words);
            }
        }
        if($totalWordsCountedTrashed>0){
          $cartHtmlTrashed .='<tr>
                      <td class="type"><img src="'.$url[0].'/customer/img/multiple-docs.png" title="multiple-docs" alt="multiple-docs" /></td>
                      <td class="perview">'.(count($getFileCartTrashed)+count($getContentCartTrashed)).' Items</td>
                      <td class="switch"><span class="switch_total">'.$totalWordsCountedTrashed.'</span> words</td>
                    </tr>';
            $totalDeletedItems=(count($getFileCartTrashed)+count($getContentCartTrashed));
            $cartHtmlTrashed .='</table>';
          }else{
            $totalDeletedItems='';
          }
          $returnData=array($content_words,$cartHtml,$cartHtmlTrashed,$content_wordsTrashed,$totalDeletedItems,$totalWordsCounted);
          echo json_encode($returnData);exit;

      }catch (\Exception $e){   
        
        $result = [
                    'exception_message' => $e->getMessage()
             ];
        return view('errors.error', $result);
      }
    }

    /**
      * Step one will get cart page of step2.
      * @param null
      * @return Response
      * Created on: 28/01/2017
      * Updated on: 31/01/2017
    **/
    public function getStepTwo()
    {
      try {
          $sections=Section::where('status','Active')->get();
          $languages=Language::where('status','Active')->get();
          return view('customer.translation-application.step-two',compact('sections','languages'));
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
      * Step one will post cart data step 2 on page load.
      * @param Request data            
      * @return Response
      * Created on: 28/01/2017
      * Updated on: 30/01/2017
    **/
    public function postCartLanguage(Request $request)
    {
      try {
            $dataUrl=url('/');                
            $url=explode('index.php',$dataUrl);         
            $data=$request->all();
            $file  =  $request->file('files');
            $cartData=array();
            $CountedWords=0;
            $filenames=array();
            $fileWords=array();
            $sessionId =Session::getId();
            $userId=(Auth::user())?Auth::user()->id:0;            
            if(isset($data['to_language_id'])){
              foreach($data['to_language_id'] as $toLanguage){
                $columns=array();
                $columns['userId']=$userId;
                $columns['sessionId']=$sessionId;
                $getLanguagesCart=CartLanguage::where('from_language_id',$data['from_language_id'])->where('to_language_id',$toLanguage)->where(function($query) use($columns) {
                                                        $query->where('user_id', $columns['userId'])
                                                        ->orWhere('session_id', $columns['sessionId']);
                                                })->get();
                if(!count($getLanguagesCart)){
                  $insertCart= CartLanguage::Create([
                          'user_id' => (Auth::user())?Auth::user()->id:0,
                          'from_language_id'=> $data['from_language_id'],
                          'to_language_id' => $toLanguage,        
                          'session_id'=>$sessionId
                        ]);
                }
              }
            }
            if($userId==0){
              $whereValue=$sessionId;
              $whereCondition='session_id'; 
              $getLanguagesCartUpdated=CartLanguage::where($whereCondition,$whereValue)->get();
              $getWordsCount=CartItem::where('status','Active')->where($whereCondition,$whereValue)->sum('content_words');
            }else{
               $columns=array();
                $columns['userId']=$userId;
                $columns['sessionId']=$sessionId;
                $getLanguagesCartUpdated=CartLanguage::where(function($query) use($columns) {
                                                        $query->where('user_id', $columns['userId'])
                                                        ->orWhere('session_id', $columns['sessionId']);
                                                  })->get();
                $getWordsCount=CartItem::where('status','Active')->where(function($query) use($columns) {
                                                        $query->where('user_id',$columns['userId'])
                                                        ->orWhere('session_id', $columns['sessionId']);
                                      })->sum('content_words');     
            }
            $languageCartHtml='';
            $count=1;
            $totalPrice=0;
            $totalLanguages=0;
            if(count($getLanguagesCartUpdated)){
              foreach($getLanguagesCartUpdated as $getLanguagesCartUpdate){

                $getLanguageData=LanguagePrice::join('languages','languages.id','=','language_prices.destination')->select('languages.name as destinationLang','language_prices.*')->where('language_prices.source',$getLanguagesCartUpdate->from_language_id)->where('language_prices.destination',$getLanguagesCartUpdate->to_language_id)->get();
                $price=(count($getLanguageData))?$getLanguageData[0]->price_per_word:0;
                $destLanguage=(count($getLanguageData))?$getLanguageData[0]->destinationLang:'';
                $totalPriceCalculated=($getWordsCount*$price);
                
                if($getLanguagesCartUpdate->status=='Trashed'){
                    $delStart='<del>';
                    $delClose='</del>';
                    $actionButton='<i class="fa fa-undo" onclick="restoreTranslation('.$getLanguagesCartUpdate->id.');" aria-hidden="true"></i>';
                }
                if($getLanguagesCartUpdate->status=='Active'){
                  $delStart='';
                  $delClose='';
                  $actionButton='<i class="fa fa-times-circle-o" onclick="trashTranslation('.$getLanguagesCartUpdate->id.');" aria-hidden="true"></i>';
                  $totalPrice=$totalPrice+$totalPriceCalculated;
                  $totalLanguages=$totalLanguages+1;
                }
                if($count==1){
                  $languageCartHtml .='<tr><td>'.$delStart.ucfirst($destLanguage).$delClose.'</td><td>$'.$delStart.$price.$delClose.' / word</td><td rowspan="'.count($getLanguagesCartUpdated).'" class="color-td">'.$delStart.$getWordsCount.$delClose.' Words</td><td>$'.$delStart.$totalPriceCalculated.$delClose.' <span class="close">'.$actionButton.'</span></td></tr>';
                }else{
                  $languageCartHtml .='<tr><td>'.$delStart.ucfirst($destLanguage).$delClose.'</td><td>$'.$delStart.$price.$delClose.' / word</td>'.$delStart.$getWordsCount.$delClose.' Words</td><td>$'.$delStart.$totalPriceCalculated.$delClose.' <span class="close">'.$actionButton.'</span></td></tr>';
                }
               $count++;
              }
              $languageCartHtml .='<tr><td colspan="4" class="add-more" onclick="addMore();">+ Add more Languages</td>
                          </tr><tr><td colspan="3">'.$totalLanguages.' Languages</td><td>$'.$totalPrice.'</td></tr>';

            }
            $returnData=array($languageCartHtml,$getWordsCount,$totalLanguages,'$'.$totalPrice);
            echo json_encode($returnData);exit;

      } catch (\Exception $e) {   
              $result = [
                      'exception_message' => $e->getMessage()
               ];
              return view('errors.error', $result);
      }
    }

    /**
      * Step one will get cart data step 2 on page load.
      * @param status and cart language id   
      * @return Response
      * Created on: 29/01/2017
      * Updated on: 31/01/2017
    **/
    public function getCartLanguage($status=null,$cartLangId=null)
    {
      try {
            $dataUrl=url('/');                
            $url=explode('index.php',$dataUrl); 
            $sessionId =Session::getId();
            $userId=(Auth::user())?Auth::user()->id:0;
            if($status=='Deleted'){
              $deleteCart=CartLanguage::where(function($query) use($userId,$sessionId) {
                                                        $query->where('user_id', $userId)
                                                        ->orWhere('session_id', $sessionId);
                                      })->delete();
            }
            if(($status=='Trashed') || ($status=='Active')){
              $trashCart=CartLanguage::where('id',$cartLangId)->update(['status'=>$status]);
            }
            if($userId==0){
              $whereValue=$sessionId;
              $whereCondition='session_id';
              $getLanguagesCartUpdated=CartLanguage::where($whereCondition,$whereValue)->get();
              $getWordsCount=CartItem::where('status','Active')->where($whereCondition,$whereValue)->sum('content_words');
              $CountCartActive=CartLanguage::where($whereCondition,$whereValue)->count();
            }else{
               $columns=array();
                $columns['userId']=$userId;
                $columns['sessionId']=$sessionId;
                $getLanguagesCartUpdated=CartLanguage::where(function($query) use($columns) {
                                                        $query->where('user_id', $columns['userId'])
                                                        ->orWhere('session_id', $columns['sessionId']);
                                                  })->get();
                $getWordsCount=CartItem::where('status','Active')->where(function($query) use($columns) {
                                                            $query->where('user_id', $columns['userId'])
                                                            ->orWhere('session_id', $columns['sessionId']);
                                        })->sum('content_words');
                $CountCartActive=CartLanguage::where('status','Active')
                                              ->where(function($query) use($columns) {
                                                            $query->where('user_id', $columns['userId'])
                                                            ->orWhere('session_id', $columns['sessionId']);
                                              })->count();    
            }
            

            $languageCartHtml='';
            $count=1;
            $totalPrice=0;
            $totalLanguages=0;
            if(count($getLanguagesCartUpdated)){

              foreach($getLanguagesCartUpdated as $getLanguagesCartUpdate){
                $getLanguageData=LanguagePrice::join('languages','languages.id','=','language_prices.destination')->select('languages.name as destinationLang','language_prices.*')->where('language_prices.source',$getLanguagesCartUpdate->from_language_id)->where('language_prices.destination',$getLanguagesCartUpdate->to_language_id)->get();
                $price=(count($getLanguageData))?$getLanguageData[0]->price_per_word:0;
                $destLanguage=(count($getLanguageData))?$getLanguageData[0]->destinationLang:'';
                $totalPriceCalculated=($getWordsCount*$price);
                
                if($getLanguagesCartUpdate->status=='Trashed'){
                    $delStart='<del>';
                    $delClose='</del>';
                    $actionButton='<i class="fa fa-undo" onclick="restoreTranslation('.$getLanguagesCartUpdate->id.');" aria-hidden="true"></i>';
                }
                if($getLanguagesCartUpdate->status=='Active'){
                  $delStart='';
                  $delClose='';
                  $actionButton='<i class="fa fa-times-circle-o" onclick="trashTranslation('.$getLanguagesCartUpdate->id.');" aria-hidden="true"></i>';
                  $totalPrice=$totalPrice+$totalPriceCalculated;
                  $totalLanguages=$totalLanguages+1;
                }
                if($CountCartActive==0){
                  $delWstart='<del>';
                  $delWclose='</del>';
                }else{
                  $delWstart='';
                  $delWclose='';
                }
                if($count==1){
                  $languageCartHtml .='<tr><td>'.$delStart.ucfirst($destLanguage).$delClose.'</td><td>$'.$delStart.$price.$delClose.' / word</td><td rowspan="'.count($getLanguagesCartUpdated).'" class="color-td">'.$delWstart.$getWordsCount.$delWclose.' Words</td><td>$'.$delStart.$totalPriceCalculated.$delClose.' <span class="close">'.$actionButton.'</span></td></tr>';
                }else{
                  $languageCartHtml .='<tr><td>'.$delStart.ucfirst($destLanguage).$delClose.'</td><td>$'.$delStart.$price.$delClose.' / word</td>'.$delWstart.$getWordsCount.$delWclose.' Words</td><td>$'.$delStart.$totalPriceCalculated.$delClose.' <span class="close">'.$actionButton.'</span></td></tr>';
                }
               $count++;
              }
              $languageCartHtml .='<tr><td colspan="4" class="add-more" onclick="addMore();">+ Add more Languages</td>
                          </tr><tr><td colspan="3">'.$totalLanguages.' Languages</td><td>$'.$totalPrice.'</td></tr>';
            }
            $returnData=array($languageCartHtml,$getWordsCount,$totalLanguages,'$'.$totalPrice);
            echo json_encode($returnData);exit;

      } catch (\Exception $e) {   
              $result = [
                      'exception_message' => $e->getMessage()
               ];
              return view('errors.error', $result);
      }
    }

    /**
      * Step one will Get valid languages translations on step2.
      * @param From language id or null        
      * @return Response
      * Created on: 30/01/2017
      * Updated on: 30/01/2017
    **/
    public function getValidTranslations($from_language_id=null)
    {
      try {
        $dataUrl=url('/');                
        $url=explode('index.php',$dataUrl); 
        
        $getLanguageData=LanguagePrice::join('languages','languages.id','=','language_prices.destination')->select('languages.name as destinationLang','languages.image','language_prices.*')->where('language_prices.source',$from_language_id)->get();

        $validHtml='<ul class="eqho-clear-fix">';
        if(count($getLanguageData)){
          foreach($getLanguageData as $getLanguageDat){
              $image = ((!empty($getLanguageDat)) ? $getLanguageDat->image : ''); 
              if($image){
                $img="/uploads/".$getLanguageDat->image;
              }else{
                $img = "/customer/img/english-lang.jpg";
              } 
              $validHtml .='<li id="selectedLangs_'.$getLanguageDat->destination.'" data-id="'.$getLanguageDat->destination.'">
              <img src="'.$url[0].$img.'" alt="'.$getLanguageDat->destinationLang.'" title="'.$getLanguageDat->destinationLang.'"> '.$getLanguageDat->destinationLang.'</li>';
          } 
        }
        $validHtml .='</ul>';
        $returnData=array($validHtml);
        echo json_encode($returnData);exit;       
      }catch (\Exception $e) {   
              $result = [
                      'exception_message' => $e->getMessage()
               ];
              return view('errors.error', $result);
      }
    
    }

    /**
      * Step one will Get page of Step 3 .
      * @param null      
      * @return Response
      * Created on: 31/01/2017
      * Updated on: 31/01/2017
    **/
    public function getStepThree()
    {
      try {
          //$currency_input = 2;
          //currency codes : http://en.wikipedia.org/wiki/ISO_4217
          //$currency_from = "USD";
          //$currency_to = "INR";
          //$this->getConvertedCurrency($currency_from,$currency_to,$currency_input);
          $currentUrl = Session::put('currentUrl',url('/translation-application/step-three'));
          if(Auth::user()){
            Session::put('currentUrl','');
          }

          $sections=Section::where('status','Active')->get();
          $userId=(Auth::user())?Auth::user()->id:0;
          $sessionId =Session::getId();
          if($userId==0){
            $whereValue=$sessionId;
            $whereCondition='session_id';
            $getCartItems=CartItem::where('status','Active')->where($whereCondition,$whereValue)->count();
          }else{
              $columns=array();
              $columns['userId']=$userId;
              $columns['sessionId']=$sessionId;
              $getCartItems=CartItem::where('status','Active')
                                    ->where(function($query) use($columns) {
                                            $query->where('user_id', $columns['userId'])
                                            ->orWhere('session_id', $columns['sessionId']);
                                      })->count();
          }
          
          $previousTranslators=ProjectTranslator::join('users','users.id','=','project_translators.translator_id')->select('project_translators.*','users.email as translatorEmail')->where('user_id',$userId)->groupBy('translator_id')->get();
          $previousGloosaries=ProjectGlossary::where('user_id',$userId)->get();
          $previousStyles=ProjectStyle::where('user_id',$userId)->get();
          $previousBriefs=ProjectBrief::where('user_id',$userId)->get();

          $latestOrderId = Session::get('orderId'); 
          if(!$latestOrderId){
            $latestOrder=Order::where('user_id',$userId)->orderBy('id','desc')->first();
            $latestOrderId=($latestOrder!=null)?$latestOrder->id:0;
          }
          $projectInstructions=ProjectInstruction::where('order_id',$latestOrderId)->first();
          $projectStyles=ProjectStyle::where('order_id',$latestOrderId)->first();
          $projectGloosaries=ProjectGlossary::where('order_id',$latestOrderId)->first();
          $projectBriefs=ProjectBrief::where('order_id',$latestOrderId)->first();
          $projectTranslator=ProjectTranslator::where('order_id',$latestOrderId)->first();

          $allProjectStyles=ProjectStyle::where('order_id',$latestOrderId)->get();
          $allProjectGloosaries=ProjectGlossary::where('order_id',$latestOrderId)->get();
          $allProjectBriefs=ProjectBrief::where('order_id',$latestOrderId)->get();

          $languages=Language::where('status','Active')->get();
          $languagePackages=LanguagePackage::all();
          return view('customer.translation-application.step-three',compact('sections','languages','languagePackages','previousTranslators','previousGloosaries','previousStyles','previousBriefs','latestOrderId','projectInstructions','projectStyles','projectGloosaries','projectBriefs','projectTranslator','allProjectStyles','allProjectGloosaries','allProjectBriefs','getCartItems'));
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
      * Step one will Get Converted currency.
      * @param $currencyfrom,to and currency value         
      * @return Response
      * Created on: 30/01/2017
      * Updated on: 30/01/2017
    **/
    public function getConvertedCurrency($currency_from,$currency_to,$currency_input){

          $yql_base_url = "http://query.yahooapis.com/v1/public/yql";
          $yql_query = 'select * from yahoo.finance.xchange where pair in ("'.$currency_from.$currency_to.'")';
          $yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);
          $yql_query_url .= "&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";
          $yql_session = curl_init($yql_query_url);
          curl_setopt($yql_session, CURLOPT_RETURNTRANSFER,true);
          $yqlexec = curl_exec($yql_session);
          $yql_json =  json_decode($yqlexec,true);
          $currency_output = (float) $currency_input*$yql_json['query']['results']['rate']['Rate'];
          return $currency_output;
    }

    /**
      * Step one will post payment.
      * @param $currencyfrom,to and currency value         
      * @return Response
      * Created on: 31/01/2017
      * Updated on: 31/01/2017
    **/
    public function postStepThree (Request $request){

       \Stripe\Stripe::setApiKey ( 'sk_test_8cnU38GePfiBbNfvSFVsUsEX' );
       
       $data=$request->all();
       $amount=explode('$', $data['final_amount']);
       
       try {
            $sessionId =Session::getId();
            
            $InsertPayment=\Stripe\Charge::create ( array (
                    "amount" => ($amount[1]*100),
                    "currency" => "usd",
                    "source" => $data['stripeToken'], // obtained with Stripe.js
                    "description" => "Test payment." 
            ));
            //echo $InsertPayment->id;exit;
          //If user not Registered on site then First Register User with email auto-generated password and email to user.
             if(!Auth::user()){
                $randomPassword=$random=app('App\Http\Controllers\HomepageSectionController')->getRandomString(10);
                // Create new user
                $create_user = User::create([
                    'email' => $data['stripeEmail'],
                    'password' => bcrypt($randomPassword),
                    'role_id' => 3,
                    'status' => 'Paused'
                ]);
                //Login User Automatically
                //Here email to user with this password below:
              //echo  $sessionId =Session::getId().'<br/>';
               $credentials = array(
                'email' => $data['stripeEmail'],
                'password' => $randomPassword
                );
                Auth::attempt($credentials);
              //echo  $sessionIdN =Session::getId();exit;
                $Up=CartItem::where('session_id',$sessionId)->update(['user_id'=>Auth::user()->id]);
                $UpL=CartLanguage::where('session_id',$sessionId)->update(['user_id'=>Auth::user()->id]);
            }

            $userId=(Auth::user())?Auth::user()->id:0;
             
          //payment insertion
            $status='success';
           // echo "sdfsdfsd";exit;
            $insertOrder= Order::create([
                                  'user_id' => $userId,
                                  'transaction_id' => $InsertPayment->id,
                                  'payment_status'=>$status,
                                  'payment_type'=>$data['stripeTokenType']
                                ]);

            $orderId = $insertOrder->id;
            //echo $userId.'<br/>'.$InsertPayment->id.'<br/>'.$orderId;exit;
          // echo $orderId;exit;
            Session::put('orderId', $orderId);
          //Below Save whole data in Order Table for user to view in Dashboard and Empty Cart Tables.
            $columns=array();
            $columns['userId']=$userId;
            $columns['sessionId']=$sessionId;
            //echo "<pre>";print_r($columns);exit;
            $getLanguagesCartUpdated=CartLanguage::join('language_packages','cart_languages.language_package','=','language_packages.id')
                            ->select('cart_languages.*','language_packages.name as packageName','language_packages.id as packageId','language_packages.price_per_word as packagePrice')->where('cart_languages.status','Active')
                            ->where(function($query) use($columns) {
                                          $query->where('cart_languages.user_id', $columns['userId'])
                                          ->orWhere('cart_languages.session_id',  $columns['sessionId']);
                                    })->get();
            // dd($getLanguagesCartUpdated);exit;
            $getWordsCount=CartItem::where('status','Active')
                                  ->where(function($query) use($columns) {
                                           $query->where('user_id', $columns['userId'])
                                          ->orWhere('session_id',  $columns['sessionId']);
                                    })->sum('content_words');
             //echo $getWordsCount;exit;
            $getCartItems=CartItem::where('status','Active')
                                  ->where(function($query) use($columns) {
                                           $query->where('user_id', $columns['userId'])
                                          ->orWhere('session_id',  $columns['sessionId']);
                                    })->get();
           //echo count($getCartItems);exit;
            $totalPrice=0;
            $packagePrice=0;
            $packageName='';
            $totalWords=0;
            $totalLanguagePrice=0;

            $totalLanguages=count($getLanguagesCartUpdated);
            if(count($getLanguagesCartUpdated)){
              foreach($getLanguagesCartUpdated as $getLanguagesCartUpdate){
                $getLanguageData=LanguagePrice::join('languages','languages.id','=','language_prices.destination')->select('languages.name as destinationLang','language_prices.*')->where('language_prices.source',$getLanguagesCartUpdate->from_language_id)->where('language_prices.destination',$getLanguagesCartUpdate->to_language_id)->get();
                $price=(count($getLanguageData))?$getLanguageData[0]->price_per_word:0;               
                $destLanguage=(count($getLanguageData))?$getLanguageData[0]->destinationLang:'';      
                $totalLanguagePrice=($getWordsCount*$price);               
                $totalPrice=$totalPrice+$totalLanguagePrice;
              }
              $packageName=$getLanguagesCartUpdated[0]->packageName;
              $packageId=$getLanguagesCartUpdated[0]->packageId;
              $purpose=$getLanguagesCartUpdated[0]->purpose;
              //$packagePrice=$getLanguagesCartUpdated[0]->packagePrice;
              $packagePrice=($getWordsCount*$getLanguagesCartUpdated[0]->packagePrice);            
              $totalPrice=($totalPrice+$packagePrice);
            }

          //Insert Data in Project Table from Cart
            if(count($getLanguagesCartUpdated)){
              foreach($getLanguagesCartUpdated as $getLanguagesCartUpdate){
                
                  $createApplicationOrder= Project::Create([
                                  'user_id' => Auth::user()->id,
                                  'order_id' => $orderId,
                                  'from_lang_id'=>$getLanguagesCartUpdate->from_language_id,
                                  'to_lang_id'=>$getLanguagesCartUpdate->to_language_id,
                                  'language_price' => $totalLanguagePrice,
                                  'total_price' => ($totalPrice-$packagePrice),
                                  'package_price'=>$packagePrice,
                                  'final_price'=>$totalPrice,
                                  'language_package'=>$packageName,
                                  'translation_purpose' => $purpose,
                          ]);

                //Insert Cart Files In Project Files Table from Cart Items Table
                  $applicationId = $createApplicationOrder->id;
                  foreach($getCartItems as $getCartItem){
                    
                    if($getCartItem->file==null){
                      $fileName= $sessionId.(Auth::user()->id).'_text.txt';
                      $projectPath=base_path();
                      $projectPath=explode('project', $projectPath);
                      File::put($projectPath[0].'/uploads/files/'.$fileName,$getCartItem->content);
                      chmod($projectPath[0]."/uploads/files/".$fileName, 0777);
                    }else{
                      $fileName=$getCartItem->file;
                    }
                    $createApplicationFiles= ProjectFile::Create([
                                  'user_id' => Auth::user()->id,
                                  'order_id' => $orderId,
                                  'project_id' => $applicationId,
                                  'file_name'=>$fileName,
                                  'file_path'=>'/uploads/files',
                                  'content_words' => $getCartItem->content_words
                          ]);
                  }
                }
              
            //Delete Languages Cart Values After insertion in final application tables
              
              $columns=array();
              $columns['userId']=$userId;
              $columns['sessionId']=$sessionId;   
              $getLanguagesCartUpdated=CartLanguage::where(function($query) use($columns) {
                                              $query->where('user_id', $columns['userId'])
                                              ->orWhere('session_id', $columns['sessionId']);
                                        })->delete();
              $getCartItemsUpdated=CartItem::where(function($query) use($columns) {
                                              $query->where('user_id', $columns['userId'])
                                              ->orWhere('session_id', $columns['sessionId']);
                                        })->delete();
            }

            //Delete Languages Cart Values After insertion in final application tables
            
        
           return redirect('/translation-application/step-three')->with('success', 'Payment  done successfully.');
        } catch ( \Exception $e ) {
            return redirect('/translation-application/step-three')->withErrors('Error! Please Try again.');
        }
    }

    /**
      * Step one will get cart data step 3 on page load.
      * @param null 
      * @return Response
      * Created on: 31/01/2017
      * Updated on: 01/02/2017
    **/
    public function getCartPackages()
    {
      try {
            $dataUrl=url('/');                
            $url=explode('index.php',$dataUrl); 
            $sessionId =Session::getId();
            $userId=(Auth::user())?Auth::user()->id:0;            
            $columns=array();
            $columns['userId']=$userId;
            $columns['sessionId']=$sessionId;
            if($userId==0){
              $whereValue=$sessionId;
              $whereCondition='session_id';
              $getLanguagesCartUpdated=CartLanguage::join('language_packages','cart_languages.language_package','=','language_packages.id')->select('cart_languages.*','language_packages.name as packageName','language_packages.price_per_word as packagePrice')->where('cart_languages.status','Active')->where('cart_languages.'.$whereCondition,$whereValue)->get();
              $getWordsCount=CartItem::where('status','Active')->where($whereCondition,$whereValue)->sum('content_words');
            }else{
              $getLanguagesCartUpdated=CartLanguage::join('language_packages','cart_languages.language_package','=','language_packages.id')->select('cart_languages.*','language_packages.name as packageName','language_packages.price_per_word as packagePrice')->where('cart_languages.status','Active')->where(function($query) use($columns) {
                  $query->where('cart_languages.user_id', $columns['userId'])
                  ->orWhere('cart_languages.session_id', $columns['sessionId']);
                })->get();

              $getWordsCount=CartItem::where('status','Active')->where(function($query) use($columns) {
                                            $query->where('user_id', $columns['userId'])
                                            ->orWhere('session_id', $columns['sessionId']);
                                      })->sum('content_words');

            }
            $languageCartHtml='';
            $totalPrice=0;
            $packagePrice=0;
            $packageName='';
            $totalLanguages=count($getLanguagesCartUpdated);
            if(count($getLanguagesCartUpdated)){
              foreach($getLanguagesCartUpdated as $getLanguagesCartUpdate){
                $getLanguageData=LanguagePrice::join('languages','languages.id','=','language_prices.destination')->select('languages.name as destinationLang','language_prices.*')->where('language_prices.source',$getLanguagesCartUpdate->from_language_id)->where('language_prices.destination',$getLanguagesCartUpdate->to_language_id)->get();
                $price=(count($getLanguageData))?$getLanguageData[0]->price_per_word:0;
                $destLanguage=(count($getLanguageData))?$getLanguageData[0]->destinationLang:'';
                $totalPriceCalculated=($getWordsCount*$price);
                $totalPrice=$totalPrice+$totalPriceCalculated;
              }
              $packageName=$getLanguagesCartUpdated[0]->packageName;
              $purpose=$getLanguagesCartUpdated[0]->purpose;
              $packagePriceTotal=($getWordsCount*$getLanguagesCartUpdated[0]->packagePrice);         
              $totalPrice=($totalPrice+$packagePriceTotal);
            }
            $returnData=array($getWordsCount,$totalLanguages,'$'.$totalPrice,$packageName,$purpose);
            echo json_encode($returnData);exit;   

      } catch (\Exception $e) {   
              $result = [
                      'exception_message' => $e->getMessage()
               ];
              return view('errors.error', $result);
      }
    }

    /**
      * Step one will get cart data step 3 on page load.
      * @param status and cart language id   
      * @return Response
      * Created on: 01/01/2017
      * Updated on: 01/02/2017
    **/
    public function postCartPackages(Request $request)
    {
      try {
            $dataUrl=url('/');                
            $url=explode('index.php',$dataUrl); 
            $data=$request->all();
            $sessionId =Session::getId();
            $userId=(Auth::user())?Auth::user()->id:0;
            //Update Cart Languages with package and purpose now.
             $columns=array();
              $columns['userId']=$userId;
              $columns['sessionId']=$sessionId;
              //echo  $sessionId.'=='.$userId;exit;  
              if($userId==0){
                $whereValue=$sessionId;
                $whereCondition='session_id';
                
                $CartPackagesUpdate=CartLanguage::where($whereCondition,$whereValue)->update(['purpose'=>$data['purpose'],'language_package'=>$data['package']]);
                $getLanguagesCartUpdated=CartLanguage::join('language_packages','cart_languages.language_package','=','language_packages.id')->select('cart_languages.*','language_packages.name as packageName','language_packages.price_per_word as packagePrice')->where('cart_languages.status','Active')
                  ->where($whereCondition,$whereValue)->get();
                
                $getWordsCount=CartItem::where('status','Active')->where($whereCondition,$whereValue)->sum('content_words');
              }else{
                  $columns=array();
                  $columns['userId']=$userId;
                  $columns['sessionId']=$sessionId;

                  $CartPackagesUpdate=CartLanguage::where(function($query) use($columns) {
                  $query->where('cart_languages.user_id', $columns['userId'])
                  ->orWhere('cart_languages.session_id', $columns['sessionId']);
                })->update(['purpose'=>$data['purpose'],'language_package'=>$data['package']]);
              

                $getLanguagesCartUpdated=CartLanguage::join('language_packages','cart_languages.language_package','=','language_packages.id')->select('cart_languages.*','language_packages.name as packageName','language_packages.price_per_word as packagePrice')->where('cart_languages.status','Active')
                  ->where(function($query) use($columns) {
                      $query->where('cart_languages.user_id', $columns['userId'])
                      ->orWhere('cart_languages.session_id', $columns['sessionId']);
                    })->get();
                
                $getWordsCount=CartItem::where('status','Active')->where(function($query) use($columns) {
                                        $query->where('user_id', $columns['userId'])
                                        ->orWhere('session_id', $columns['sessionId']);
                                      })->sum('content_words');
              } 
            
            
            $languageCartHtml='';
            $totalPrice=0;
            $packagePrice=0;
            $packageName='';
            $totalLanguages=count($getLanguagesCartUpdated);
            $purpose='';
            $packageName='';
            if(count($getLanguagesCartUpdated)){
              foreach($getLanguagesCartUpdated as $getLanguagesCartUpdate){
                $getLanguageData=LanguagePrice::join('languages','languages.id','=','language_prices.destination')->select('languages.name as destinationLang','language_prices.*')->where('language_prices.source',$getLanguagesCartUpdate->from_language_id)->where('language_prices.destination',$getLanguagesCartUpdate->to_language_id)->get();
                $price=(count($getLanguageData))?$getLanguageData[0]->price_per_word:0;
                $destLanguage=(count($getLanguageData))?$getLanguageData[0]->destinationLang:'';
                $totalPriceCalculated=($getWordsCount*$price);
                $totalPrice=$totalPrice+$totalPriceCalculated;
              }
              $packageName=$getLanguagesCartUpdated[0]->packageName;
              $purpose=$getLanguagesCartUpdated[0]->purpose;
              $packagePricePerWord=$getLanguagesCartUpdated[0]->packagePrice;
              $packagePriceTotal=($getWordsCount*$getLanguagesCartUpdated[0]->packagePrice);         
              $totalPrice=($totalPrice+$packagePriceTotal);
            }
           // echo $getWordsCount;exit;
            $returnData=array($getWordsCount,$totalLanguages,'$'.$totalPrice,$packageName,$purpose);
            echo json_encode($returnData);exit;   

      } catch (\Exception $e) {   
              $result = [
                      'exception_message' => $e->getMessage()
               ];
              return view('errors.error', $result);
      }
    }

    /**
      * Save Gloosaries/instructions/styleguides/briefs data step 3.
      * @param null 
      * @return Response
      * Created on: 31/01/2017
      * Updated on: 01/02/2017
    **/
    
    public function postOptionalData(Request $request){
      
      try {
        $orderId = Session::get('orderId');
        $userId=(Auth::user())?Auth::user()->id:0;
        if(!$orderId){
          $latestOrder=Order::where('user_id',$userId)->orderBy('id','desc')->first();
          $orderId=($latestOrder!=null)?$latestOrder->id:0;
        }
        $data=$request->all();
        if(($orderId ==0) || ($userId ==0)){
          //Error
        }

        if($data['type']=='instruction'){
          //Save Data in project_instruction table          
          $checkInstruction=ProjectInstruction::where('order_id',$orderId)->first();

          if($checkInstruction != null){
            //Update Row
            //echo $data['tone'].'<br/>'.$data['instruction'];exit;
            $updateInstruction= ProjectInstruction::where('order_id',$orderId)
                                                ->update([
                                                          'tone'=>  $data['tone'],
                                                          'instruction'=>$data['instruction'],
                                                        ]);
          }else{
            //Insert Row
            $createInstruction= ProjectInstruction::Create([
                                  'user_id' => Auth::user()->id,
                                  'order_id' => $orderId,
                                  'tone'=>  $data['tone'],
                                  'instruction'=>$data['instruction'],
                                ]);
          }

        }
        if($data['type']=='brief'){
          $file=$data['briefs'];
          $filenames=array();
          if($file){
            $fileUploadedData =$this->uploadAssets($file);
            if(!empty($fileUploadedData[0])){
              foreach($fileUploadedData[0] as $filename){
                $createInstruction= ProjectBrief::Create([
                                      'user_id' => Auth::user()->id,
                                      'order_id' => $orderId,
                                      'file_name'=>  $filename,
                                      'file_path'=>'uploads/files/'
                                    ]);
              }
            }
          }
        }
        //Gloosaries
        if($data['type']=='gloosary'){
          $file=$data['gloosaries'];
          $filenames=array();
          if($file){
            $fileUploadedData =$this->uploadAssets($file);
            if(!empty($fileUploadedData[0])){
              foreach($fileUploadedData[0] as $filename){
                $createInstruction= ProjectGlossary::Create([
                                      'user_id' => Auth::user()->id,
                                      'order_id' => $orderId,
                                      'file_name'=>  $filename,
                                      'file_path'=>'uploads/files/'
                                    ]);
              }
            }
          }
        }
        //Styles
        if($data['type']=='style'){
          $file=$data['styles'];
          $filenames=array();
          if($file){
            $fileUploadedData =$this->uploadAssets($file);
            if(!empty($fileUploadedData[0])){
              foreach($fileUploadedData[0] as $filename){
                $createInstruction= ProjectStyle::Create([
                                      'user_id' => Auth::user()->id,
                                      'order_id' => $orderId,
                                      'file_name'=>  $filename,
                                      'file_path'=>'uploads/files/'
                                    ]);
              }
            }
          }
        }

        if($data['type']=='previous'){
          //Insert Row
            //$checkStyle=ProjectStyle::where('order_id',$orderId)->where('user_id',Auth::user()->id)->get();
            
            $createPrevious= ProjectStyle::Create([
                                  'user_id' => Auth::user()->id,
                                  'order_id' => $orderId,
                                  'file_name'=>  $data['previous_style'],
                                  'file_path'=>'uploads/files/'
                                ]);
            $createPrevious= ProjectGlossary::Create([
                                      'user_id' => Auth::user()->id,
                                      'order_id' => $orderId,
                                      'file_name'=>  $data['previous_gloosary'],
                                      'file_path'=>'uploads/files/'
                                    ]);
            $createPrevious= ProjectBrief::Create([
                                      'user_id' => Auth::user()->id,
                                      'order_id' => $orderId,
                                      'file_name'=>  $data['previous_brief'],
                                      'file_path'=>'uploads/files/'
                                    ]);
            $createPrevious= ProjectTranslator::Create([
                                      'user_id' => Auth::user()->id,
                                      'order_id' => $orderId,
                                      'translator_id'=>  $data['previous_translator'],
                                    ]);
   

        }
        $response=array('success');
        echo json_encode($response);exit;
      } catch (\Exception $e) {   
          $result = [
                      'exception_message' => $e->getMessage()
               ];
          return view('errors.error', $result);
      }

  }
  public function uploadAssets($file){
    
    $filenames=array();
    $fileUrl=array();
    foreach ($file as $key => $value){
      $validFiles=array('ppt','pptx','doc','docx','xls','xlsm','xlsx','rtf','odt','txt','pdf');
      $dummypath = $value->getClientOriginalName();
      $extention = pathinfo($dummypath, PATHINFO_EXTENSION);
      $fileType=$value->getMimeType();
      if (in_array($extention, $validFiles)) {
        $random=app('App\Http\Controllers\HomepageSectionController')->getRandomString(10);
        $fileName= $random.'_'.$value->getClientOriginalName();
        $filenames[]=$fileName;
        $projectPath=base_path();
        $projectPath=explode('project', $projectPath);
        $value->move($projectPath[0].'/uploads/files/',$fileName);
        chmod($projectPath[0].'/uploads/files/'.$fileName, 0777);
        $dataUrl=url('/');                
        $url=explode('index.php',$dataUrl);
        $fileUrl[]=$url[0].'/uploads/files/'.$fileName;
      }
    }
    $fileUploadedData=array($filenames,$fileUrl);
    return $fileUploadedData;
  }

    /**
      * Step one will Get Quote Info
      * @param null      
      * @return Response
      * Created on: 03/02/2017
      * Updated on: 03/02/2017
    **/
    public function getQuote()
    {
      try {
          $sessionId =Session::getId();
          $userId=(Auth::user())?Auth::user()->id:0;
          $dataUrl=url('/');                
          $url=explode('index.php',$dataUrl); 
          $columns=array();
              $columns['userId']=$userId;
              $columns['sessionId']=$sessionId;   
          $checkCompany=Company::where(function($query) use($columns) {
                                    $query->where('user_id',$columns['userId'])
                                    ->orWhere('session_id', $columns['sessionId']);
                                  })->first();
          $sections=Section::where('status','Active')->get();
          //Get Quote Data
          $sessionId =Session::getId();
          $userId=(Auth::user())?Auth::user()->id:0;  
          $getCartItems=CartItem::where('status','Active')
                                ->where(function($query) use($columns) {
                                    $query->where('user_id',$columns['userId'])
                                    ->orWhere('session_id', $columns['sessionId']);
                                  })->get();
          $getWordsCount=CartItem::where('status','Active')
                                    ->where(function($query) use($columns) {
                                                        $query->where('user_id', $columns['userId'])
                                                        ->orWhere('session_id', $columns['sessionId']);
                                      })->sum('content_words');

          $getLanguagesCartUpdated=CartLanguage::leftJoin('language_packages','cart_languages.language_package','=','language_packages.id')->join('languages','languages.id','=','cart_languages.to_language_id')->select('cart_languages.*','language_packages.name as packageName','language_packages.price_per_word as packagePrice','languages.name as destinationLanguage','languages.image as image')->where('cart_languages.status','Active')->where(function($query) use($columns) {
                                    $query->where('cart_languages.user_id', $columns['userId'])
                                    ->orWhere('cart_languages.session_id', $columns['sessionId']);
                                  })->get();
//echo "<pre>";print_r($getLanguagesCartUpdated);exit;
          //echo count($getLanguagesCartUpdated);exit;
          $languagesData=array();
          $count=1;
          if(count($getLanguagesCartUpdated)){
            foreach($getLanguagesCartUpdated as $key=>$getLanguagesCartUpdate){
              $image = ((!empty($getLanguagesCartUpdate)) ? $getLanguagesCartUpdate->image : ''); 
              if($image){
                $img=$url[0]."/uploads/".$getLanguagesCartUpdate->image;
              }else{
                $img = $url[0]."/customer/img/english-lang.jpg";
              } 
               $getLanguageData=LanguagePrice::join('languages','languages.id','=','language_prices.source')->select('languages.name as sourceLanguage','language_prices.*')->where('language_prices.source',$getLanguagesCartUpdate->from_language_id)->where('language_prices.destination',$getLanguagesCartUpdate->to_language_id)->get();
                $sourceLanguage=(count($getLanguageData))?$getLanguageData[0]->sourceLanguage:'';    
                $price=(count($getLanguageData))?$getLanguageData[0]->price_per_word:0;
                
                $totalPriceCalculated=($getWordsCount*$price);
                $languagesData[$key]['fromLanguage']=$sourceLanguage;
                $languagesData[$key]['destinationLanguage']=$getLanguagesCartUpdate->destinationLanguage;      
                $languagesData[$key]['perWordLanguagePrice']=$price;
                $languagesData[$key]['LanguagePrice']=$totalPriceCalculated;
                $languagesData[$key]['imagePath']=$img;
                $count++;
              }
          }           
          return view('customer.translation-application.quote',compact('sections','getCartItems','languagesData','checkCompany'));
        }
        catch (\Exception $e) 
        {   
            $result = [
                    'exception_message' => $e->getMessage()
             ];
            return view('errors.error', $result);
        }
    }
    public function postUserCompany(Request $request){
      
      try {
          $data=$request->all();
          $sessionId =Session::getId();
          $userId=(Auth::user())?Auth::user()->id:0;  
          $columns=array();
              $columns['userId']=$userId;
              $columns['sessionId']=$sessionId; 
          $checkCompany=Company::where(function($query) use($columns) {
                                    $query->where('user_id', $columns['userId'])
                                    ->orWhere('session_id', $columns['sessionId']);
                                  })->first();

          if($checkCompany != null){
            //Update Row
            $updateInstruction= Company::where(function($query) use($columns) {
                                                  $query->where('user_id', $columns['userId'])
                                                  ->orWhere('session_id', $columns['sessionId']);
                                                })->update([
                                                          'company'=>  $data['company'],
                                                          'address'=>$data['address'],
                                                        ]);
          }else{
            //Insert Row
            $createInstruction= Company::Create([
                                  'user_id' => $userId,
                                  'session_id' => $sessionId,
                                  'company'=>  $data['company'],
                                  'address'=>$data['address'],
                                ]);
          }
          echo json_encode(array('success'));exit;
          
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