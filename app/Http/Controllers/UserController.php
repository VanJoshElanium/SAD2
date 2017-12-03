<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreUser;
use App\Http\Controllers\Controller;  

class UserController extends Controller
{
    // Where to redirect users after registration; name of route
    protected $redirectTo = '/usrmgmt';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('usrmgmt.usrmgmt', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        User::create($request->all());
        session()->flash('message', 'Successfully created a new user!');
        return redirect('/usrmgmt');
    }

    public function getUser($id)
    {
        //$users = User::all();
        //$user_id = $_GET['id'];
        $usrdata = User::where('id' , '=', $id)->first();
        return $usrdata;
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}