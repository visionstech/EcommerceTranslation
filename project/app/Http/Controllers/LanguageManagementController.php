<?php 
namespace App\Http\Controllers;


use App\Events\UserManageAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Input;
use App\Language;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use Session;
use DB;

class LanguageManagementController extends Controller {
  
    /*
    |--------------------------------------------------------------------------
    | Language Management Controller
    |--------------------------------------------------------------------------
    |
    | This controller manages Languages From admin panel.
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
      * List all the Languages          
      * @return Response
      * Created on: 23/01/2017
      * Updated on: 23/01/2017
    **/

    public function getIndex()
    {
      try {
        $languages=Language::get();
        return view('backend.language-management.languages', compact('languages'));
      }catch (\Exception $e){   
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }

    /**
      * Return get Add Language Form.
      * @param   
      * @return Response
      * Created on: 23/01/2017
      * Updated on: 23/01/2017
    **/
    public function getAddLanguage($languageId=null)
    {
      try {
        $languageDetail=array();
        if($languageId !=''){
            $languageDetail=Language::where('id',decrypt($languageId))->get()->toArray(); 
        }
        return view('backend/language-management/add_language',compact('languageDetail','languageId'));
      }catch (\Exception $e) 
      {
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }

    /**
      * Add Languages from admin.
      * @param Request $request            
      * @return Response
      * Created on: 23/01/2017
      * Updated on: 23/01/2017
    **/
    public function postAddLanguage(Requests\ManageLanguage $request)
    {
      try {
            $data = $request->all();
            if($data['languageId']==''){
                // Create new role
                $create_language = Language::create([
                    'name' => $data['name'],
                    'short' => $data['short']
                ]);
                $action='Added';
            }else{
                $GetData = Language::where('id',decrypt($data['languageId']))->get();
                $language = Language::find(decrypt($data['languageId']));
                $language->name = $data['name'];
                $language->short = $data['short'];       
                $language->status = $data['status'];       
                $language->updated_by = Auth::user()->id;
                $language->updated_ip = (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['REMOTE_ADDR'];
                $language->save();
                $action='Updated';
            }
            return redirect()->back()->with('success', 'Language '.$action.' Successfully.');
        }
        catch (\Exception $e) 
        {   
            $result = ['exception_message' => $e->getMessage()];
            return view('errors.error', $result);
        }
    }

    /**
      * Return Delete Language.
      * @param  Language id and Delete Status         
      * @return Response
      * Created on: 23/01/2017
      * Updated on: 23/01/2017
    **/
    public function getDeleteLanguage($languageId=null,$status=null)
    {
      try {
        if(($status=='') || (($status !='Deleted') && ($status !='Active'))){
            return redirect('language-management')->with('error', 'You are not autorize to delete this role.');
        }
        //Soft Delete Language
        $updateUser=Language::where('id',decrypt($languageId))->update(array('status'=>$status));
        return redirect('language-management')->with('success', 'Language '.$status.' Successfully.');
      }catch (\Exception $e){   
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }
}