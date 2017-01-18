<?php namespace App\Http\Requests;

use App;


class ManageRole extends Request {

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
			$rules['role']  = trim('required|unique:roles,role,'.decrypt($this->request->get('roleId')));
		}else{
			$rules['role']=trim('required|unique:roles');
		}
        return $rules;
	}
	
	public function messages()
	{	
        return [
            'role.required' => 'The role field is required.',
        ];
		
	}	
}