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
				$rules['website'] = trim('required|min:5|max:50|unique:publishers,email,'.decrypt($this->request->get('userId')));
			}else{
				$rules['email']=trim('required|email|unique:users');
				$rules['website']=trim('required|min:5|max:50|unique:publishers');
			}
			$rules['name']=trim('required|regex:/^[\pL\s]+$/u|min:5|max:50');
			$rules['role']=trim('required');
            return $rules;
	}
	
	public function messages()
	{	
            return [
                'website.required' => 'The domain field is required.',
                'website.min' => 'The domain field must be at least 5 characters.',
                'website.max' => 'The domain field may not be greater than 50 characters.',
                'website.unique' => 'The domain is already taken.',
                'role.required' => 'The user role field is required.',
            ];
		
	}	
}