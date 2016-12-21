<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class AuthenticateUser extends Request {

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
        $input = $this->all();
        $input['email'] = trim($input['email'], FILTER_SANITIZE_STRING);
        $this->replace(array_map('trim', $input));
        
		return [
			'email'     => 'required|email|max:255',
			'password'  => 'required|min:5|max:50'
		];
	}
	
	public function messages(){
		return [];
	}
	
	
}
