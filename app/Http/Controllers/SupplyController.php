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
        $input = Input::all();

        for ($i=0; $i < count($input['supply_name']); ++$i) {

            $item = new Inventory;
            $item -> inventory_name = $input['supply_name'][$i];
            $item -> inventory_desc = $input['supply_desc'][$i];
            $item -> inventory_qty = 0;
            $item -> inventory_price = $input['supply_price'][$i];
            $item -> save();

            $supply = new Supply;
            $supply -> supplies_supplier_id = $request -> supply_supplier_id;
            $supply -> supplies_inventory_id = $item -> inventory_id; 
            $supply -> save();
        }
        
        //session()->flash('message', 'Successfully created a new supplier!');
        return redirect()->back() -> with('store-item-success','Supplier item/s successfully created!');
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
            $supplies = Supply::join('suppliers', 'supplier_id', '=', 'supplies_supplier_id')
                -> join('inventories', 'inventory_id', '=', 'supplies_inventory_id')
                -> where([
                    ['supplier_id' , '=', $id]
                ])
                -> orderBy('inventories.updated_at', 'desc')
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
            'edit_supply_desc' => 'nullable|string',
            'edit_supply_price' => 'required|numeric|min:1'
        ]);

        $attributeNames = array(
                   'edit_supply_name' => "item name",
                   'edit_supply_desc' => 'descripion',
                   'edit_supply_price' => 'price',
                );
        $validator->setAttributeNames($attributeNames);

        if ($validator->fails()) {
            return redirect() -> back()
                ->withErrors($validator, 'editSupply')
                ->withInput($request->all())
                ->with('error_id', $id);
        }
        else{
            $supply -> inventory_name = $request-> edit_supply_name;
            $supply -> inventory_price = $request-> edit_supply_price;
            $supply -> inventory_desc = $request-> edit_supply_desc;
            $supply -> save();
            return redirect() -> back() -> with('update-item-success','Supplier item was successfully edited!');
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
        $supplier = Supply::join ('inventories', 'inventory_id', '=', 'supplies_inventory_id')
                            -> join ('suppliers', 'supplier_id', '=', 'supplies_supplier_id')
                            -> where ([
                                    ['supplies_inventory_id', '=', $id],
                                    ['inventory_id', '=', $id],
                                ])
                            -> select ('supplier_id')
                            -> get();
        $supplier = $supplier[0] -> supplier_id;

        $supply = Inventory::find($id);
        if ($supply->inventory_status == 0){
            $supply -> inventory_status = 1;
            $supply -> save();
            return redirect('/supplies/' .$supplier) -> with('destroy-item-success','Supplier item was successfully reset to active!');
        }
        else{
            $supply -> inventory_status = 0;
            $supply -> save();
            return redirect('/supplies/' .$supplier) -> with('destroy-item-success','Supplier item was successfully set to inactive!');
        }
        
        //dd($supply); //for debugging purposes
        
        //Session::flash('message', 'User has been successfully removed!');*/
    }

    public function getSuppliedItem($id)
    {
        $supplydata = Inventory::find($id);
        //Session::flash('message', 'User has been successfully created!');
        return $supplydata;
    }
}
