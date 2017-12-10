<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreUser;
use App\Http\Controllers\Controller;  
use Illuminate\Support\Facades\Auth;

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

    public function update(StoreUser $request, $id)
    {
        dd($id); //for debugging purposes
        $user = User::find($id);
        $user -> fname = $request->input('profile_fname');
        $user -> mname = $request->input('profile_mname');
        $user -> lname = $request->input('profile_lname');
        $user -> gender = $request->input('profile_gender');
        $user -> bday = $request->input('profile_bday');
        $user -> cnum = $request->input('profile_gender');
        $user -> username = $request->input('profile_username');
        $user -> user_type =$request->input('profile_user_type');
        $user -> save();

        // //Session::flash('message', 'User has been successfully updated!');
        $request->session()->flash('message', 'User has been successfully updated!');
        // return redirect('/usrmgmt');
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
}