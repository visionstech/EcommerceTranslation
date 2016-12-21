<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Contracts\Auth\Guard;
use Auth;

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
      * Created on: 21/12/2016
      * Updated on: 21/12/2016
    **/
    public function index()
    {   
        //return view('theme');
      try {
            if(Auth::user())
            {  
                return redirect('/dashboard');
            }
            else 
            {  
                return redirect('/index.php/auth/login');
            }
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
