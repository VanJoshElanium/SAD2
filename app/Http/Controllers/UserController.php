<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
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
        $error_id = null;
        $pass_error = null;

        $curr_usr = Auth::user();

        if($request->has('titlesearch')){
            $users = User::search($request->input('titlesearch'))
                -> paginate(5);
            $users -> load('profiles');
        }else{

            if (\Auth::user() -> user_type == "Owner")
                $users = User::join('profiles as p1',  'users.user_id', '=', 'p1.profile_user_id')
                    -> select('users.*', 'p1.*')
                    -> orderByRaw("CASE WHEN users.updated_at > p1.updated_at THEN users.updated_at ELSE p1.updated_at END DESC")
                    -> where ('user_type', '!=', '0')
                    -> paginate(5);
            elseif (\Auth::user() -> user_type == "Administrator")
                $users = User::join('profiles as p1',  'users.user_id', '=', 'p1.profile_user_id')
                    -> select('users.*', 'p1.*')
                    -> orderByRaw("CASE WHEN users.updated_at > p1.updated_at THEN users.updated_at ELSE p1.updated_at END DESC")
                    -> paginate(5);
            else
                $users = DB::table('profiles as T1')
                    -> join('users as T2', 'T2.user_id', '=', 'T1.profile_user_id')
                    -> whereNotIn('user_id', function($query){
                        $query -> select('worker_user_id')
                               -> from('workers')
                               -> join('terms', 'term_id', '=', 'worker_term_id')
                               -> where([
                                    ['term_status' , '=', 1],
                                    ['terms.end_date', '=', null]
                               ]);
                        })
                    -> select('user_id', 'fname', 'mname', 'lname', 'cnum', 'user_status', 'user_type')
                    -> where([
                            ['user_type' , '=', 3],
                            ['user_status' , '=', 1]
                        ])
                    -> paginate (10);
                // -> toSql();
           
        } 
        return view('usrmgmt', compact('users', 'curr_usr', 'error_id', 'pass_error'));
    }

    public function store(StoreUser $request)
    {
        
        $user = User::create([
                'username' => $request-> username,
                'password' => $request-> password,
                'user_type' => $request-> user_type,
                'user_status' => $request-> user_status
            ]);

        $profile = new Profile;
        $profile -> profile_user_id = $user -> user_id;
        $profile -> fname = $request-> fname;
        $profile -> mname = $request-> mname;
        $profile -> lname = $request-> lname;
        $profile -> gender = $request-> gender;
        $profile -> bday = $request-> bday;
        $profile -> cnum = $request-> cnum;
        $profile -> save();

        return redirect('/usrmgmt') ->with('store-success','User was successfully created!');
    }

    public function getUser($id)
    {
        $usrdata = User::join('profiles as p2', 'p2.profile_user_id', '=', 'users.user_id')
                  -> select('users.*', 'p2.*')
                  -> where('user_id', '=', $id)
                  -> get();
        //Session::flash('message', 'User has been successfully created!');
        return $usrdata;
    }

    public function update(Request $request, $id)
    {
         $validator = Validator::make($request->all(), [
            'profile_fname' => array(
                         'required',
                         'max:50',
                         'alpha'), 
            'profile_mname' => array(
                         'required',
                         'max:1',
                         'alpha'),
            'profile_lname' => array(
                         'required',
                         'max:50',
                         'alpha'),
            'profile_gender' => 'required|string',
            'profile_bday' => 'required|date',
            'profile_cnum' => 'required|digits:11',
            'profile_username' => 'required|alpha_dash|min:4|max:50|alphanum|unique:users,username,' .$id .',user_id,user_status,1',
            'profile_user_type' => 'required|string'
        ]);

        $attributeNames = array(
           'profile_fname' => 'first name',
           'profile_mname' => 'middle initial',
           'profile_lname' => 'last name',
           'profile_user_type' => 'user type',
           'profile_bday' => 'birthdate',
           'profile_cnum' => 'contact number',
           'profile_gender' => 'gender',
           'profile_username' => 'username'    
        );
        $validator->setAttributeNames($attributeNames);

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator, 'editUser')
                ->withInput($request->all())
                ->with('error_id', $id);
        }
        else{
            $user = User::find($id);

            //dd($request-> all()); //for debugging purposes
            
            $user -> username = $request-> profile_username;
            $user -> user_type =$request-> profile_user_type;
            $user -> save();

            $profile = User::find($id)-> profile;
            $profile -> fname = $request-> profile_fname;
            $profile -> mname = $request-> profile_mname;
            $profile -> lname = $request-> profile_lname;
            $profile -> gender = $request-> profile_gender;
            $profile -> bday = $request-> profile_bday;
            $profile -> cnum = $request-> profile_cnum;
            $profile -> save();

            return redirect('usrmgmt') -> with('update-success','User was successfully edited!');
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user -> user_status = 0;
        $user -> save();
        //dd($user); //for debugging purposes
        return redirect()-> back() -> with('destroy-success','User was successfully removed!');
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

        $validator = Validator::make($request->all(), [
            'new_password' => 'required|string|min:4|confirmed|different:current_password',
            'current_password' => 'required',
            'new_password_confirmation' => 'required'
        ]);

        $attributeNames = array(
                   'new_password' => 'new password',
                   'current_password' => 'current password',
                   'new_password_confirmation' => 'confirmed new password',  
                );
        $validator->setAttributeNames($attributeNames);

        if (!(Hash::check($request->get('current_password'), $user-> password))) {
            // The passwords matches
           $validator->getMessageBag()->add('password', 'The current password does not match with the password you provided. Please try again.');
           return redirect('usrmgmt')
                ->withErrors($validator, 'editPass')
                ->with("pass_error","The current password does not match with the password you provided. Please try again.")
                ->with('error_id', $id);
        }

        if ($validator->fails()) {
            return redirect('usrmgmt')
                ->withErrors($validator, 'editPass')
                ->with('error_id', $id);
        }
        else{
            //Change Password
            $user -> password = $request-> new_password;
            $user -> save();
            return redirect() -> back() -> with('password-success','User password was successfully edited!');
        }
    }
}