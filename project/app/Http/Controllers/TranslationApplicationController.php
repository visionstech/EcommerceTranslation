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
use App\Application;
use App\ApplicationFile;
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
          if(Auth::user()){
              $whereColumn='user_id';
              $whereValue=Auth::user()->id;
          }else{
              $whereColumn='session_id';
              $whereValue=$sessionId;
          }        
            
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
          $getContentCart=CartItem::where($whereColumn,$whereValue)->where('file',null)->first();
          $getFileCart=CartItem::where($whereColumn,$whereValue)->where('file','!=',null)->get();
          
          $CartDataFinal=array();
          
          $content_words=(isset($data['content']))?(str_word_count($data['content'])):0;
            
            if($content_words!=0){

              if($getContentCart != null){
                //Update textarea content
                  $cartUpdate = CartItem::find($getContentCart->id);
                  $cartUpdate->content = (isset($data['content']))?$data['content']:'';
                  $cartUpdate->save();

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
          
          $getContentCartUpdated=CartItem::where($whereColumn,$whereValue)->where('file',null)->where('status','Active')->first();
          $getFileCartUpdated=CartItem::where($whereColumn,$whereValue)->where('file','!=',null)->where('status','Active')->get();
          
          
          $totalWordsCounted=0;
          $cartHtml='<table border="0">';
          if($getContentCartUpdated != null){
            if($getContentCartUpdated->content){
              $cartHtml .='<tr>
                        <td class="type"><img src="'.$url[0].'/customer/img/plain-text.png" title="plain-text" alt="plain-text"></td>
                        <td class="perview">text...</td>
                        <td class="switch"><span class="words">'.$getContentCartUpdated->content_words.' words</span><span class="close"><a href="#" onclick="editContent();" title="Edit">Edit</a><i class="fa fa-times-circle-o" onclick="trashElement('.$getContentCartUpdated->id.');" aria-hidden="true"></i></span></td>
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
                        <td class="type"><img src="'.$url[0].'/customer/img/acrobat.png" title="acrobat" alt="acrobat" /></td>
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
          $getContentCartTrashed=CartItem::where($whereColumn,$whereValue)->where('file',null)->where('status','Trashed')->first();
          $getFileCartTrashed=CartItem::where($whereColumn,$whereValue)->where('file','!=',null)->where('status','Trashed')->get();
          
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
                $cartHtmlTrashed .='<tr>
                        <td class="type"><img src="'.$url[0].'/customer/img/acrobat.png" title="acrobat" alt="acrobat" /></td>
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
          $returnData=array($content_words,$cartHtml,$cartHtmlTrashed,$content_wordsTrashed,$totalDeletedItems);
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
        if(Auth::user()){
            $whereColumn='user_id';
            $whereValue=Auth::user()->id;
        }else{
            $whereColumn='session_id';
            $whereValue=$sessionId;
        }
        if(($restore) && !($itemId)){
            if($restore=='delete_permanently'){
              $deletePermanent=CartItem::where($whereColumn,$whereValue)->where('status','Trashed')->delete(); 
            }else{
              $deleteAll=CartItem::where($whereColumn,$whereValue)->delete();  
            }
        }
        if(($itemId) && ($restore)){
          $UpdateStatus=CartItem::where('id',$itemId )->update(['status'=>$restore]);
        }

        $getContentCartUpdated=CartItem::where($whereColumn,$whereValue)->where('file',null)->where('status','Active')->first();
        $getFileCartUpdated=CartItem::where($whereColumn,$whereValue)->where('file','!=',null)->where('status','Active')->get();

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
                $cartHtml .='<tr>
                        <td class="type"><img src="'.$url[0].'/customer/img/acrobat.png" title="acrobat" alt="acrobat" /></td>
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
          
          $getContentCartTrashed=CartItem::where($whereColumn,$whereValue)->where('file',null)->where('status','Trashed')->first();
          $getFileCartTrashed=CartItem::where($whereColumn,$whereValue)->where('file','!=',null)->where('status','Trashed')->get();
          
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
                $cartHtmlTrashed .='<tr>
                        <td class="type"><img src="'.$url[0].'/customer/img/acrobat.png" title="acrobat" alt="acrobat" /></td>
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
          
          $returnData=array($content_words,$cartHtml,$cartHtmlTrashed,$content_wordsTrashed,$totalDeletedItems);
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
            if(Auth::user()){
                $whereColumn='user_id';
                $whereValue=Auth::user()->id;
            }else{
                $whereColumn='session_id';
                $whereValue=$sessionId;
            }
            
            if(isset($data['to_language_id'])){
              foreach($data['to_language_id'] as $toLanguage){

                $getLanguagesCart=CartLanguage::where($whereColumn,$whereValue)->where('from_language_id',$data['from_language_id'])->where('to_language_id',$toLanguage)->get();
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

            $getLanguagesCartUpdated=CartLanguage::where($whereColumn,$whereValue)->get();
            $getWordsCount=CartItem::where($whereColumn,$whereValue)->sum('content_words');
            //echo $getWordsCount;exit;
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
            if(Auth::user()){
                $whereColumn='user_id';
                $whereValue=Auth::user()->id;
            }else{
                $whereColumn='session_id';
                $whereValue=$sessionId;
            }
            if($status=='Deleted'){
              $deleteCart=CartLanguage::where($whereColumn,$whereValue)->delete();
            }
            if(($status=='Trashed') || ($status=='Active')){
              $trashCart=CartLanguage::where('id',$cartLangId)->update(['status'=>$status]);
            }
            
            $getLanguagesCartUpdated=CartLanguage::where($whereColumn,$whereValue)->get();
            $getWordsCount=CartItem::where($whereColumn,$whereValue)->sum('content_words');
            $CountCartActive=CartLanguage::where($whereColumn,$whereValue)->where('status','Active')->count();

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
        
        $getLanguageData=LanguagePrice::join('languages','languages.id','=','language_prices.destination')->select('languages.name as destinationLang','language_prices.*')->where('language_prices.source',$from_language_id)->get();

        $validHtml='<ul class="eqho-clear-fix">';
        if(count($getLanguageData)){
          foreach($getLanguageData as $getLanguageDat){
              $validHtml .='<li id="selectedLangs_'.$getLanguageDat->destination.'" data-id="'.$getLanguageDat->destination.'"><img src="'.$url[0].'/customer/img/chines-flag.png" alt="'.$getLanguageDat->destinationLang.'" title="'.$getLanguageDat->destinationLang.'"> '.$getLanguageDat->destinationLang.'</li>';
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
          $currency_input = 2;
          //currency codes : http://en.wikipedia.org/wiki/ISO_4217
          $currency_from = "USD";
          $currency_to = "INR";
          //$this->getConvertedCurrency($currency_from,$currency_to,$currency_input);
          
          $sections=Section::where('status','Active')->get();
          $languages=Language::where('status','Active')->get();
          $languagePackages=LanguagePackage::all();
          return view('customer.translation-application.step-three',compact('sections','languages','languagePackages'));
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
            $InsertPayment=\Stripe\Charge::create ( array (
                    "amount" => ($amount[1]*100),
                    "currency" => "usd",
                    "source" => $data['stripeToken'], // obtained with Stripe.js
                    "description" => "Test payment." 
            ));
            
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
                //Here email to user with this password below:

            }
          //payment insertion
            $status='success';
            $insertOrder= Order::Create([
                      'user_id' => Auth::user()->id,
                      'transaction_id' => $InsertPayment->id,
                      'payment_status'=>$status,
                      'payment_type'=>$data['stripeTokenType']
                    ]);

            $orderId = $insertOrder->id;
          
          //Below Save whole data in Order Table for user to view in Dashboard and Empty Cart Tables.
            $sessionId =Session::getId();
            
            $getLanguagesCartUpdated=CartLanguage::join('language_packages','cart_languages.language_package','=','language_packages.id')
                            ->select('cart_languages.*','language_packages.name as packageName','language_packages.id as packageId','language_packages.price_per_word as packagePrice')
                            ->where('cart_languages.user_id', Auth::user()->id)
                            ->orWhere('cart_languages.session_id',$sessionId)
                            ->where('cart_languages.status','Active')->get();
            $getWordsCount=CartItem::where('user_id', Auth::user()->id)
                            ->orWhere('session_id',$sessionId)
                            ->where('status','Active')
                            ->sum('content_words');
            $getCartItems=CartItem::where('user_id', Auth::user()->id)
                            ->orWhere('session_id',$sessionId)
                            ->where('status','Active')
                            ->get();
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
              $packagePrice=$getLanguagesCartUpdated[0]->packagePrice;              
              $totalPrice=($totalPrice+$packagePrice);
            }

          //Insert Data in Application Table from Cart
            if(count($getLanguagesCartUpdated)){
              foreach($getLanguagesCartUpdated as $getLanguagesCartUpdate){
                
                  $createApplicationOrder= Application::Create([
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

                //Insert Cart Files In application Files Table from Cart Items Table
                  $applicationId = $createApplicationOrder->id;
                  foreach($getCartItems as $getCartItem){
                    
                    if($getCartItem->file==null){
                      $fileName= $sessionId.'_text.txt';
                      File::put('/var/www/html/eqho/uploads/files/'.$fileName,$getCartItem->content);
                      chmod("/var/www/html/eqho/uploads/files/test3.txt", 0777);
                    }else{
                      $fileName=$getCartItem->file;
                    }
                    $createApplicationFiles= ApplicationFile::Create([
                                  'user_id' => Auth::user()->id,
                                  'order_id' => $orderId,
                                  'application_id' => $applicationId,
                                  'file_name'=>$fileName,
                                  'file_path'=>'/uploads/files',
                                  'content_words' => $getCartItem->content_words
                          ]);
                  }
                }
              
            //Delete Languages Cart Values After insertion in final application tables
              
              //$getLanguagesCartUpdated=CartLanguage::where('user_id', Auth::user()->id)->orWhere('session_id',$sessionId)->delete();
              //$getCartItemsUpdated=CartItem::where('user_id', Auth::user()->id)->orWhere('session_id',$sessionId)->delete();
            }
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
            if(Auth::user()){
                $whereColumn='user_id';
                $whereValue=Auth::user()->id;
            }else{
                $whereColumn='session_id';
                $whereValue=$sessionId;
            }
            
            $getLanguagesCartUpdated=CartLanguage::join('language_packages','cart_languages.language_package','=','language_packages.id')->select('cart_languages.*','language_packages.name as packageName','language_packages.price_per_word as packagePrice')->where('cart_languages.'.$whereColumn,$whereValue)->where('cart_languages.status','Active')->get();

            $getWordsCount=CartItem::where($whereColumn,$whereValue)->sum('content_words');
            
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
              $packagePrice=$getLanguagesCartUpdated[0]->packagePrice;              
              $totalPrice=($totalPrice+$packagePrice);
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
            if(Auth::user()){
                $whereColumn='user_id';
                $whereValue=Auth::user()->id;
            }else{
                $whereColumn='session_id';
                $whereValue=$sessionId;
            }
            //Update Cart Languages with package and purpose now.
            $CartPackagesUpdate=CartLanguage::where($whereColumn,$whereValue)->update(['purpose'=>$data['purpose'],'language_package'=>$data['package']]);
              

            $getLanguagesCartUpdated=CartLanguage::join('language_packages','cart_languages.language_package','=','language_packages.id')->select('cart_languages.*','language_packages.name as packageName','language_packages.price_per_word as packagePrice')->where('cart_languages.'.$whereColumn,$whereValue)->where('cart_languages.status','Active')->get();
            
            $getWordsCount=CartItem::where($whereColumn,$whereValue)->sum('content_words');
            
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
              $packagePrice=$getLanguagesCartUpdated[0]->packagePrice;          
              $totalPrice=($totalPrice+$packagePrice);
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
}