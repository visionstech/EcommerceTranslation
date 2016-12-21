<?php namespace App\Http\Requests;

use App;


class NewUser extends Request {

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
            return [
                'email'     => trim('required|email|max:100|unique:users'),
                'password'  => trim('required|confirmed|min:5|max:50'),
                'terms'		=> trim('required')
            ];
	}
	
	public function messages()
	{	
            return [
                'email.email'   => 'The must be a valid email address.',
                'terms.required'   => 'Please accept terms and conditions.',
            ];
		
	}
	
}
