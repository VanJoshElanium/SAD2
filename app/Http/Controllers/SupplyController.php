<?php

namespace App\Http\Controllers;

use App\Supply;
use App\Supplier;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreSupply;
use App\Http\Controllers\Controller;  
use Illuminate\Support\Facades\Auth;

class SupplyController extends Controller
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
            $users = Supply::search($request->input('titlesearch')) 
                -> paginate(5);
        }else{
            $users = Supply::where('supply_status' , '=', 1)
                -> sortable() 
                -> paginate(5);
        } 
        return view('usrmgmt', compact('users', 'curr_usr'));
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
        Supply::create($request->all());
        session()->flash('message', 'Successfully created a new supplier!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $curr_usr = Auth::user();
        $supplier = Supplier::find($id);

        if($request->has('titlesearch')){
            $supplies = Supply::search($request->input('titlesearch')) 
                -> paginate(5);
        }else{
            $supplies = Supply::where([['supply_supplier_id' , '=', $id], ['supply_status', '=', 1]])
                -> sortable() 
                -> paginate(5);
            //dd($supplies); //debugging purposes
        } 
        return view('supplier_profile', compact('supplies', 'curr_usr', 'supplier'));
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
        $supply = Supply::find($id);
        //dd($request-> all()); //for debugging purposes
        $supply -> supply_name = $request-> edit_supply_name;
        $supply -> supply_price = $request-> edit_supply_price;
        $supply -> save();
        return redirect('/supplies/' .$supply-> supply_supplier_id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supply = Supply::find($id);
        $supply -> supply_status = 0;
        $supply -> save();
        //dd($supply); //for debugging purposes
        return redirect('/supplies/' .$supply-> supply_supplier_id);
        //Session::flash('message', 'User has been successfully removed!');*/
    }

     public function getSupply($id)
    {
        $supplydata = Supply::find($id);
        //Session::flash('message', 'User has been successfully created!');
        return $supplydata;
    }
}
