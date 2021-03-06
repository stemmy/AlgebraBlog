<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Sentinel;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Sentinel::check()){
            return true;
        }
            
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content' =>  'required'
        ];
    }

    public function messages()
    {
        return [
            'content.required'  => 'A post comment is required'
        ];
    }
}