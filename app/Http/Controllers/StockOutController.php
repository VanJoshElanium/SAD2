<?php

namespace App\Http\Controllers;

use App\Stockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StockOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $curr_usr = Auth::user();

        $stockouts = DB::table('term_items')
                    -> join ('profiles', 'profile_user_id', '=', 'ti_user_id')
                    -> join ('terms', 'term_id', '=', 'ti_term_id')
                    -> select ('term_items.ti_term_id', 'profiles.fname', 'profiles.mname', 'profiles.lname', 'term_items.ti_date')
                    -> groupBy('ti_term_id')
                    -> orderBy('term_items.ti_date', 'DESC')
                    -> paginate(5);

        return view('stockouts', compact('stockouts', 'curr_usr'));
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

    public function getSO(Request $request){

        $sidata = DB::table('term_items')
                    -> join ('profiles', 'profile_user_id', '=', 'ti_user_id')
                    -> join ('terms', 'term_id', '=', 'ti_term_id')
                    -> join ('inventories', 'inventory_id', '=', 'ti_inventory_id')
                    -> join ('suppliers', 'supplier_id', '=', 'inventory_supplier_id')
                    -> select ('inventories.inventory_name', 'suppliers.supplier_name', 'profiles.fname', 'profiles.mname', 'profiles.lname', 'term_items.ti_date', 'term_items.ti_original')
                    -> where ('term_id', '=', $request -> id)
                    -> get();

        return $sidata;
    }
}
