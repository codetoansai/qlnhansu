<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            'txtname'=>'required|unique:phong,name',
            'txtdes'=>'required',
            'txtstatus'=>'required'
        ];
    }
    public function messages(){
        return [
            'txtname.required'=>'Tên phòng không được để trống',
            'txtname.unique'=>'Tên không được để trùng',
            'txtdes.required'=>'Mô tả không được để trống',
             'txtstatus.required'=>'Trạng thái không được để trống'
        ];
    }
}
