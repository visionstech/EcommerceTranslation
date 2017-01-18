<?php 
namespace App\Http\Controllers;


use App\Events\UserManageAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Input;
use App\Section;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use Session;
use DB;
use Redirect;

class HomepageSectionController extends Controller {
  
    /*
    |--------------------------------------------------------------------------
    | Homepage Section Controller
    |--------------------------------------------------------------------------
    |
    | This controller manages Homepage Sections Dynamically From Admin
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
      * List all the data of promises section          
      * @return Response
      * Created on: 18/01/2017
      * Updated on: 18/01/2017
    **/
    public function getOurPromises()
    {     
      try {
        $ourPromises=Section::where('section_type','our-promises')->get();
        return view('backend.sections.our-promises.viewOurPromises', compact('ourPromises'));
      }catch (\Exception $e){   
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }

    /**
      * Show the Form of add promise          
      * @return Response
      * Created on: 18/01/2017
      * Updated on: 18/01/2017
    **/

    public function getAddOurPromise($ourPromisesId=null)
    {     
      try {
        $ourPromises=array();
        if($ourPromisesId !=''){
            $ourPromises=Section::where('section_type','our-promises')->where('id',decrypt($ourPromisesId))->first(); 
        }
        return view('backend.sections.our-promises.add_OurPromises',compact('ourPromises','ourPromisesId'));
      }catch (\Exception $e) 
      {
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }

    /**
      * Submit the Form of add/Edit promise          
      * @return Response
      * Created on: 18/01/2017
      * Updated on: 18/01/2017
    **/

    public function postAddOurPromise(Requests\ManagePromise $request)
    {     
        try {
            $data = $request->all();
            if($data['ourPromisesId']==''){

                $create_OurPromise = Section::create([
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'section_type'=>'our-promises'
                ]);
                $action='Added';
            }else{
                $GetData = Section::where('id',decrypt($data['ourPromisesId']))->get();
                $section = Section::find(decrypt($data['ourPromisesId']));
                $section->title = $data['title'];
                $section->description = $data['description'];
                $section->section_type = 'our-promises';                
                $section->updated_by = Auth::user()->id;
                $section->updated_ip = (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['REMOTE_ADDR'];
                $section->save();
                $action='Updated';
            }
            return redirect('homepage-section/our-promises')->with('success', 'Our Promise '.$action.' Successfully.');
        }
        catch (\Exception $e) 
        {   
            $result = ['exception_message' => $e->getMessage()];
            return view('errors.error', $result);
        }
    }

    /**
      * List all the data of how it works section          
      * @return Response
      * Created on: 18/01/2017
      * Updated on: 18/01/2017
    **/
    public function getHowItWorks()
    {     
      try {
        $howItWorks=Section::where('section_type','how-it-works')->get();
        return view('backend.sections.how-it-works.viewHowItWorks', compact('howItWorks'));
      }catch (\Exception $e){   
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }

     /**
      * Show the Form of add how it works          
      * @return Response
      * Created on: 18/01/2017
      * Updated on: 18/01/2017
    **/

    public function getAddHowItWorks($howItWorksId=null)
    {     
      try {
        $howItWorks=array();
        if($howItWorksId !=''){
            $howItWorks=Section::where('section_type','how-it-works')->where('id',decrypt($howItWorksId))->first(); 
        }
        return view('backend.sections.how-it-works.add_HowItWorks',compact('howItWorks','howItWorksId'));
      }catch (\Exception $e) 
      {
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }

    /**
      * Submit the Form of add/Edit how it works        
      * @return Response
      * Created on: 18/01/2017
      * Updated on: 18/01/2017
    **/

    public function postAddHowItWorks(Requests\ManageHowItWorks $request)
    {     
        try {
            $data = $request->all();
            if($data['howItWorksId']==''){

                $create_OurPromise = Section::create([
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'section_type'=>'how-it-works'
                ]);
                $action='Added';
            }else{
                $GetData = Section::where('id',decrypt($data['howItWorksId']))->get();
                $section = Section::find(decrypt($data['howItWorksId']));
                $section->title = $data['title'];
                $section->description = $data['description'];
                $section->section_type = 'how-it-works';                
                $section->updated_by = Auth::user()->id;
                $section->updated_ip = (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['REMOTE_ADDR'];
                $section->save();
                $action='Updated';
            }
            return redirect('homepage-section/how-it-works')->with('success', 'How It Works '.$action.' Successfully.');
        }
        catch (\Exception $e) 
        {   
            $result = ['exception_message' => $e->getMessage()];
            return view('errors.error', $result);
        }
    }

    /**
      * Return Delete Record.
      * @param  User id and Delete Status(Suspended or Deleted)         
      * @return Response
      * Created on: 11/01/2017
      * Updated on: 11/01/2017
    **/
    public function getDeleteSection($Id=null,$status=null,$type=null)
    {
      try {
        if(($status=='') || (($status !='Deleted') && ($status !='Active'))){
            return redirect('user')->with('error', 'You are not autorize to delete this user.');
        }
        //Soft Delete Users
        $updateSection=Section::where('id',decrypt($Id))->update(array('status'=>$status));
        return redirect('homepage-section/'.$type)->with('success', 'Section '.$status.' Successfully.');
      }catch (\Exception $e){   
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }
}