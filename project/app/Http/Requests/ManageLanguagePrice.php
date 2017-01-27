<?php namespace App\Http\Requests;

use App;


class ManageLanguagePrice extends Request {

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
		
		
		$rules['source']  = trim('required');
		$rules['destination']  = trim('required');
		$rules['price_per_word']  = trim('required');


        return $rules;
	}
	
	public function messages()
	{	
        return [
            'source.required' => 'The Language From field is required.',
            'destination.required' => 'The Language To field is required.',
            'price_per_word.required' => 'The Language Price Per Word field is required.',
        ];	
	}	
}