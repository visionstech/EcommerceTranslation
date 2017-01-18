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
use Socialite;

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
      //echo url('/');exit;
        $this->middleware('auth', ['except' => 'getSocialRedirect','getSocialCallback']);
        $this->auth = $auth;
    } 

    /**
      * Shows the User dashboard.
      * @param         
      * @return Response
      * Created on: 17/01/2017
      * Updated on: 17/01/2017
    **/
    public function getIndex()
    {
        try { 
            //Redirect to dashboard according to roles
            switch(Auth::user()->role_id){
              case 1:
                $usertype='superadmin';
              break;
              case 2:
                $usertype='management';
              break;
              case 3:
                $usertype='customer';
              break;
              case 4:
                $usertype='translator';
              break;
              default:
                $usertype='customer';
              break;
            }
            return view('dashboard/'.$usertype.'/dashboard');
        }
        catch (\Exception $e) 
        {   
            $result = ['exception_message' => $e->getMessage()];
            return view('errors.error', $result);
        }
    }

    /**
      * Redirect to social login page
      * @param         
      * @return Response
      * Created on: 21/12/2016
      * Updated on: 21/12/2016
    **/
    public function getSocialRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
      * Response from social login site
      * @param         
      * @return Response
      * Created on: 21/12/2016
      * Updated on: 21/12/2016
    **/

    public function getSocialCallback()
    {
      $providerUser = \Socialite::driver('facebook')->user();
      echo "<pre>";print_r($providerUser);exit;
    }

    /**
      * test function Shows the File content and counting of words
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