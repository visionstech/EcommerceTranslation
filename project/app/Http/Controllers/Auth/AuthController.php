<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use Session;
use View;
use Auth;
use Hash;
use App\User;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'getLogout']);
        $this->auth = $auth;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6|confirmed',
            'terms'   => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    
    /**
      * Return registration form.    
      * @return Response
      * Created on: 21/12/2016
      * Updated on: 21/12/2016
    **/
    public function getRegister()
    {
        try {   
            //Login
            return view('auth.register');
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
      * Register user and save details.
      * @param Request $request            
      * @return Response
      * Created on: 21/12/2016
      * Updated on: 21/12/2016
    **/
    public function postRegister(Requests\NewUser $request)
    {
        try {
            //Register Customer User
            $create_user = User::create([
                  'email' => $request->email,
                  'password' => bcrypt($request->password),
                  'role' => $request->usertype
              ]);
            //Login Automatically User Functionality
            $credentials = array(
                'email' => $request->email,
                'password' => $request->password
            );

            if($this->auth->attempt($credentials))
            {
                if((Auth::user()->role == 3) || (Auth::user()->role == 4))
                {
                    return redirect('/dashboard');
                }
                else 
                {
                    return redirect('/');
                }
            }
            Session::put('message', 'User Registered Successfully!');
            return redirect()->back();
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
        * Verify that user is authenticated or not.
        * @param Request $request            
        * @return Response
        * Created on: 21/12/2016
        * Updated on: 21/12/2016
    **/
    public function postLogin(Requests\AuthenticateUser $request)
    {
        try {
            //Login
          $credentials = array(
            'email' => $request->email,
            'password' => $request->password
            );
            $checkStatus=User::where('email',$request->email)->get();
            if(count($checkStatus)){
            if($checkStatus[0]->status=='Active'){
              
                if($this->auth->attempt($credentials))
                { 
                    return redirect('/dashboard');
                }
                else
                {   echo "sssssssss1";exit;
                    return redirect()->back()->withErrors('These credentials do not match our records.');
                }
            }else{
                return redirect()->back()->withErrors('These credentials do not match our records.');
            }
            
            }else{

                return redirect()->back()->withErrors('These credentials do not match our records.');
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
    
    /**
      * Log out the user from dashboard.
      * @param int $id            
      * @return Response
      * Created on: 21/12/2016
      * Updated on: 21/12/2016
    **/

    public function getLogout()
    {   
        try {
                $this->auth->logout();
                Session::flush();
                return redirect('/auth/login');
        }
        catch (\Exception $e) 
        { 
            $result = [
                'exception_message' => $e->getMessage()
            ];
            print_r($e->getMessage());
            return view('errors.error', $result);
        }

    }
}