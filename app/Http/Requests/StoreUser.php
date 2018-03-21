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

    public function attributes()
    {
       return [
           'fname' => 'first name',
           'mname' => 'middle initial',
           'lname' => 'last name',
           'user_type' => 'user type',
           'bday' => 'birthdate',
           'cnum' => 'contact number',
        ];
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
                         'alpha_dash',), 
            'mname' => array(
                         'required',
                         'max:1',
                         'alpha',),
            'lname' => array(
                         'required',
                         'max:50',
                         'alpha_dash',),
            'username' => 'required|string|min:4|max:50|alphanum|unique:users,username,null,null,user_status,1',
            'password' => 'required|string|min:4|confirmed',
            'gender' => 'required|string',
            'bday' => 'required|date',
            'cnum' => 'required|digits:11',
            'user_type' => 'required|string'
        ];
    }
}
