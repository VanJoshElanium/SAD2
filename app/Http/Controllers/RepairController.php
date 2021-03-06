<?php

namespace App\Http\Controllers;

use Validator;
use App\Repair;
use App\Stockin_Item;
use App\Stockin;
use Carbon\Carbon;
use App\Inventory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreSupplier;
use App\Http\Controllers\Controller;  
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class RepairController extends Controller
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
      
        $input = Input::all();

        for ($i=0; $i < count($input['dm_item_name']); ++$i) {

            $item_qty = Inventory::where('inventories.inventory_id', '=', $input['dm_item_name'][$i])
                    -> select ('inventory_qty')
                    -> get();

            $validator = Validator::make($request->all(), [
                // 'dm_qty.' .$i  => 'numeric|min:1|max:' .$item_qty[0] -> inventory_qty,
                'dm_item_name.*' => 'distinct'
            ]);

            $attributeNames = array(
                   'dm_qty.*' => "quantity",
                   'dm_item_name.*' => 'item name'
                );
            $validator->setAttributeNames($attributeNames);

            if ($validator->fails()) {
                return redirect('/inventory')
                    ->withErrors($validator, 'addRepair')
                    ->withInput($request->all());
                    // ->with('input_error_id', $error_id);
            }
            else{
                for ($i=0; $i < count($input['dm_item_name']); ++$i) {
                
                    $inrepair = Repair::where([
                                    ['repair_inventory_id', '=', $input['dm_item_name'][$i]],
                                    ['repair_status', '=', $request -> repair_type],
                                ]) 
                                -> get();

                    if (!empty($inrepairs)){
                            $inrepair -> repair_qty = $input['dm_qty'][$i];
                            $inrepair -> save();
                    }
                    else {
                        $repair = new Repair;
                        $repair -> repair_inventory_id = $input['dm_item_name'][$i];
                        $repair -> repair_user_id = $request -> inventory_user_id;
                        $repair -> repair_ddate = $request -> received_at;
                        $repair -> repair_qty = $input['dm_qty'][$i];
                        $repair -> repair_status = $request -> repair_type;
                        $repair -> save(); 
                    } 
                } 

                 return redirect() -> back() -> with('store-damaged-success', 'Item successfully added to damaged inventory!');
            } 
        }
        
        //session()->flash('message', 'Successfully created a new supplier!');
       
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
        $repair = Repair::find($id);

        if ($request -> update_type == "fixed_qty"){
            //ADD FIXED QTY
            $repair -> repair_qty -= $request -> qty_fixed;
            $repair -> save();

            $inventory_item = Inventory::find($repair->repair_inventory_id);
            $inventory_item -> inventory_qty += $request -> qty_fixed;
            $inventory_item -> save();


            $si_item = new Stockin_Item;
            $si_item -> si_user_id = $request-> handled_by;
            $si_item -> save();

            $stockin = new Stockin;
            $stockin -> si_qty = $request -> qty_fixed;
            $stockin -> si_date = $request-> fixed_at;
            $stockin -> si_inventory_id = $repair-> repair_inventory_id;
            $stockin -> si_si_id = $si_item -> si_item_id;
            $stockin -> save();


            if ($repair -> repair_qty == 0)
            {
                $repair = Repair::destroy($id);   
            }

            return redirect() -> back() -> with('update-damaged-success', 'Item/s fixed,  successfully moved to undamaged inventory!');
        }
        else{
            //EDIT DAMAGED ITEM
            $repair -> repair_qty = $request -> edit_item_dmqty;
            $repair -> repair_status = 1; //repairable
            $repair -> save();

            return redirect() -> back() -> with('update-damaged-success', 'Item successfully edited!');
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
        //
    }

    public function getRepair($id){
        $repairdata = DB::table('repairs')
                    -> join('inventories', 'inventories.inventory_id', '=', 'repairs.repair_inventory_id')
                    -> join ('supplies', 'supplies_inventory_id', '=', 'inventory_id')
                    -> join('suppliers', 'suppliers.supplier_id','=','supplies_supplier_id')
                    // -> join('profiles', 'profiles.profile_user_id', '=', 'repairs.repair_user_id')
                    // -> select('inventories.inventory_name', 'repairs.*', 'profiles.fname', 'profiles.mname', 'profiles.lname', 'suppliers.supplier_name', 'suppliers.supplier_id')
                    -> select('inventories.inventory_name', 'repairs.*','suppliers.supplier_name', 'suppliers.supplier_id')
                    -> where('repairs.repair_id', '=', $id)
                    -> get();
       
        return $repairdata;
    }
}
