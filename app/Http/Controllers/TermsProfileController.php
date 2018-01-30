<?php

namespace App\Http\Controllers;

use App\Term;
use App\User;
use Validator;
use App\Worker;
use App\Term_Item;
use App\Expense;
use App\Sale;
use App\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTerm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TermsProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('termsprofile');
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
        $curr_usr = Auth::user();

        //BASIC TERM DETAILS: LOC, COLLECTOR, DATES
        $term = Term::join('workers', 'terms.term_id', '=', 'worker_term_id')
                -> join('users', 'workers.worker_user_id', '=', 'users.user_id')
                -> join('profiles', 'users.user_id', '=', 'profiles.profile_user_id')
                -> select('terms.*', 'workers.*', 'profiles.fname', 'profiles.mname', 'profiles.lname')
                -> where([
                        ['terms.term_id', '=', $id],
                        ['workers.worker_term_id', '=', $id],
                        ['terms.term_status', '=', 1],
                        ['workers.worker_type', '=', 0]
                    ])
                -> get();
       
        //AVAILABLE PEDDLERS (FOR ADDING PEDDLERS FORM)
        $a_peddlers = DB::table('profiles as T1')
                    -> join('users as T2', 'T2.user_id', '=', 'T1.profile_user_id')
                    -> whereNotIn('user_id', function($query){
                        $query -> select('worker_user_id')
                               -> from('workers')
                               -> join('terms', 'term_id', '=', 'worker_term_id')
                               -> where([
                                    ['term_status' , '=', 1],
                                    ['finish_date', '>=', Carbon::now() -> toDateString()],
                                ]);
                        })
                    -> select('user_id', 'fname', 'mname', 'lname')
                    -> where([
                            ['user_type' , '=', 3],
                            ['user_status' , '=', 1]
                        ])
                    -> get();

        //TERM PEDDLERS
        $workers = Term::join('workers', 'terms.term_id', '=', 'worker_term_id')
                -> join('users', 'workers.worker_user_id', '=', 'users.user_id')
                -> join('profiles', 'users.user_id', '=', 'profiles.profile_user_id')
                -> select('terms.*', 'workers.*', 'profiles.fname', 'profiles.mname', 'profiles.lname')
                -> where([
                        ['terms.term_id', '=', $id],
                        ['workers.worker_term_id', '=', $id],
                        ['terms.term_status', '=', 1],
                        ['workers.worker_type', '!=', 0]
                    ])
                -> paginate(5);
    
        //TERM EXPENSES
        $expenses = Term::join('expenses', 'terms.term_id', '=', 'expense_term_id')
                    -> select ('terms.term_id', 'terms.term_status', 'expenses.*')
                    -> where ([
                        ['terms.term_status', '=', '1'],
                        ['terms.term_id', '=', $id]
                    ])
                    -> paginate(5);

        //TERM ITEMS
        $term_items = Term::join('term_items', 'terms.term_id', '=', 'ti_term_id')
                    -> select ('terms.term_id', 'terms.term_status', 'term_items.*')
                    -> where ([
                        ['terms.term_status', '=', '1'],
                        ['terms.term_id', '=', $id]
                    ])
                    -> paginate(5);

        //TERM SALES
        $sales = Term::join('sales', 'terms.term_id', '=', 'sale_term_id')
                    -> select ('terms.term_id', 'terms.term_status', 'sales.*')
                    -> where ([
                        ['terms.term_status', '=', '1'],
                        ['terms.term_id', '=', $id]
                    ])
                    -> paginate(5);


        return view('termsprofile', compact('curr_user', 'workers', 'term', 'a_peddlers', 'expenses', 'term_items', 'sales'));
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
}
