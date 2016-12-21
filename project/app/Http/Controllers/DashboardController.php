<?php namespace App\Http\Controllers;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Input;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use Session;
use Auth;
use DB;
use File;


class DashboardController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Dashboard Controller
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
        $this->middleware('auth', ['except' => 'getRegister, postRegister']);
        $this->auth = $auth;
    } 

    /**
      * Shows the User dashboard.
      * @param         
      * @return Response
      * Created on: 21/12/2016
      * Updated on: 21/12/2016
    **/
    public function getIndex()
    {
        try { 
            //Redirect to dashboard according to roles
            return view('dashboard/dashboard');
        }
        catch (\Exception $e) 
        {   
            $result = ['exception_message' => $e->getMessage()];
            return view('errors.error', $result);
        }
    }

    /**
      * Shows the File content
      * @param         
      * @return Response
      * Created on: 21/12/2016
      * Updated on: 21/12/2016
    **/
    public function getFile()
    {
      //Redirect to dashboard according to roles
      $filename="http://localhost/eqho/defaultPoup.html";
      $contents = File::get("defaultPoup.html");
      $number_of_words=count(explode(' ', $contents));
      echo 'Number of Words in File "defaultPoup.html" are : '.$number_of_words;
      exit;
    }

}