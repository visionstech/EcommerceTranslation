<?php 
namespace App\Http\Controllers;


use App\Events\UserManageAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Input;
use App\Language;
use App\LanguagePrice;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use Session;
use DB;

class LanguagePriceController extends Controller {
  
    /*
    |--------------------------------------------------------------------------
    | Language Price Controller
    |--------------------------------------------------------------------------
    |
    | This controller manages Language Translate Prices.
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
      * List all the Language prices          
      * @return Response
      * Created on: 23/01/2017
      * Updated on: 23/01/2017
    **/

    public function getIndex()
    {
      try {       
        $language_prices=LanguagePrice::join('languages','languages.id','=','language_prices.source')->select('languages.name as sourceLang','language_prices.*')->get();

        $destination=LanguagePrice::join('languages','languages.id','=','language_prices.destination')->select('languages.name as destinatioLang')->get();

        return view('backend.language-price.languagePrices', compact('language_prices','destination'));
      }catch (\Exception $e){   
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }

    /**
      * Return get Add Language price form.
      * @param   
      * @return Response
      * Created on: 23/01/2017
      * Updated on: 23/01/2017
    **/
    public function getAddLanguagePrice($priceId=null)
    {
      try {
        $priceDetail=array();
        if($priceId !=''){
            $priceDetail=LanguagePrice::where('id',decrypt($priceId))->get()->toArray(); 
        }
        $languages=Language::all();
        return view('backend/language-price/add_languagePrice',compact('priceDetail','priceId','languages'));
      }catch (\Exception $e) 
      {
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }

    /**
      * Add/Edit Language price from admin.
      * @param Request $request            
      * @return Response
      * Created on: 23/01/2017
      * Updated on: 23/01/2017
    **/
    public function postAddLanguagePrice(Requests\ManageLanguagePrice $request)
    {
      try {
            $data = $request->all();
            
            if($data['priceId']==''){
                $GetCheckData=LanguagePrice::where('source',$data['source'])->where('destination',$data['destination'])->count();
                if($GetCheckData>0){
                    return redirect()->back()->withErrors('This Language Price already exists.');
                }
                // Create new Price
                $create_language = LanguagePrice::create([
                    'source' => $data['source'],
                    'destination' => $data['destination'],
                    'price_per_word' => $data['price_per_word'],
                    'status' => $data['status'],
                ]);

                $action='added';
            }else{
                $GetCheckData=LanguagePrice::where('source',$data['source'])->where('destination',$data['destination'])->where('id','!=',decrypt($data['priceId']))->count();
                if($GetCheckData>0){
                    return redirect()->back()->withErrors('This Language Price already exists.');
                }
                $languagePrice = LanguagePrice::find(decrypt($data['priceId']));
                $languagePrice->source = $data['source'];
                $languagePrice->destination = $data['destination'];
                $languagePrice->price_per_word = $data['price_per_word'];     
                $languagePrice->status = $data['status'];       
                $languagePrice->updated_by = Auth::user()->id;
                $languagePrice->updated_ip = (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['REMOTE_ADDR'];
                $languagePrice->save();
                $action='updated';
            }
            return redirect('language-price')->with('success', 'Language Price '.$action.' Successfully.');
        }
        catch (\Exception $e) 
        {   
            $result = ['exception_message' => $e->getMessage()];
            return view('errors.error', $result);
        }
    }

    /**
      * Return Delete Language price.
      * @param  price id and Delete Status         
      * @return Response
      * Created on: 23/01/2017
      * Updated on: 23/01/2017
    **/
    public function getDeleteLanguagePrice($languageId=null,$status=null)
    {
      try {
        if(($status=='') || (($status !='Deleted') && ($status !='Active'))){
            return redirect('language-price')->with('error', 'You are not autorize to delete this role.');
        }
        //Soft Delete Language Prices
        $msg=($status=='Active')?'Activated':'Deleted';
        $updateUser=LanguagePrice::where('id',decrypt($languageId))->update(array('status'=>$status));
        return redirect('language-price')->with('success', 'Language Price '.$msg.' Successfully.');
      }catch (\Exception $e){   
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }
}