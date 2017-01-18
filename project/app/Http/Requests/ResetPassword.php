<?php namespace App\Http\Requests;

use App;


class ResetPassword extends Request {

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
		if($this->request->get('reset_token')){
			return [
                'password'  => trim('required|confirmed|min:5|max:50')
            ];
		}else{
			return [
                'email'     => trim('required|email'),
        	];
		}
        
	}
	
	public function messages()
	{	
        return [
                'email.required'=> 'The email field is required.',
                'email.email'   => 'This is not valid email.'
			];
	}
	
}
