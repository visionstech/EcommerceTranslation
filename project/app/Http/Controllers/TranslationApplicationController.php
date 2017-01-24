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
      * Step one will post form of Translation application submit.
      * @param Request data            
      * @return Response
      * Created on: 20/01/2017
      * Updated on: 23/01/2017
    **/

    public function postCartUpdate(Request $request)
    {
      try {

          
          $data=$request->all();
          $file  =  $request->file('file');
          $cartData=array();
          $CountedWords=0;
          if($file){
            $filenames=array();
            $fileWords=array();   
            foreach ($file as $key => $value){

                $fileType=$value->getMimeType();
                if($fileType=='application/pdf'){
                
                  $random=app('App\Http\Controllers\HomepageSectionController')->getRandomString(20);
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
         /* echo 'Total Number of Words in Files are : '.$CountedWords.'<br/>';
          echo 'Total number of words from Textarea are :'.str_word_count($data['content']).'<br/>';
          echo 'Final Total:'.($CountedWords+str_word_count($data['content']));*/
                   

          //Cart Update Data
          $userIp=(array_key_exists('HTTP_CLIENT_IP', $_SERVER)) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['REMOTE_ADDR'];
          $getCart=CartItem::where('user_ip',$userIp)->get();
          $CartDataFinal=array();

          if(count($getCart)){ 
            
          
          }else{
            //Insert Cart
            
            $content_words=(isset($data['content']))?(str_word_count($data['content'])):0;
            if($content_words!=0){
                 $insertCart= CartItem::Create([
                      'user_id' => Auth::user()->id,
                      'content' => (isset($data['content']))?$data['content']:'',
                      'file'=> null,
                      'file_path'=> null,
                      'content_words'=>$content_words,
                      'total_words'=>($CountedWords+$content_words),
                      'user_ip'=>$userIp
                    ]);

            }
            if($filenames){
                foreach($filenames as $key=>$file){
                  $insertCart= CartItem::Create([
                        'user_id' => Auth::user()->id,
                        'content' => (isset($data['content']))?$data['content']:'',
                        'file'=> $file,
                        'file_path'=> 'uploads/files',
                        'content_words'=>$fileWords[$key],
                        'total_words'=>($CountedWords+$content_words),
                        'user_ip'=>$userIp
                      ]);
                }

            }
           
          }
          $getCartUpdated=CartItem::where('user_ip',$userIp)->get();
          
          $cartHtml='<table border="0">';
          if(count($getCartUpdated)>0){
            if($getCartUpdated[0]->content){
              $cartHtml .='<tr>
                        <td class="type"><img src="http://localhost/eqho/customer/img/plain-text.png" title="plain-text" alt="plain-text"></td>
                        <td class="perview">text...</td>
                        <td class="switch"><span class="words">'.$getCartUpdated[0]->content_words.' words</span><span class="close"><a href="#" title="Edit">Edit</a> <i class="fa fa-times-circle-o" aria-hidden="true"></i></span></td>
                      </tr>';
            }
          }
          if(count($getCartUpdated)>1){
            foreach($getCartUpdated as $key=>$file){
              if($key>0){
                $cartHtml .='<tr>
                        <td class="type"><img src="http://localhost/eqho/customer/img/acrobat.png" title="acrobat" alt="acrobat" /></td>
                        <td class="perview">Acrobat.pdf</td>
                        <td class="switch"><span class="words">'.$file->content_words.' words</span><span class="close"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span></td>
                      </tr>';
              }
            }
          }
          $cartHtml .='<tr>
                      <td class="type"><img src="http://localhost/eqho/customer/img/multiple-docs.png" title="multiple-docs" alt="multiple-docs" /></td>
                      <td class="perview">'.count($getCartUpdated).' Items</td>
                      <td class="switch"><span class="switch_total">'.$getCartUpdated[0]->total_words.'</span> words</td>
                    </tr>';
          $cartHtml .='</table>';
          echo $cartHtml;exit;
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