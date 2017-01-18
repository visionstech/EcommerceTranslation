<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use App\Section;

class HomeController extends Controller {
	
    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller manages user's profile.
    |
    */

    public function __construct(Guard $auth)
    {
        $this->middleware('auth', ['except' => 'index']);
        $this->auth = $auth;
    }
	
    /**
      * By default controller calls this method.
      * @param int $id            
      * @return Response
      * Created on: 17/01/2016
      * Updated on: 17/01/2016
    **/
    public function index()
    {
      try {
          $sections=Section::get();
          return view('customer.home',compact('sections'));
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