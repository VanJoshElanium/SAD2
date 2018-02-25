<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $curr_usr = Auth::user();

        $logs = DB::table('activity_log')
                -> join ('users', 'user_id', '=', 'causer_id')
                -> join ('profiles', 'profile_user_id', '=', 'user_id')
                -> select ('activity_log.*', 'profiles.fname', 'profiles.mname', 'profiles.lname', 'users.user_id')
                -> paginate(5);
        return view('logs', compact('logs', 'curr_usr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getLog($id){
        
        $logdata = DB::table ('activity_log')
                    -> join ('users', 'user_id', '=', 'causer_id')
                    -> join ('profiles', 'profile_user_id', '=', 'user_id')
                    -> select ('profiles.fname', 'profiles.mname', 'profiles.lname', 'activity_log.*')
                    -> where ('id', '=', $id)
                    -> get();
        
        $activity = Activity::find($id);
        $acted = $activity->subject_type::find ($activity->subject_id);

        return $logdata; 
    }
}
