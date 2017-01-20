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
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller manages user's profile.
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
      * Updated on: 20/01/2017
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
      * Updated on: 20/01/2017
    **/

    public function postStepOne(Request $request)
    {
      try {
        
          $data=$request->all();
          $file  =  $request->file('file');
          if($file){
            $file->move('/var/www/html/eqho/uploads/files/',$file->getClientOriginalName());
            chmod('/var/www/html/eqho/uploads/files/'.$file->getClientOriginalName(), 0777);
            $dataUrl=url('/');                
            $url=explode('index.php',$dataUrl);
            $fileUrl=$url[0].'uploads/'.$file->getClientOriginalName();
            $contents = File::get('uploads/files/'.$file->getClientOriginalName());
            $number_of_words=count(explode(' ', $contents));
            echo 'Number of Words in File "defaultPoup.html" are : '.$number_of_words;
          }
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