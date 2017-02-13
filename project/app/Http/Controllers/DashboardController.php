<?php namespace App\Http\Controllers;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Input;
use App\User;
use App\Order;
use App\Project;
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
          if(Session::get('currentUrl')){
            
            return redirect(Session::get('currentUrl'));

          }else{
            switch(Auth::user()->role_id){
              case 1:
                $theme='backend/';
                $usertype='superadmin';
              break;
              case 2:
                $theme='backend/';
                $usertype='management';
              break;
              case 3:
                $theme='customer/';
                $usertype='customer';
              break;
              case 4:
                $theme='backend/';
                $usertype='translator';
              break;
              default:
                $theme='customer/';
                $usertype='customer';
              break;
            }
            $paymentsCount=Order::count();
            $usersCount=User::where('role_id' ,'!=',1)->count();
            $pendingsCount=Project::where('status','Pending')->count();
            $approvedCount=Project::where('status','Approved')->count();
            
            $usersGraph=User::get();
            $u_2016=0;  $u_2017=0;  $u_2018=0;  $u_2019=0;  $u_2020=0;
            foreach($usersGraph as $users){
              if(date('Y', strtotime($users->created_at))==2016){
                  $u_2016=$u_2016+1;
              }
              if(date('Y', strtotime($users->created_at))==2017){
                  $u_2017=$u_2017+1;
              }
              if(date('Y', strtotime($users->created_at))==2018){
                  $u_2018=$u_2018+1;
              }
              if(date('Y', strtotime($users->created_at))==2019){
                  $u_2019=$u_2019+1;
              }
              if(date('Y', strtotime($users->created_at))==2020){
                  $u_2020=$u_2020+1;
              }
            }
            $ordersGraph=Order::get();
            $o_2016=0;  $o_2017=0;  $o_2018=0;  $o_2019=0;  $o_2020=0;
            foreach($ordersGraph as $orders){
              if(date('Y', strtotime($orders->created_at))==2016){
                  $o_2016=$o_2016+1;
              }
              if(date('Y', strtotime($orders->created_at))==2017){
                  $o_2017=$o_2017+1;
              }
              if(date('Y', strtotime($orders->created_at))==2018){
                  $o_2018=$o_2018+1;
              }
              if(date('Y', strtotime($orders->created_at))==2019){
                  $o_2019=$o_2019+1;
              }
              if(date('Y', strtotime($orders->created_at))==2020){
                  $o_2020=$o_2020+1;
              }
            }
            $userGraphCount=array($u_2016,$u_2017,$u_2018,$u_2019,$u_2020);
            $orderGraphCount=array($o_2016,$o_2017,$o_2018,$o_2019,$o_2020);
            //echo "<pre>";print_r($userGraphCount);exit;
            return view($theme.'dashboard/'.$usertype.'/dashboard',compact('paymentsCount','usersCount','pendingsCount','approvedCount','usersGrapData','userGraphCount','orderGraphCount'));
          }            
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