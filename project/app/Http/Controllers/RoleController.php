<?php 
namespace App\Http\Controllers;


use App\Events\UserManageAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Input;
use App\Role;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use Session;
use DB;

class RoleController extends Controller {
  
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
      * List all the roles          
      * @return Response
      * Created on: 11/01/2017
      * Updated on: 11/01/2017
    **/

    public function getIndex()
    {
      try {
        $roles=Role::get();
        return view('backend.role.roles', compact('roles'));
      }catch (\Exception $e){   
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }

    /**
      * Return get Add Role Form.
      * @param   
      * @return Response
      * Created on: 11/01/2017
      * Updated on: 11/01/2017
    **/
    public function getAddRole($roleId=null)
    {
      try {
        $roleDetail=array();
        if($roleId !=''){
            $roleDetail=Role::where('id',decrypt($roleId))->get()->toArray(); 
        }
        $roles=Role::all();
        return view('backend/role/add_role',compact('roles','roleDetail','roleId'));
      }catch (\Exception $e) 
      {
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }

    /**
      * Add role from admin.
      * @param Request $request            
      * @return Response
      * Created on: 11/01/2017
      * Updated on: 11/01/2017
    **/
    public function postAddRole(Requests\ManageRole $request)
    {
      try {
            $data = $request->all();
            if($data['roleId']==''){
                // Create new role
                $create_role = Role::create([
                    'role' => $data['role'],
                    'status' => $data['status']
                ]);
                $action='added';
            }else{
                $GetData = Role::where('id',decrypt($data['roleId']))->get();
                $user = Role::find(decrypt($data['roleId']));
                $user->role = $data['role'];
                $user->status = $data['status'];        
                $user->updated_by = Auth::user()->id;
                $user->updated_ip = (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['REMOTE_ADDR'];
                $user->save();
                $action='updated';
            }
            return redirect()->back()->with('success', 'Role '.$action.' Successfully.');
        }
        catch (\Exception $e) 
        {   
            $result = ['exception_message' => $e->getMessage()];
            return view('errors.error', $result);
        }
    }

    /**
      * Return Delete Role.
      * @param  Role id and Delete Status         
      * @return Response
      * Created on: 11/01/2017
      * Updated on: 11/01/2017
    **/
    public function getDeleteRole($roleId=null,$status=null)
    {
      try {
        if(($status=='') || (($status !='Deleted') && ($status !='Active') && ($status !='Deactive'))){
            return redirect('role')->with('error', 'You are not autorize to delete this role.');
        }
        //Soft Delete User's Role
        $msg=($status=='Active')?'Activated':'Deactivated';
        $updateUser=Role::where('id',decrypt($roleId))->update(array('status'=>$status));
        return redirect('role')->with('success', 'Role '.$msg.' Successfully.');
      }catch (\Exception $e){   
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }
}