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
            $file  =  $request->file('image');
            if($file){
              $validWidth=30;
              $validHeight=20;
              $imageType=explode('image/',$file->getMimeType());
              $imageTitle=explode('.'.$imageType[1],$file->getClientOriginalName());
              $imageTitle=$imageTitle[0];
              $random = app('App\Http\Controllers\HomepageSectionController')->getRandomString(20);
              $imgName = 'flag_'.$random.'.'.$imageType[1];
              $destinationPath = url('/').'/uploads';
              $projectPath=base_path();
              $projectPath=explode('/project', $projectPath);
              $file->move($projectPath[0].'/uploads/', $imgName);
              chmod($projectPath[0].'/uploads/'.$imgName, 0777);
              $dataUrl=url('/');                
              $url=explode('index.php',$dataUrl);
              $dimentions=list($width, $height) = getimagesize($url[0].'uploads/'.$imgName);
              $actualWidth=$dimentions[0];
              $actualHeight=$dimentions[1];
              if(($actualWidth>$validWidth) || ($actualHeight>$validHeight)){
                //Invalid Size For How It Works Section
                return redirect('language-management/add-language/'.$data['languageId'])->withErrors('Image width and height should be less then '.$validWidth.' pixels.');
              }
            }
            if($data['languageId']==''){
                // Create new role
                $create_language = Language::create([
                    'name' => $data['name'],
                    'short' => $data['short'],
                    'image'=>$imgName,
                    'image_path'=>'/uploads'
                ]);
                $action='added';
            }else{
                $GetData = Language::where('id',decrypt($data['languageId']))->get();
                $file  =  $request->file('image');
                if(!$file){
                  $imgName=$GetData[0]->image;
                }
                $language = Language::find(decrypt($data['languageId']));
                $language->name = $data['name'];
                $language->short = $data['short']; 
                $language->image = $imgName;    
                $language->image_path = '/uploads';          
                $language->status = $data['status'];       
                $language->updated_by = Auth::user()->id;
                $language->updated_ip = (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['REMOTE_ADDR'];
                $language->save();
                $action='updated';
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
            return redirect('language-management')->with('error', 'You are not autorize to delete this language.');
        }
        //Soft Delete Language
        $msg=($status=='Active')?'Activated':'Deleted';
        $updateUser=Language::where('id',decrypt($languageId))->update(array('status'=>$status));
        return redirect('language-management')->with('success', 'Language '.$msg.' Successfully.');
      }catch (\Exception $e){   
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }
}