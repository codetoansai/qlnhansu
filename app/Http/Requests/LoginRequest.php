<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
           'txtname'=>'required',
            'txtpass'=>'required'
        ];
    }
    public function messages(){
        return [
            'txtname.required'=>'Tên không được để trống',
            'txtpass.required'=>'Mật khẩu không được để trống'
        ];
    }
}
