<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
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
            'title' =>'required | min:3 | max:255' ,
            'content' =>'required | min:3' ,
        ];
    }

    public function messages(){
        return[
            'title.required' => 'Il campo è obbligatorio',
            'title.min' => 'Il campo titolo deve contenere alemeno :min caratteri',
            'title.max' => 'Il campo titolo può contenere al massimo :max caratteri',
            'content.required' => 'Il campo è obbligatorio',
            'content.min' => 'Il campo content deve contenere alemeno :min caratteri',
        ];
    }
}
