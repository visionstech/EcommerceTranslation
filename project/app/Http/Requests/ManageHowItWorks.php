<?php namespace App\Http\Requests;

use App;
use App\Section;

class ManageHowItWorks extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
            return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{	
		$rules=array();
		$GetData = Section::where('title',$this->request->get('title'))->where('section_type','how-it-works')->get();
		if($this->request->get('method')=="update"){
			if(!count($GetData)){
				$rules['title']  = trim('required');
			}else{
				$rules['title']  = trim('required|unique:sections,title,'.decrypt($this->request->get('ourPromisesId')));
			}
		}else{
			if(!count($GetData)){
				$rules['title']  = trim('required');
			}else{
				$rules['title']=trim('required|unique:sections');
			}
		}
		$rules['description']=trim('required');
        return $rules;
	}
	
	public function messages()
	{	
        return [];
	}	
}