<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use App\Section;
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

    public function postStepOne(Request $request)
    {
      try {
       
          $data=$request->all();
          $file  =  $request->file('file');

          $CountedWords=0;
          if($file){            
            foreach ($file as $key => $value) {
                $value->move('/var/www/html/eqho/uploads/files/',$value->getClientOriginalName());
                chmod('/var/www/html/eqho/uploads/files/'.$value->getClientOriginalName(), 0777);
                $dataUrl=url('/');                
                $url=explode('index.php',$dataUrl);
                $fileUrl=$url[0].'uploads/'.$value->getClientOriginalName();
                $contents = File::get('uploads/files/'.$value->getClientOriginalName());
                $number_of_words=count(explode(' ', $contents));
                echo $number_of_words.'<br>';
                $CountedWords  += $number_of_words;
            }
          }
          echo 'Total Number of Words in Files are : '.$CountedWords.'<br/>';
          echo 'Total number of words from Textarea are :'.str_word_count($data['content']).'<br/>';
          echo 'Final Total:'.($CountedWords+str_word_count($data['content']));
         exit;
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