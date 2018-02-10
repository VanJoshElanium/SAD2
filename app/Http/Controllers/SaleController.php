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

class SaleController extends Controller
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
        $sale = new Sale;
        $sale -> sales_amt = $request -> add_amt_collected;
        $sale -> sales_date = $request -> add_date_collected;
        $sale -> sales_remarks = $request -> add_note_collected;
        $sale -> sale_term_id = $request -> term_id;
        $sale -> save();

        return redirect('/termsprofile/' .$request-> term_id);
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
        $sale = Sale::find($id);
        $sale -> sales_amt = $request -> edit_amt_collected;
        $sale -> sales_date = $request -> edit_date_collected;
        $sale -> sales_remarks = $request -> edit_note_collected;
        $sale -> sale_term_id = $request -> term_id;
        $sale -> save();

        return redirect('/termsprofile/' .$request-> term_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collection = Sale::find($id);
        $term = $collection -> sale_term_id;
      
        $collection = Sale::destroy($id);
        return redirect('/termsprofile/' .$term);
    }

    public function getSale($id)
    {
        $saledata = Sale::find($id);
        //Session::flash('message', 'User has been successfully created!');
        return $saledata;
    }
}
