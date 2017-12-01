<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/usrmgmt';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /*
    public function __construct()
    {
        $this->middleware('guest');
    }
    */


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => array(
                         'required',
                         'max:50',
                         'string',
                         'regex:/^[a-zA-Z-]/'), 
            'mname' => array(
                         'required',
                         'max:3',
                         'string',
                         'regex:/^[a-zA-Z.]/'),
            'lname' => array(
                         'required',
                         'max:50',
                         'string',
                         'regex:/^[a-zA-Z-]/'),
            'username' => 'required|string|max:50|alphanum|unique:users',
            'password' => 'required|string|min:4|',
            'gender' => 'required|digits:1',
            'bday' => 'required|date',
            'cnum' => 'required|digits:11',
            'user_type' => 'required|digits:1|'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'fname' => $data['fname'],
            'mname' => $data['mname'],
            'lname' => $data['lname'],
            'username' => $data['username'],
            'password' => $data['password'],
            'gender' => $data['gender'],
            'bday' => $data['bday'],
            'cnum' => $data['cnum'],
            'user_type' => $data['user_type'],
            'user_status' => 1
        ]);
    }
}
