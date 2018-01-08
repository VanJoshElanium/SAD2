<?php

namespace App\Http\Controllers;

use App\User;
use App\Supply;
use App\Supplier;
use App\Inventory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreSupplier;
use App\Http\Controllers\Controller;  
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $curr_usr = Auth::user();

        $suppliers = Supplier::where('supplier_status' , '=', 1)->get();
        $workers = User::where('user_type', '=', 3)
                ->orWhere(function ($query) {
                            $query->where('user_type', '=', 4);
                         })
                ->get();
        
        if($request->has('titlesearch')){
            $items = Inventory::search($request->input('titlesearch')) 
                -> paginate(5);
        }else{
            $items = Inventory::join('supplies', 'supplies.supply_id', '=', 'inventories.inventory_supply_id')
                -> join('suppliers', 'suppliers.supplier_id', '=', 'supplies.supply_supplier_id')
                -> select('inventories.*', 'supplies.supply_name', 'suppliers.supplier_name')
                -> where([
                        ['inventory_damaged', '=', 0],
                        ['inventory_status' , '=', 1]
                    ])
                -> sortable() 
                -> paginate(5);
        } 
        return view('inventory', compact('items', 'curr_usr', 'suppliers', 'workers'));
    }

    public function getItem($id)
    {
        $itemdata = Inventory::find($id)
                -> join('users', 'users.id', '=', 'inventories.inventory_user_id')
                -> join('supplies', 'supplies.supply_id', '=', 'inventories.inventory_supply_id')
                -> join('suppliers', 'suppliers.supplier_id', '=', 'supplies.supply_supplier_id')
                -> select('inventories.*', 'supplies.supply_name', 'suppliers.supplier_name', 'users.fname', 'users.mname', 'users.lname', 'users.id', 'supplies.supply_id')
                -> where([
                        ['inventory_damaged', '=', 0],
                        ['inventory_status' , '=', 1]
                    ])
                -> get();  
        return $itemdata;
    }


    public function getSupply($id)
    {
        $supplies = Supply::where('supply_supplier_id', '=', $id)
                -> whereNotIn('supply_id', function($q){
                        $q->select('inventory_supply_id')->from('inventories');
                    })
                ->get();
        //Session::flash('message', 'User has been successfully created!');
        return $supplies;
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
        $input = Input::all();
        //dd( $input['supply_name'][0]);
        for ($i=0; $i < count($input['inventory_quantity']); ++$i) {
            $item = new Inventory;
            $item -> inventory_user_id = $request->get('inventory_user_id');
            $item -> received_at = $request->get('received_at');
            $item -> inventory_supply_id = $input['supply_name'][$i];
            $item -> inventory_price = $input['inventory_price'][$i];
            $item -> inventory_quantity = $input['inventory_quantity'][$i];
            $item -> inventory_status = 1;
            $item -> inventory_damaged = 0;
            $item -> save();
        } 
        return redirect('/inventory');
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
        $input = Input::all();
        $item = Inventory::find($id);
        $item -> inventory_user_id = $input['view_pic'];
        $item -> received_at = $input['view_received_at'];
        $item -> inventory_supply_id = Supply::where('supply_name', '=', $input['view_item_name'])->value('supply_id');
        $item -> inventory_price = $input['view_inventory_price'];
        $item -> inventory_quantity = $input['view_inventory_quantity'];
        $item -> inventory_status = 1;
        $item -> inventory_damaged = 0;
        $item -> save();   
        return redirect('/inventory');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Inventory::find($id);
        $item -> inventory_status = 0;
        $item -> save();
        //dd($supply); //for debugging purposes
        return redirect('/inventory');
        //Session::flash('message', 'User has been successfully removed!');*/
    }
}
