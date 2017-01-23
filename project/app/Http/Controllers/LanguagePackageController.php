<?php 
namespace App\Http\Controllers;


use App\Events\UserManageAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Input;
use App\LanguagePackage;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use Session;
use DB;

class LanguagePackageController extends Controller {
  
    /*
    |--------------------------------------------------------------------------
    | Language Package Controller
    |--------------------------------------------------------------------------
    |
    | This controller Manages Language Packages.
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
      * List all the packages          
      * @return Response
      * Created on: 23/01/2017
      * Updated on: 23/01/2017
    **/

    public function getIndex()
    {
      try {
        $languagePackages=LanguagePackage::get();
        return view('backend.language-package.packages', compact('languagePackages'));
      }catch (\Exception $e){   
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }

    /**
      * Return get Add package Form.
      * @param   packageId
      * @return Response
      * Created on: 23/01/2017
      * Updated on: 23/01/2017
    **/
    public function getAddPackage($packageId=null)
    {
      try {
        $packageDetail=array();
        if($packageId !=''){
            $packageDetail=LanguagePackage::where('id',decrypt($packageId))->get()->toArray(); 
        }
        return view('backend/language-package/add_languagePackage',compact('packageDetail','packageId'));
      }catch (\Exception $e) 
      {
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }

    /**
      * Add packages from admin.
      * @param Request $request            
      * @return Response
      * Created on: 11/01/2017
      * Updated on: 11/01/2017
    **/
    public function postAddPackage(Requests\ManageLanguagePackage $request)
    {
      try {
            $data = $request->all();
            if($data['packageId']==''){
                // Create new role
                $create_language = LanguagePackage::create([
                    'name' => $data['name'],
                    'price_per_word' => $data['price_per_word'],
                    'description' => $data['description']
                ]);
                $action='Added';
            }else{
                $languagePackage = LanguagePackage::find(decrypt($data['packageId']));
                $languagePackage->name = $data['name'];
                $languagePackage->short = $data['short'];       
                $languagePackage->status = $data['status'];       
                $languagePackage->updated_by = Auth::user()->id;
                $languagePackage->updated_ip = (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['REMOTE_ADDR'];
                $languagePackage->save();
                $action='Updated';
            }
            return redirect()->back()->with('success', 'Language package'.$action.' Successfully.');
        }
        catch (\Exception $e) 
        {   
            $result = ['exception_message' => $e->getMessage()];
            return view('errors.error', $result);
        }
    }

    /**
      * Return Delete package.
      * @param  package id and Delete Status         
      * @return Response
      * Created on: 11/01/2017
      * Updated on: 11/01/2017
    **/
    public function getDeleteLanguage($languageId=null,$status=null)
    {
      try {
        if(($status=='') || (($status !='Deleted') && ($status !='Active'))){
            return redirect('language-management')->with('error', 'You are not autorize to delete this role.');
        }
        //Soft Delete Language
        $updateUser=Language::where('id',decrypt($languageId))->update(array('status'=>$status));
        return redirect('language-package')->with('success', 'Language '.$status.' Successfully.');
      }catch (\Exception $e){   
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }
}