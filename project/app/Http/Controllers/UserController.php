<?php 
namespace App\Http\Controllers;


use App\Events\UserManageAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Input;
use App\User;
use App\Role;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use Session;
use DB;
use Redirect;
//use Illuminate\Encryption\BaseEncrypter;

class UserController extends Controller {
  
    /*
    |--------------------------------------------------------------------------
    | User Controller
    |--------------------------------------------------------------------------
    |
    | This controller manages user's profile.
    |
    */
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
      $this->middleware(['auth','admin'] );
      $this->auth = $auth;
      
    }

    /**
      * List all the users          
      * @return Response
      * Created on: 11/01/2017
      * Updated on: 11/01/2017
    **/

    public function getIndex()
    {     
      try {
        $users=User::where('role_id','!=',1)->get();
        return view('backend.user.users', compact('users'));
      }catch (\Exception $e){   
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }

    /**
      * Return get Add User Form.
      * @param   
      * @return Response
      * Created on: 11/01/2017
      * Updated on: 11/01/2017
    **/
    public function getAddUser($userId=null)
    {
      try {
        $userDetail=array();
        if($userId !=''){
            $userDetail=User::where('id',decrypt($userId))->get()->toArray(); 
        }
        $roles=Role::all();
        return view('backend/user/add_user',compact('roles','userDetail','userId'));
      }catch (\Exception $e) 
      {
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }

    /**
      * Add user of any type of role.
      * @param Request $request            
      * @return Response
      * Created on: 11/01/2017
      * Updated on: 11/01/2017
    **/
    public function postAddUser(Requests\ManageUser $request)
    {
      try {
            $data = $request->all();
            if($data['userId']==''){
                $randomPassword=$this->getRandomString(10);
                // Create new user
                $create_user = User::create([
                    'email' => $data['email'],
                    'password' => bcrypt($randomPassword),
                    'role_id' => $data['role'],
                    'status' => $data['status']
                ]);
                
                //event(new UserManageAction($emailData));
                $action='added';
            }else{
                $GetData = User::where('id',decrypt($data['userId']))->get();
                $user = User::find(decrypt($data['userId']));
                $user->email = $data['email'];
                $user->role_id = $data['role'];
                $user->status = $data['status'];                
                $user->updated_by = Auth::user()->id;
                $user->updated_ip = (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['REMOTE_ADDR'];
                $user->save();
                $action='updated';
            }
            return redirect()->back()->with('success', 'User '.$action.' Successfully.');
        }
        catch (\Exception $e) 
        {   
            $result = ['exception_message' => $e->getMessage()];
            return view('errors.error', $result);
        }
    }

    /**
      * Return Delete User.
      * @param  User id and Delete Status(Suspended or Deleted)         
      * @return Response
      * Created on: 11/01/2017
      * Updated on: 11/01/2017
    **/
    public function getDeleteUser($userId=null,$status=null)
    {
      try {
        if(($status=='') || (($status !='Deleted') && ($status !='Active'))){
            return redirect('user')->with('error', 'You are not autorize to delete this user.');
        }
        $msg=($status=='Active')?'Activated':'Deleted';
        //Soft Delete Users
        $updateUser=User::where('id',decrypt($userId))->update(array('status'=>$status));
        return redirect('user')->with('success', 'User '.$msg.' Successfully.');
      }catch (\Exception $e){   
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }

    /**
      * Generates Random String Will be used as Strong Password Generator.
      * @param Length $length of Password            
      * @return Response
      * Created on: 11/01/2017
      * Updated on: 11/01/2017
    **/

    public function getRandomString($length=null){
        
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ)(!@_-+=$%$^&*';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}