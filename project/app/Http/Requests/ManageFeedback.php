<?php namespace App\Http\Requests;

use App;


class ManageFeedback extends Request {

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
		$rules['translated_file']=trim('required');
		$rules['corrections']=trim('required');
		

        return $rules;
	}
	
	public function messages()
	{	
        return [
            'translated_file.required' => 'The file name  field is required.',
            'corrections.required' => 'The what would you like to change field is required.',
        ];
		
	}	
}