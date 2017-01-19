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

    public function getViewSections($sectionType=null)
    {
      try {
        if(($sectionType !='how-it-works') && ($sectionType !='our-promises') && ($sectionType !='faqs') && ($sectionType !='features') && ($sectionType !='eqho-by-numbers') && ($sectionType !='clients')){
          return view('errors.404');
        }
        switch($sectionType){
          case  'our-promises';
            $view='our-promises.viewOurPromises';
          break;
          case 'how-it-works';
            $view='how-it-works.viewHowItWorks';
          break;
          case 'faqs';
            $view='faqs.viewFaqs';
          break;
          case 'features';
            $view='features.viewFeatures';
          break;
          case 'eqho-by-numbers';
            $view='eqho-by-numbers.viewEqhoByNumbers';
          break;
          case 'clients';
            $view='clients.viewClients';
          break;
          default:
            $view='our-promises.viewOurPromises';
          break;
        }
        $sections=Section::where('section_type',$sectionType)->get();
        return view('backend.sections.'.$view, compact('sections'));
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

    public function getAddSection($sectionType=null,$sectionId=null)
    {     
      try {
        if(($sectionType !='how-it-works') && ($sectionType !='our-promises') && ($sectionType !='faqs') && ($sectionType !='features') && ($sectionType !='eqho-by-numbers') && ($sectionType !='clients')){
          return view('errors.404');
        }
        switch($sectionType){
          case  'our-promises';
            $view='our-promises.add_OurPromises';
          break;
          case 'how-it-works';
            $view='how-it-works.add_HowItWorks';
          break;
          case 'faqs';
            $view='faqs.add_Faqs';
          break;
          case 'features';
            $view='features.add_Features';
          break;
          case 'eqho-by-numbers';
            $view='eqho-by-numbers.add_EqhoByNumbers';
          break;
          case 'clients';
            $view='clients.add_Clients';
          break;
          default:
            $view='our-promises.add_OurPromises';
          break;
        }
        $sections=array();
        if($sectionId !=''){
            $section=Section::where('section_type',$sectionType)->where('id',decrypt($sectionId))->first(); 
        }
        return view('backend.sections.'.$view,compact('section','sectionId'));
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

    public function postAddSection(Requests\ManageSection $request,$sectionType=null)
    {
        try {
            if(($sectionType !='how-it-works') && ($sectionType !='our-promises') && ($sectionType !='faqs') && ($sectionType !='features') && ($sectionType !='eqho-by-numbers') && ($sectionType !='clients')){
              return view('errors.404');
            }
            
            switch($sectionType){
              case  'our-promises';
                $redirect='homepage-section/view-sections/our-promises';
              break;
              case 'how-it-works';
                $width=70;
                $height=70;
                $redirect='homepage-section/view-sections/how-it-works';
              break;
              case 'faqs';
                $redirect='homepage-section/view-sections/faqs';
              break;
              case 'features';
                $width=102;
                $height=142;
                $redirect='homepage-section/view-sections/features';
              break;
              case 'eqho-by-numbers';
                $width=190;
                $height=190;
                $redirect='homepage-section/view-sections/eqho-by-numbers';
              break;
              case 'clients';
                $width=250;
                $height=250;
                $redirect='homepage-section/view-sections/clients';
              break;
              default:
                $redirect='homepage-section/view-sections/our-promises';
              break;
            }
            $imgName='';
            $imageTitle='';
            if(($sectionType =='how-it-works') || ($sectionType =='clients') || ($sectionType =='features') || ($sectionType == 'eqho-by-numbers')){

                $file  =  $request->file('image');
                if($file){
                  $imageType=explode('image/',$file->getMimeType());
                  $imageTitle=explode('.'.$imageType[1],$file->getClientOriginalName());
                  $imageTitle=$imageTitle[0];

                  $imgName = $sectionType.'_'.$this->getRandomString(20).'.'.$imageType[1];
                  $destinationPath = url('/').'/uploads';
                  $file->move('/var/www/html/eqho/uploads/', $imgName);
                  chmod('/var/www/html/eqho/uploads/'.$imgName, 0777);
                  $dataUrl=url('/');                
                  $url=explode('index.php',$dataUrl);
                  $dimentions=list($width, $height) = getimagesize($url[0].'uploads/'.$imgName);
                  $actualWidth=$dimentions[0];
                  $actualHeight=$dimentions[1];
                   
                  if(($actualWidth>$width) || ($actualHeight>$height)){
                    //Invalid Size For How It Works Section
                    return redirect('homepage-section/add-section/'.$sectionType)->withErrors('Image width and height should be less then '.$width.' pixels.');
                  }
                }
            }

            $data = $request->all();
            if($data['sectionId']==''){
              //Insert Section Data
                $create_OurPromise = Section::create([
                    'title' => (isset($data['title']))?$data['title']:'',
                    'description' => (isset($data['description']))?$data['description']:'',
                    'section_type'=>$sectionType,
                    'image'=>$imgName,
                    'image_title'=>$imageTitle,
                    'image_path'=>'/uploads'
                ]);
                $action='Added';
            }else{
              //Update Section Data
                $GetData = Section::where('id',decrypt($data['sectionId']))->get();
                $file  =  $request->file('image');
                if(!$file){
                  $imgName=$GetData[0]->image;
                  $imageTitle=$GetData[0]->image_title;
                }
                $section = Section::find(decrypt($data['sectionId']));
                $section->title = (isset($data['title']))?$data['title']:'';
                $section->description = (isset($data['description']))?$data['description']:'';
                $section->section_type = $sectionType;                
                $section->updated_by = Auth::user()->id;
                $section->image = $imgName;
                $section->image_title = $imageTitle;
                $section->image_path = '/uploads';
                $section->updated_ip = (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['REMOTE_ADDR'];
                $section->save();
                $action='Updated';
            }
            return redirect($redirect)->with('success', 'Section '.$action.' Successfully.');
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
    public function getDeleteSection($Id=null,$status=null,$sectionType=null)
    {
      try {
        if(($status=='') || (($status !='Deleted') && ($status !='Active'))){
            return redirect('user')->with('error', 'You are not autorize to delete this user.');
        }
        if(($sectionType !='how-it-works') && ($sectionType !='our-promises') && ($sectionType !='faqs') && ($sectionType !='features') && ($sectionType !='eqho-by-numbers') && ($sectionType !='clients')){
            return view('errors.404');
        }
        //Soft Delete Sections
        $updateSection=Section::where('id',decrypt($Id))->update(array('status'=>$status));
        return redirect('homepage-section/view-sections/'.$sectionType)->with('success', 'Section '.$status.' Successfully.');
      }catch (\Exception $e){   
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }

    public function getRandomString($length=null){
        
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}