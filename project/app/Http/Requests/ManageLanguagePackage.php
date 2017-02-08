<?php namespace App\Http\Requests;

use App;


class ManageLanguagePackage extends Request {

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
		$rules['name']  = trim('required');
		if($this->request->get('method')=="update"){
			$rules['name']  = trim('required|unique:language_packages,name,'.decrypt($this->request->get('packageId')));
		}else{
			$rules['name']=trim('required|unique:language_packages');
		}
		$rules['price_per_word']=trim('required');
		return $rules;
	}
	
	public function messages()
	{	
        return [
            'name.required' => 'The Package name field is required.',
            'name.unique' => 'The Package name field is already taken.',
            'price_per_word.required'=> 'The Price field is required.',
        ];	
	}	
}