<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use App\Section;
use App\CartItem;
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
          $sections=Section::get();
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
      * Updated on: 23/01/2017
    **/

    public function postCartUpdate(Request $request)
    {
      try {          
          $data=$request->all();
          $file  =  $request->file('files');
          $cartData=array();
          $CountedWords=0;
          $filenames=array();
          $fileWords=array();        
            
          if($file){
            foreach ($file as $key => $value){
                $fileType=$value->getMimeType();
                if($fileType=='application/pdf'){
                
                  $random=app('App\Http\Controllers\HomepageSectionController')->getRandomString(10);
                  $fileName= $random.'_'.$value->getClientOriginalName();
                  $filenames[]=$fileName;
                  $value->move('/var/www/html/eqho/uploads/files/',$fileName);
                  chmod('/var/www/html/eqho/uploads/files/'.$fileName, 0777);

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
          $userIp=(array_key_exists('HTTP_CLIENT_IP', $_SERVER)) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['REMOTE_ADDR'];
          if(Auth::user()){
            $getContentCart=CartItem::where('user_id',Auth::user()->id)->where('file',null)->first();
            $getFileCart=CartItem::where('user_id',Auth::user()->id)->where('file','!=',null)->get();
          }else{
            $getContentCart=CartItem::where('user_ip',$userIp)->where('file',null)->first();
            $getFileCart=CartItem::where('user_ip',$userIp)->where('file','!=',null)->get();
          }
          $CartDataFinal=array();
            


            $content_words=(isset($data['content']))?(str_word_count($data['content'])):0;
            
            if($content_words!=0){

              if(count($getContentCart)){
                //Update textarea content
                  $cartUpdate = CartItem::find($getCart[0]->id);
                  $cartUpdate->content = $content_words;
                  $section->save();

              }else{
                //insert textarea content
                  $insertCart= CartItem::Create([
                      'user_id' => (Auth::user())?Auth::user()->id:0,
                      'content' => (isset($data['content']))?$data['content']:'',
                      'file'=>null,
                      'file_path'=> null,
                      'content_words'=>$content_words,
                      'total_words'=>($CountedWords+$content_words),
                      'user_ip'=>$userIp
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
                        'user_ip'=>$userIp
                      ]);
                }

            }
          
          if(Auth::user()){
            $getContentCartUpdated=CartItem::where('user_id',Auth::user()->id)->where('file',null)->where('status','Active')->first();
            $getFileCartUpdated=CartItem::where('user_id',Auth::user()->id)->where('file','!=',null)->where('status','Active')->get();
          }else{
            $getContentCartUpdated=CartItem::where('user_ip',$userIp)->where('file',null)->where('status','Active')->first();
            $getFileCartUpdated=CartItem::where('user_ip',$userIp)->where('file','!=',null)->where('status','Active')->get();
          }
          
          $totalWordsCounted=0;
          $cartHtml='<table border="0">';
          if($getContentCartUpdated != null){
            if($getContentCartUpdated->content){
              $cartHtml .='<tr>
                        <td class="type"><img src="http://localhost/eqho/customer/img/plain-text.png" title="plain-text" alt="plain-text"></td>
                        <td class="perview">text...</td>
                        <td class="switch"><span class="words">'.$getContentCartUpdated->content_words.' words</span><span class="close"><a href="#" title="Edit">Edit</a><i class="fa fa-times-circle-o" onclick="trashElement('.$getContentCartUpdated->id.');" aria-hidden="true"></i></span></td>
                      </tr>';
              $totalWordsCounted=($totalWordsCounted+$getContentCartUpdated->content_words);
            }
           $content_words=$getContentCartUpdated->content;
          }else{
            $content_words='';
          }
          if(count($getFileCartUpdated)){
            foreach($getFileCartUpdated as $key=>$file){
                $cartHtml .='<tr>
                        <td class="type"><img src="http://localhost/eqho/customer/img/acrobat.png" title="acrobat" alt="acrobat" /></td>
                        <td class="perview">'.$file->file.'</td>
                        <td class="switch"><span class="words">'.$file->content_words.' words</span><span class="close"><i class="fa fa-times-circle-o" onclick="trashElement('.$getFileCartUpdated->id.');" aria-hidden="true"></i></span></td>
                      </tr>';
                $totalWordsCounted=($totalWordsCounted+$file->content_words);
            }
        }
        $cartHtml .='<tr>
                      <td class="type"><img src="http://localhost/eqho/customer/img/multiple-docs.png" title="multiple-docs" alt="multiple-docs" /></td>
                      <td class="perview">'.(count($getFileCartUpdated)+count($getContentCartUpdated)).' Items</td>
                      <td class="switch"><span class="switch_total">'.$totalWordsCounted.'</span> words</td>
                    </tr>';
          $cartHtml .='</table>';

          // Get Trashed Items Of The Cart And Update It In Trashed Div
          if(Auth::user()){
            $getContentCartTrashed=CartItem::where('user_id',Auth::user()->id)->where('file',null)->where('status','Trashed')->get();
            $getFileCartTrashed=CartItem::where('user_id',Auth::user()->id)->where('file','!=',null)->where('status','Trashed')->get();
          }else{
            $getContentCartTrashed=CartItem::where('user_ip',$userIp)->where('file',null)->where('status','Trashed')->get();
            $getFileCartTrashed=CartItem::where('user_ip',$userIp)->where('file','!=',null)->where('status','Trashed')->get();
          }
          
          $totalWordsCountedTrashed=0;
          $cartHtmlTrashed='<table border="0">';
          if($getContentCartTrashed != null){
            if($getContentCartTrashed->content){
              $cartHtmlTrashed .='<tr>
                        <td class="type"><img src="http://localhost/eqho/customer/img/plain-text.png" title="plain-text" alt="plain-text"></td>
                        <td class="perview">text...</td>
                        <td class="switch"><span class="words">'.$getContentCartTrashed[0]->content_words.' words</span><span class="close"><a href="#" title="Edit">Edit</a> <span onclick="trashElement('.$getContentCartTrashed[0]->id.')"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span></span></td>
                      </tr>';
              $totalWordsCountedTrashed=($totalWordsCountedTrashed+$getContentCartTrashed[0]->content_words);
            }
           $content_wordsTrashed=$getContentCartUpdated->content;
          }else{
            $content_wordsTrashed='';
          }
          if(count($getFileCartTrashed)){
            foreach($getFileCartTrashed as $key=>$file){
                $cartHtmlTrashed .='<tr>
                        <td class="type"><img src="http://localhost/eqho/customer/img/acrobat.png" title="acrobat" alt="acrobat" /></td>
                        <td class="perview">'.$file->file.'</td>
                        <td class="switch"><span class="words">'.$file->content_words.' words</span><span class="close"><span onclick="trashElement('.$getFileCartTrashed->id.')"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span></span></td>
                      </tr>';
                $totalWordsCountedTrashed=($totalWordsCountedTrashed+$file->content_words);
            }
        }
        $cartHtmlTrashed .='<tr>
                      <td class="type"><img src="http://localhost/eqho/customer/img/multiple-docs.png" title="multiple-docs" alt="multiple-docs" /></td>
                      <td class="perview">'.(count($getFileCartTrashed)+count($getContentCartTrashed)).' Items</td>
                      <td class="switch"><span class="switch_total">'.$totalWordsCountedTrashed.'</span> words</td>
                    </tr>';
          $cartHtmlTrashed .='</table>';
          $returnData=array($content_words,$cartHtml,$cartHtmlTrashed,$content_wordsTrashed);
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
      * @param Request data            
      * @return Response
      * Created on: 20/01/2017
      * Updated on: 23/01/2017
    **/
    
    public function getCartUpdate($itemId=null,$restore=null)
    {
      try {
        if(($itemId) && !($restore)){
          $getContentCartUpdated=CartItem::where('id',$itemId )->update(['status'=>'Trashed']);
        }
        if(($itemId) && ($restore)){
          $getContentCartUpdated=CartItem::where('id',$itemId )->update(['status'=>'Active']);
        }

        $userIp=(array_key_exists('HTTP_CLIENT_IP', $_SERVER)) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['REMOTE_ADDR'];
        if(Auth::user()){
            $getContentCartUpdated=CartItem::where('user_id',Auth::user()->id)->where('file',null)->where('status','Active')->first();
            $getFileCartUpdated=CartItem::where('user_id',Auth::user()->id)->where('file','!=',null)->where('status','Active')->get();
          }else{
            $getContentCartUpdated=CartItem::where('user_ip',$userIp)->where('file',null)->where('status','Active')->first();
            $getFileCartUpdated=CartItem::where('user_ip',$userIp)->where('file','!=',null)->where('status','Active')->get();
          }
          $totalWordsCounted=0;
          $cartHtml='<table border="0">';
          if($getContentCartUpdated != null){
            if($getContentCartUpdated->content){
              $cartHtml .='<tr>
                        <td class="type"><img src="http://localhost/eqho/customer/img/plain-text.png" title="plain-text" alt="plain-text"></td>
                        <td class="perview">text...</td>
                        <td class="switch"><span class="words">'.$getContentCartUpdated->content_words.' words</span><span class="close"><a href="#" title="Edit">Edit</a> <i class="fa fa-times-circle-o" onclick="trashElement('.$getContentCartUpdated->id.');" aria-hidden="true" ></i></span></td>
                      </tr>';
              $totalWordsCounted=($totalWordsCounted+$getContentCartUpdated->content_words);
            }
            $content_words=$getContentCartUpdated->content;
          }else{
            $content_words='';
          }
          if(count($getFileCartUpdated)){
            foreach($getFileCartUpdated as $key=>$file){
                $cartHtml .='<tr>
                        <td class="type"><img src="http://localhost/eqho/customer/img/acrobat.png" title="acrobat" alt="acrobat" /></td>
                        <td class="perview">'.$file->file.'</td>
                        <td class="switch"><span class="words">'.$file->content_words.' words</span><span class="close"><span class="close"><i class="fa fa-times-circle-o" onclick="trashElement('.$file->id.');" aria-hidden="true"></i></span></td>
                      </tr>';
                $totalWordsCounted=($totalWordsCounted+$file->content_words);
            }
        }
        $cartHtml .='<tr>
                      <td class="type"><img src="http://localhost/eqho/customer/img/multiple-docs.png" title="multiple-docs" alt="multiple-docs" /></td>
                      <td class="perview">'.(count($getFileCartUpdated)+count($getContentCartUpdated)).' Items</td>
                      <td class="switch"><span class="switch_total">'.$totalWordsCounted.'</span> words</td>
                    </tr>';
          $cartHtml .='</table>';

          // Get Trashed Items Of The Cart And Update It In Trashed Div
          if(Auth::user()){
            $getContentCartTrashed=CartItem::where('user_id',Auth::user()->id)->where('file',null)->where('status','Trashed')->first();
            $getFileCartTrashed=CartItem::where('user_id',Auth::user()->id)->where('file','!=',null)->where('status','Trashed')->get();
          }else{
            $getContentCartTrashed=CartItem::where('user_ip',$userIp)->where('file',null)->where('status','Trashed')->first();
            $getFileCartTrashed=CartItem::where('user_ip',$userIp)->where('file','!=',null)->where('status','Trashed')->get();
          }
          
          $totalWordsCountedTrashed=0;
          $cartHtmlTrashed='<table border="0">';
          if($getContentCartTrashed != null){
            if($getContentCartTrashed->content){
              $cartHtmlTrashed .='<tr>
                        <td class="type"><img src="http://localhost/eqho/customer/img/plain-text.png" title="plain-text" alt="plain-text"></td>
                        <td class="perview">text...</td>
                        <td class="switch"><span class="words">'.$getContentCartTrashed->content_words.' words</span><span class="close"><a href="#" title="Edit">Edit</a><i class="fa fa-undo" onclick="restoreElement('.$getContentCartTrashed->id.');" aria-hidden="true"></i></span></td>
                      </tr>';
              $totalWordsCountedTrashed=($totalWordsCountedTrashed+$getContentCartTrashed->content_words);
            }
           $content_wordsTrashed=$getContentCartTrashed->content;
          }else{
            $content_wordsTrashed='';
          }
          if(count($getFileCartTrashed)){
            foreach($getFileCartTrashed as $key=>$file){
                $cartHtmlTrashed .='<tr>
                        <td class="type"><img src="http://localhost/eqho/customer/img/acrobat.png" title="acrobat" alt="acrobat" /></td>
                        <td class="perview">'.$file->file.'</td>
                        <td class="switch"><span class="words">'.$file->content_words.' words</span><span class="close"><i class="fa fa-undo" onclick="restoreElement('.$file->id.');" aria-hidden="true"></i></span></td>
                      </tr>';
                $totalWordsCountedTrashed=($totalWordsCountedTrashed+$file->content_words);
            }
        }
        $cartHtmlTrashed .='<tr>
                      <td class="type"><img src="http://localhost/eqho/customer/img/multiple-docs.png" title="multiple-docs" alt="multiple-docs" /></td>
                      <td class="perview">'.(count($getFileCartTrashed)+count($getContentCartTrashed)).' Items</td>
                      <td class="switch"><span class="switch_total">'.$totalWordsCountedTrashed.'</span> words</td>
                    </tr>';
          $cartHtmlTrashed .='</table>';
          $returnData=array($content_words,$cartHtml,$cartHtmlTrashed,$content_wordsTrashed);
          echo json_encode($returnData);exit;

      }catch (\Exception $e){   
        
        $result = [
                    'exception_message' => $e->getMessage()
             ];
        return view('errors.error', $result);
      }
    }
    
}