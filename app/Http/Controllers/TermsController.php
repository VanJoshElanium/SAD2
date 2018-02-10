<?php

namespace App\Http\Controllers;

use App\Term;
use App\User;
use Validator;
use App\Worker;
use App\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTerm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class TermsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $curr_usr = Auth::user();
        // Available Collectors
        $collectors = DB::table('profiles as T1')
                    -> join('users as T2', 'T2.user_id', '=', 'T1.profile_user_id')
                    -> whereNotIn('user_id', function($query){
                        $query -> select('worker_user_id')
                               -> from('workers')
                               -> join('terms', 'term_id', '=', 'worker_term_id')
                               -> where([
                                    ['term_status' , '=', 1],
                                    ['worker_type' , '=', 0]
                                  ])
                               -> where(function($q) {
                                    $q->where('terms.finish_date', '=', null)
                                        ->orWhere([
                                            ['terms.finish_date', '>', Carbon::now() -> toDateString()]
                                        ]);
                                });
                        })
                    -> select('user_id', 'fname', 'mname', 'lname')
                    -> where([
                            ['user_type' , '=', 2],
                            ['user_status' , '=', 1]
                        ])
                    -> get();

        //ON-GOING TERMS
        $og_terms = Term::join('workers', 'terms.term_id', '=', 'worker_term_id')
                -> join('users', 'workers.worker_user_id', '=', 'users.user_id')
                -> join('profiles', 'users.user_id', '=', 'profiles.profile_user_id')
                -> select('terms.*', 'profiles.fname', 'profiles.mname', 'profiles.lname')
                -> where([
                        ['terms.term_status' , '=', 1],
                        ['users.user_type',  '=', 2], //Collector
                        ['terms.finish_date', '=', null]
                    ])
                // -> where(function($q) {
                //       $q->where('terms.finish_date', '=', null)
                //         ->orWhere([
                //             ['terms.finish_date', '<', Carbon::now() -> toDateString()]
                //         ]);
                //   })
                -> paginate(5);



        //COMPLETED TERMS
        $cd_terms = Term::join('workers', 'terms.term_id', '=', 'worker_term_id')
                -> join('users', 'workers.worker_user_id', '=', 'users.user_id')
                -> join('profiles', 'users.user_id', '=', 'profiles.profile_user_id')
                -> select('terms.*', 'profiles.fname', 'profiles.mname', 'profiles.lname')
                -> where([
                        ['terms.term_status' , '=', 1],
                        ['users.user_type',  '=', 2],
                        ['terms.finish_date', '!=', null],
                        ['terms.end_date', '!=', null]
                  ])
                -> paginate(5);

        return view('terms', compact('curr_user', 'collectors', 'og_terms', 'cd_terms'));
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
    public function store(StoreTerm $request)
    {
        // dd($request);
        $term = Term::create([
                    'start_date' => $request-> date_started,
                    'location' => $request-> location,
                    'term_status' => 1
                ]);

        $worker = new Worker;
        $worker -> worker_term_id = $term -> term_id;
        $worker -> worker_user_id = $request -> collector;
        $worker -> worker_type = 0; //collector
        $worker -> save();
        //session()->flash('message', 'Successfully created a new supplier!');
        return redirect('/terms');
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
        $term = Term::find($id);
        $now = Carbon::now() -> toDateString();

        if($request -> update_type == "ed"){
            if ($term -> fd != null)
                $validator = Validator::make($request->all(), [
                    'ed' => 'required|date|before_or_equal:'.$now. '|before:' .$term -> fd .'|after:'.$term-> start_date
                ]);
            else
                $validator = Validator::make($request->all(), [
                    'ed' => 'required|date|before_or_equal:'.$now.'|after:'.$term-> start_date
                ]);

            if ($validator->fails()) {
                return redirect('/terms')
                    ->withErrors($validator, 'addEd')
                    ->withInput($request->all());
            }
            else{
                $term -> end_date = $request -> ed;
                $term -> save();
                return redirect('/terms');
            }  
        }
        else{
            $validator = Validator::make($request->all(), [
                'fd' => 'required|date|before_or_equal:'.$now.'|after:'.$term-> end_date
            ]);

            if ($validator->fails()) {
                return redirect('/terms')
                    ->withErrors($validator, 'addFd')
                    ->withInput($request->all());
            }
            else{
                $term -> finish_date = $request -> fd;
                $term -> save();
                return redirect('/terms');
            }
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
        $term = Term::find($id);
        $term -> term_status = 0;
        $term -> save();
        //dd($supplier); //for debugging purposes
        return redirect('/terms');
        //Session::flash('message', 'User has been successfully removed!');*/
    }
}
