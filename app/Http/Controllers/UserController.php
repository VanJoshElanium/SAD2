<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\StoreUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;  
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $curr_usr = Auth::user();

        if($request->has('titlesearch')){
            $users = User::search($request->input('titlesearch')) 
                -> paginate(5);
        }else{
            $users = User::where('user_status' , '=', 1)
                -> sortable() 
                -> paginate(5);
        } 
        return view('usrmgmt', compact('users', 'curr_usr'));
    }

    public function store(StoreUser $request)
    {
        User::create($request->all());
        session()->flash('message', 'Successfully created a new user!');
        return redirect('/usrmgmt');
    }

    public function getUser($id)
    {
        $usrdata = User::find($id);
        //Session::flash('message', 'User has been successfully created!');
        return $usrdata;
    }

    public function update(Request $request, $id)
    {
         $validator = Validator::make($request->all(), [
            'profile_fname' => array(
                         'required',
                         'max:50',
                         'string',
                         'regex:/^[a-zA-Z-]/'), 
            'profile_mname' => array(
                         'required',
                         'max:1',
                         'string',
                         'regex:/^[a-zA-Z]/'),
            'profile_lname' => array(
                         'required',
                         'max:50',
                         'string',
                         'regex:/^[a-zA-Z-]/'),
            'profile_gender' => 'required|string',
            'profile_bday' => 'required|date',
            'profile_cnum' => 'required|digits:11',
            'profile_user_type' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect('usrmgmt')
                ->withErrors($validator, 'editUser')
                ->withInput($request->all())
                ->with('error_id', $id);
        }
        else{
            $user = User::find($id);
            //dd($request-> all()); //for debugging purposes
            $user -> fname = $request-> profile_fname;
            $user -> mname = $request-> profile_mname;
            $user -> lname = $request-> profile_lname;
            $user -> gender = $request-> profile_gender;
            $user -> bday = $request-> profile_bday;
            $user -> cnum = $request-> profile_cnum;
            $user -> username = $request-> profile_username;
            $user -> user_type =$request-> profile_user_type;
            $user -> save();
            return redirect('usrmgmt');
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user -> user_status = 0;
        $user -> save();
        //dd($user); //for debugging purposes
        return redirect('/usrmgmt');
        //Session::flash('message', 'User has been successfully removed!');*/
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function changePassword(Request $request, $id){
        $user = User::find($id);

        //Change Password
        $user -> password = $request-> new_password;
        $user -> save();
        return redirect('usrmgmt');
    }
}