<?php

namespace App\Http\Controllers;

use App\Stockin;
use App\Stockin_Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StockInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $curr_usr = Auth::user();

        $stockins = DB::table('stockins')
                    -> join ('stockin_items', 'si_item_id', '=', 'si_si_id')
                    -> join ('profiles', 'profile_user_id', '=', 'si_user_id')
                    -> select ('stockins.si_si_id', 'profiles.fname', 'profiles.mname', 'profiles.lname', 'si_date', 'stockin_items.*')
                    -> orderByRaw("CASE WHEN stockins.updated_at > stockin_items.updated_at THEN stockins.updated_at ELSE stockin_items.updated_at END DESC")
                    -> groupBy('si_item_id')
                    -> paginate(5);

        return view('stockins', compact('stockins', 'curr_usr'));
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

    public function getSI(Request $request){

        $stockin_item = Stockin_Item::find($request -> id);

        $sidatas = DB::table('stockins')
                -> join ('stockin_items', 'si_item_id', '=', 'si_si_id')
                -> join ('profiles', 'profile_user_id', '=', 'si_user_id')
                -> join ('inventories', 'inventory_id' , '=', 'si_inventory_id')
                -> join ('suppliers', 'supplier_id', '=', 
                    'inventory_supplier_id')
                -> select ('inventories.inventory_name', 'suppliers.supplier_name', 'profiles.fname', 'profiles.mname', 'profiles.lname', 'stockins.*', 'stockin_items.*')
                -> where ('si_si_id', '=', $request -> id)
                -> get();

        return $sidatas;
    }
}
