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
}