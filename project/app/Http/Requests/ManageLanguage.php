<?php namespace App\Http\Requests;

use App;


class ManageLanguage extends Request {

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
		if($this->request->get('method')=="update"){
			$rules['name']  = trim('required|unique:languages,name,'.decrypt($this->request->get('languageId')));
		}else{
			$rules['name']=trim('required|unique:languages');
		}
        return $rules;
	}
	
	public function messages()
	{	
        return [
            'name.required' => 'The Language name field is required.',
            'name.unique' => 'The Language name field is already taken.',
        ];	
	}	
}