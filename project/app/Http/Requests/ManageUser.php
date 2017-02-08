<?php namespace App\Http\Requests;

use App;


class ManageUser extends Request {

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
			$rules['email']  = trim('required|email|unique:users,email,'.decrypt($this->request->get('userId')));
		}else{
			$rules['email']=trim('required|email|unique:users');
		}
		$rules['role']=trim('required');
        return $rules;
	}
	
	public function messages()
	{	
        return [
                'role.required' => 'The user role field is required.',
            ];
		
	}	
}