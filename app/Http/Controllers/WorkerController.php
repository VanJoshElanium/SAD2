<?php

namespace App\Http\Controllers;

use Validator;
use App\Worker;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;  
use Illuminate\Support\Facades\Auth;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validator = Validator::make($request->all(), [
            'position' => array(
                            'unique:workers,worker_type,null,null,worker_term_id,'.$request-> term_id .',worker_type, 1'
                        ),
            'peddler' => 'unique:workers,worker_user_id,null,null,worker_term_id,'.$request-> term_id
        ]);
        
        $attributeNames = array(
                   'peddler' => "peddler's name",
                );
          $validator->setAttributeNames($attributeNames);

        if ($validator->fails()) {
            return redirect('/termsprofile/' .$request-> term_id)
                ->withErrors($validator, 'addPeddler')
                ->withInput($request->all());
        }
        else{
            $worker = Worker::create([
                'worker_user_id' => $request-> peddler,
                'worker_term_id' => $request-> term_id,
                'worker_type' => $request-> position
            ]);
        } 
        return redirect('/termsprofile/' .$request-> term_id) -> with('store-peddler-success','Peddler was successfully added to term!');
        
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
        $validator = Validator::make($request->all(), [
            'edit_position' => array(
                            'unique:workers,worker_type,' .$id .',worker_id,worker_term_id,' .$request-> term_id .',worker_type, 1'
                        ),
        ]);

        $attributeNames = array(
                   'edit_position' => "position",
                );
          $validator->setAttributeNames($attributeNames);

        if ($validator->fails()) {
            return redirect('/termsprofile/' .$request-> term_id)
                ->withErrors($validator, 'editPeddler')
                ->withInput($request->all())
                ->with('error_id', $id);
        }
        else{
            $worker = Worker::find($id);
            $worker -> worker_type = $request -> edit_position;
            $worker -> save();
            return redirect('termsprofile/' .$request -> term_id) -> with('update-peddler-success','Peddler was successfully edited!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $worker = Worker::find($id);
        $term_id = $worker -> worker_term_id;
        $worker = Worker::destroy($id);
        return redirect('termsprofile/' .$term_id) -> with('destroy-peddler-success','Peddler was successfully removed from term!');
    }

    public function getWorker($id){
        $workerdata = DB::table('workers')
                      -> join('profiles', 'profile_user_id', '=', 'worker_user_id')
                      -> select ('profiles.fname', 'profiles.mname', 'profiles.lname', 'workers.*')
                      -> where ('worker_id', '=', $id)
                      -> get();
        return $workerdata;
    }
}
