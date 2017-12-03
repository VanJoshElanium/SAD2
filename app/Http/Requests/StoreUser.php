<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'fname' => array(
                         'required',
                         'max:50',
                         'string',
                         'regex:/^[a-zA-Z-]/'), 
            'mname' => array(
                         'required',
                         'max:3',
                         'string',
                         'regex:/^[a-zA-Z][.]/'),
            'lname' => array(
                         'required',
                         'max:50',
                         'string',
                         'regex:/^[a-zA-Z-]/'),
            'username' => 'required|string|max:50|alphanum|unique:users',
            'password' => 'required|string|min:4|',
            'gender' => 'required|string',
            'bday' => 'required|date',
            'cnum' => 'required|digits:11',
            'user_type' => 'required|string'
        ];
    }
}
