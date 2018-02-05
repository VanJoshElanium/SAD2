<?php

namespace App\Http\Controllers;

use Validator;
use App\Supply;
use App\Inventory;
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
            $users = Inventory::search($request->input('titlesearch')) 
                -> paginate(5);
        }else{
            // $users = Inventory::where('inventory_status' , '=', 1)
            //     -> sortable() 
            //     -> paginate(5);
        } 
        // return redirect('/supplies/' .$supply-> inventory_supplier_id);
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
    public function store(StoreSupply $request)
    {
        //dd($request);
        $item = new Inventory;
        $item -> inventory_supplier_id = $request -> supply_supplier_id;
        $item -> inventory_name = $request-> supply_name;
        $item -> inventory_desc = $request-> supply_desc;
        $item -> inventory_qty = 0;
        $item -> inventory_price = $request-> supply_price;
        $item -> save();
        //session()->flash('message', 'Successfully created a new supplier!');
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
            $supplies = Inventory::search($request->input('titlesearch')) 
                -> paginate(5);
        }else{
            $supplies = Inventory::where([
                    ['inventory_supplier_id' , '=', $id], 
                    ['inventory_status', '=', 1]
                ])
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
        $supply = Inventory::find($id);
        //dd($request-> all()); //for debugging purposes

        $validator = Validator::make($request->all(), [
            'edit_supply_name' => 'required|string',
            'edit_supply_desc' => 'required|string',
            'edit_supply_price' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect('/supplies/' .$supply-> inventory_supplier_id)
                ->withErrors($validator, 'editSupply')
                ->withInput($request->all())
                ->with('error_id', $id);
        }
        else{
            $supply -> inventory_name = $request-> edit_supply_name;
            $supply -> inventory_price = $request-> edit_supply_price;
            $supply -> inventory_desc = $request-> edit_supply_desc;
            $supply -> save();
            return redirect('/supplies/' .$supply-> inventory_supplier_id);
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
        $supply = Inventory::find($id);
        $supply -> inventory_status = 0;
        $supply -> save();
        //dd($supply); //for debugging purposes
        return redirect('/supplies/' .$supply-> inventory_supplier_id);
        //Session::flash('message', 'User has been successfully removed!');*/
    }

    public function getSuppliedItem($id)
    {
        $supplydata = Inventory::find($id);
        //Session::flash('message', 'User has been successfully created!');
        return $supplydata;
    }
}
