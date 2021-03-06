<?php

namespace App\Http\Controllers;

use PDF;
use App\Term;
use App\User;
use Validator;
use App\Worker;
use App\Inventory;
use App\Term_Item;
use App\Expense;
use App\Stockin;
use App\Stockin_Item;
use App\Sale;
use App\Repair;
use App\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTerm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class Term_ItemController extends Controller
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

        for ($i=0; $i < count($input['add_ti_item_name']); ++$i) {

            $item_qty = Inventory::where('inventories.inventory_id', '=', $input['add_ti_item_name'][$i])
                    -> select ('inventory_qty')
                    -> get();

            $item_price = Inventory::where('inventories.inventory_id', '=', $input['add_ti_item_name'][$i])
                    -> select ('inventory_price')
                    -> get();

            $validator = Validator::make($request->all(), [
                'add_ti_qty.' .$i  => 'numeric|min:1|max:' .$item_qty[0] -> inventory_qty,
                'add_ti_item_name.*' => 'distinct',
                'add_ti_date' => 'required|date'
            ]);
            
            if ($validator->fails()) {
                return redirect('/termsprofile/' .$request-> term_id)
                    ->withErrors($validator, 'addItem')
                    ->withInput($request->all());
                    // ->with('input_error_id', $error_id);
            }
            else{
                $term_item = new Term_Item;
                $term_item -> ti_date = $request -> add_ti_date;
                $term_item -> ti_user_id = $request -> add_ti_worker;
                $term_item -> ti_price = $item_price[0] -> inventory_price + ($item_price[0]-> inventory_price * 0.25);
                $term_item -> ti_inventory_id = $input['add_ti_item_name'][$i];
                $term_item -> ti_original = $input['add_ti_qty'][$i];
                $term_item -> ti_udamaged = 0;
                $term_item -> ti_rdamaged = 0;
                $term_item -> ti_returned = 0;
                $term_item -> ti_term_id = $request-> term_id;
                $term_item -> save();

                //Update quantity (deduct) of item in the undamaged inventory
                $inventory_item = Inventory::find($term_item -> ti_inventory_id);
                $inventory_item -> inventory_qty -= $term_item -> ti_original;
                $inventory_item -> save();
            }   
        } 

        if (count($input['add_ti_item_name']) > 1)
            return redirect() -> back() -> with('store-item-success','Items were successfully added to term!');
        else return redirect() -> back() -> with('store-item-success','Item was successfully added to term!');
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
    public function update(Request $request, $id){  
        $term_item = Term_Item::find($request-> edit_ti_item_name);

        $inven_qty = Term_Item::where('term_items.ti_id', '=', $request -> edit_ti_item_name)
                    -> join ('inventories', 'inventory_id', '=', 'ti_inventory_id')
                    -> select ('inventory_qty')
                    -> get();
                    
        $validator = Validator::make($request->all(), [
                'edit_item_original' => 'numeric|max:' .($inven_qty[0] -> inventory_qty + $term_item -> ti_original),
                'edit_item_udamages'  => 'numeric|max:' .($request-> edit_item_original),
                'edit_item_rdamages'  => 'numeric|max:' .($request-> edit_item_original),
                'edit_item_returns'  => 'numeric|max:' .($request-> edit_item_original)
        ]);
        
        if ($validator->fails()) {
            return redirect('/termsprofile/' .$request-> term_id)
                ->withErrors($validator, 'editItem')
                ->withInput($request->all());
        }
        else{
            //Get original quantities from DB, before the update
            $original_qty = $term_item -> ti_original;
            $original_rdamaged = $term_item -> ti_rdamaged;
            $original_udamaged = $term_item -> ti_udamaged;
            $original_returned = $term_item -> ti_returned;

            //Update db with new quantities
            $term_item -> ti_original = $request-> edit_item_original;
            $term_item -> ti_udamaged = $request-> edit_item_udamages; 
            $term_item -> ti_rdamaged = $request-> edit_item_rdamages;
            $term_item -> ti_returned = $request-> edit_item_returns;
            $term_item -> save();

          
            // UPDATE UNDAMAGED INVENTORY
                $inventory_item = Inventory::find($term_item -> ti_inventory_id);

                //Update inventories.inventory_qty using edited ti_original qty
                    if ($original_qty <  $term_item -> ti_original){ //ex.) 10 -> 11
                        $inventory_item -> inventory_qty -= ($term_item -> ti_original - $original_qty);
                    }
                    if ($original_qty >  $term_item -> ti_original){ //ex.) 5 -> 2
                        $inventory_item -> inventory_qty += ($original_qty - $term_item -> ti_original);
                    }
                    $inventory_item -> save();

                //Update inventories.inventory_qty using edited ti_returned qty
                    if ($original_returned == 0 && $term_item -> ti_returned != 0){
                        $inventory_item -> inventory_qty += $term_item -> ti_returned;

                        $si_item = new Stockin_Item;
                        $stockin -> si_term_id = $term_item -> ti_term_id;
                        $si_item -> si_user_id = $request -> edit_item_handler;
                        $si_item -> save();

                        $stockin = new Stockin;
                        $stockin -> si_inventory_id = $term_item -> ti_inventory_id;
                        $stockin -> si_qty = $term_item -> ti_returned;
                        $stockin -> si_si_id = $si_item -> si_item_id;
                        $si_item -> si_date = $request -> edit_item_date;
                        $stockin -> save();
                        $inventory_item -> save();
                    }
                   
                    if ($original_returned != 0 && $term_item -> ti_returned != $original_returned){

                        // $stock_in = Stockin::where([
                        //                 ['si_inventory_id', '=', $term_item -> ti_inventory_id],
                        //                 ['si_term_id', '=', $term_item -> ti_term_id],
                        //             ])
                        //             -> get();
                         
                        // $og_stock_in = $stock_in[0] -> si_qty;

                        if ($original_returned <  $term_item -> ti_returned){ //ex.) 1 -> 4
                            $inventory_item -> inventory_qty += ($term_item -> ti_returned - $original_returned);
                            // $stock_in[0] -> si_qty += ($term_item -> ti_returned - $og_stock_in);
                        }

                        if ($original_returned >  $term_item -> ti_returned){ //ex.) 4 -> 2
                            $inventory_item -> inventory_qty -= ($original_returned - $term_item -> ti_returned);
                            // $stock_in[0] -> si_qty -= ($og_stock_in  - $term_item -> ti_returned);
                        }
                        $inventory_item -> save();
                        // $stock_in[0] -> save();
                    }
            ///////////////////////////////

            // UPDATE DAMAGED INVENTORY
                if ($original_udamaged == 0 && $term_item -> ti_udamaged != 0 && $request-> edit_item_udamages != $original_udamaged){                
                    //Update repairs.repair_qty using edited udamages_qty; Irreparable
                    $repair = new Repair;
                    $repair -> repair_inventory_id = $term_item -> ti_inventory_id; 
                    $repair -> repair_term_id = $term_item -> ti_term_id;
                    $repair -> repair_user_id = \Auth::User() -> user_id;
                    $repair -> repair_qty = $request-> edit_item_udamages;
                    $repair -> repair_ddate = $request-> edit_item_date;
                    $repair -> repair_status = 0; 
                    $repair -> save();
                } 

                if ($original_rdamaged == 0 && $term_item -> ti_rdamaged != 0 && $request-> edit_item_rdamages != $original_rdamaged){                
                    //Update repairs.repair_qty using edited rdamages_qty; Repairable
                    $repair = new Repair;
                    $repair -> repair_inventory_id = $term_item -> ti_inventory_id; 
                    $repair -> repair_term_id = $term_item -> ti_term_id;
                    $repair -> repair_user_id = \Auth::User() -> user_id;
                    $repair -> repair_qty = $request-> edit_item_rdamages;
                    $repair -> repair_ddate = $request-> edit_item_date;
                    $repair -> repair_status = 1; 
                    $repair -> save();
                }  

                if ($original_udamaged != 0  && $term_item -> ti_udamaged != $original_udamaged) {
                    $urepair = Repair::where([
                                    ['repair_inventory_id', '=', $term_item -> ti_inventory_id],
                                    ['repair_term_id', '=', $term_item -> ti_term_id],
                                    ['repair_status', '=', 0]
                                ])
                                -> get();

                    //Update repairs.repair_qty using edited udamages_qty //Irreparable
                    if ($urepair[0] -> repair_qty <  $request-> edit_item_udamages){ //ex.) 2 -> 3
                        $urepair[0] -> repair_qty += ($request-> edit_item_udamages - $original_udamaged);
                    }
                    if ($urepair[0] -> repair_qty >  $request-> edit_item_udamages){ //ex.) 5 -> 2
                        $urepair[0] -> repair_qty -= ($original_udamaged - $request-> edit_item_udamages);
                    }
                    $urepair[0] -> save();

                    if ($urepair[0] -> repair_qty == 0)
                        $bye = Repair::destroy($urepair[0] -> repair_id);
                }

                if ($original_rdamaged != 0 && $term_item -> ti_rdamaged != $original_rdamaged){
                    $rrepair = Repair::where([
                                    ['repair_inventory_id', '=', $term_item -> ti_inventory_id],
                                    ['repair_term_id', '=', $term_item -> ti_term_id],
                                    ['repair_status', '=', 1]
                                ])
                                -> get();
                   

                    //Update repairs.repair_qty using edited rdamages_qty //Irreparable
                    if ($rrepair[0] -> repair_qty <  $request-> edit_item_rdamages){ //ex.) 2 -> 3
                        $rrepair[0] -> repair_qty += ($request-> edit_item_rdamages - $original_rdamaged);
                    }
                    if ($rrepair[0] -> repair_qty >  $request-> edit_item_rdamages){ //ex.) 5 -> 2
                        $rrepair[0] -> repair_qty -= ($original_rdamaged - $request-> edit_item_rdamages);
                    }
                    $rrepair[0] -> save();

                    if ($rrepair[0] -> repair_qty == 0)
                        $bye = Repair::destroy($rrepair[0] -> repair_id);
                  
                }

            return redirect() -> back() -> with('update-item-success','Item was successfully edited!');
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

        $term_item = Term_Item::find($id);
        $term = $term_item -> ti_term_id;
  
        $inventory_item = Inventory::find($term_item -> ti_inventory_id);

        //DAMAGED INVENTORY
            if ($term_item -> ti_udamaged != 0){
                $urepair_item = Repair::where([
                            ['repair_inventory_id', '=', $term_item-> ti_inventory_id],
                            ['repair_term_id', '=', $term_item-> ti_term_id],
                            ['repair_status', '=', 0] //Irreparable
                        ]) -> get();

                $rrepair_item = Repair::where([
                            ['repair_inventory_id', '=', $term_item-> ti_inventory_id],
                            ['repair_term_id', '=', $term_item-> ti_term_id],
                            ['repair_status', '=', 1] //Repairable
                        ]) -> get();
                
                if ($term_item -> ti_udamaged == $urepair_item[0] -> repair_qty)
                    $repair = Repair::destroy($urepair_item[0] -> repair_id);
                    
                else{
                    $urepair_item -> repair_qty -= $term_item -> ti_udamaged;
                    $urepair_item -> save();
                    // $inventory_item -> inventory_qty += $term_item -> ti_udamaged; //++damages
                    // $inventory_item -> save();

                }

                // $stockin = new Stockin_Item;
                // $stockin -> si_date = 
                // $stockin -> si_user_id = 
                if ($term_item -> ti_rdamaged == $rrepair_item[0] -> repair_qty)
                    $rrepair = Repair::destroy($rrepair_item[0] -> repair_id);
                else{
                    $repair_item -> repair_qty -= $term_item -> ti_rdamaged;
                    $rrepair_item -> save();

                    // $inventory_item -> inventory_qty += $term_item -> ti_rdamaged; //++damages
                    // $inventory_item -> save();
                }
            }

        //UNDAMAGED INVENTORY
            $inventory_item -> inventory_qty += $term_item -> ti_returned; // ++returns
            $inventory_item -> inventory_qty += $term_item -> ti_original - ($term_item -> ti_returned + $term_item -> ti_udamaged +$term_item -> ti_rdamaged); // ++sold
            $inventory_item -> save();

            $term_item = Term_Item::destroy($id);

        return redirect() -> back() -> with('destroy-item-success','Item was successfully removed from term!');
    }

    public function getTermItem($id)
    { 
        $tidata = new \stdClass();
        $tidata = Term_Item::find($id);


        return json_encode($tidata);
    }

    public function printItems($id){
        $term_items = Term::join('term_items', 'terms.term_id', '=', 'term_items.ti_term_id')
                    -> join ('workers', 'worker_term_id', '=', 'term_id')
                    -> join ('profiles as handler', 'handler.profile_user_id', '=', 'ti_user_id')
                    -> join('profiles as worker', 'worker.profile_user_id', '=', 'worker_user_id')
                    -> join('inventories', 'inventories.inventory_id', '=', 'term_items.ti_inventory_id')
                    -> join ('supplies', 'supplies_inventory_id', '=', 'inventory_id')
                    -> join('suppliers', 'suppliers.supplier_id', '=', 'supplies_supplier_id')
                    -> select ('terms.*', 'term_items.*', 'inventories.inventory_name', 'inventories.inventory_price', 'suppliers.supplier_name', 'suppliers.supplier_id', 'worker.fname as cfname', 'worker.mname as cmname', 'worker.lname as clname', 'handler.fname as hfname', 'handler.mname as hmname', 'handler.lname as hlname')
                    -> where ([
                        ['terms.term_id', '=', $id],
                        ['worker_term_id', '=', $id]
                    ])
                    -> groupBy('ti_id')
                    -> get();
        // dd($term_items);
        $pdf = PDF::loadView('termitems', compact('term_items'));
        return $pdf->stream();
    }

    public function udpateQty(Request $request){
        $input = Input::all();

        $flag = false;
        $si_item = null;

        for ($x=0; $x < count($input['upd_return_qty']); $x++) {
            if ($input['upd_return_qty'][$x] != 0 )
                $flag = true;
        }
    
        if ($flag == true){
            $si_item = new Stockin_Item;
            $si_item -> si_term_id = $request -> term_id;
            $si_item -> si_user_id = $input['upd_ti_worker'];
            $si_item -> save();
        }

        for ($i=0; $i < count($input['upd_ti_item_name']); $i++) {
        
            $item_qty = Inventory::where('inventories.inventory_id', '=', $input['upd_ti_item_name'][$i])
                    -> select ('inventory_qty')
                    -> get();

            $validator = Validator::make($request->all(), [
                'upd_ti_item_name.*' => 'distinct',
                'upd_ti_date' => 'required|date'
            ]);
            
            if ($validator->fails()) {
                return redirect('/termsprofile/' .$request-> term_id)
                    ->withErrors($validator, 'updItem')
                    ->withInput($request->all());
                    // ->with('input_error_id', $error_id);
            }

            else{
                $term_item = Term_Item::find($input['upd_ti_item_name'][$i]);
                $inventory_item = Inventory::find($term_item -> ti_inventory_id);

                $original_rdamaged = $term_item -> ti_rdamaged;
                $original_udamaged = $term_item -> ti_udamaged;
                $original_returned = $term_item -> ti_returned;

                if ($input['upd_return_qty'][$i] != 0 ){
                    $term_item -> ti_returned += $input['upd_return_qty'][$i];
                    $inventory_item -> inventory_qty += $input['upd_return_qty'][$i];
                    $inventory_item -> save();
                    $term_item -> save();

                    $stockin = new Stockin;
                    $stockin -> si_qty = $input['upd_return_qty'][$i];
                    $stockin -> si_date = $input['upd_ti_date'];
                    $stockin -> si_inventory_id = $inventory_item -> inventory_id;
                    $stockin -> si_si_id = $si_item -> si_item_id;
                    $stockin -> save();
                }

                // UPDATE DAMAGED INVENTORY
                if ($original_udamaged == 0 && $input['upd_uqty'][$i] != 0){  
                              
                    //Update repairs.repair_qty using new udamages_qty; Irreparable
                    $term_item -> ti_udamaged += $input['upd_uqty'][$i];
                    $term_item -> save();

                    $repair = new Repair;
                    $repair -> repair_inventory_id = $inventory_item -> inventory_id;
                    $repair -> repair_term_id = $term_item -> ti_term_id;
                    $repair -> repair_user_id = $input['upd_ti_worker'];
                    $repair -> repair_qty = $input['upd_uqty'][$i];
                    $repair -> repair_ddate = $input['upd_ti_date'];
                    $repair -> repair_status = 0; 
                    $repair -> save();
                } 

                if ($original_rdamaged == 0 && $input['upd_rqty'][$i] != 0){  
                                 
                    //Update repairs.repair_qty using nre rdamages_qty; Repairable
                    $term_item -> ti_rdamaged += $input['upd_rqty'][$i];
                    $term_item -> save();

                    $repair = new Repair;
                    $repair -> repair_inventory_id = $inventory_item -> inventory_id;
                    $repair -> repair_term_id = $term_item -> ti_term_id;
                    $repair -> repair_user_id = $input['upd_ti_worker'];
                    $repair -> repair_qty = $input['upd_rqty'][$i];
                    $repair -> repair_ddate = $input['upd_ti_date'];
                    $repair -> repair_status = 1; 
                    $repair -> save();
                }  


                if ($original_udamaged != 0  && $input['upd_uqty'][$i] != 0) {
                    $urepair = Repair::where([
                                    ['repair_inventory_id', '=', $inventory_item -> inventory_id],
                                    ['repair_term_id', '=', $term_item -> ti_term_id],
                                    ['repair_status', '=', 0]
                                ])
                                -> get();
                    $term_item -> ti_udamaged = $input['upd_uqty'][$i];
                    $urepair[0] -> repair_qty += $input['upd_uqty'][$i];

                    $urepair[0] -> save();
                    $term_item -> save();
                }

                if ($original_rdamaged != 0 && $input['upd_rqty'][$i] != 0){
                    $rrepair = Repair::where([
                                    ['repair_inventory_id', '=', $inventory_item -> inventory_id],
                                    ['repair_term_id', '=', $term_item -> ti_term_id],
                                    ['repair_status', '=', 1]
                                ])
                                -> get();
                    $term_item -> ti_rdamaged = $input['upd_rqty'][$i];
                    $rrepair[0]-> repair_qty += $input['upd_rqty'][$i];

                    $rrepair[0]-> save();
                    $term_item -> save();
                }

            } 
        }

        if (count($input['upd_ti_item_name']) > 1)
            return redirect() -> back() -> with('upd-item-success','Items were successfully updated!');
        else return redirect() -> back() -> with('upd-item-success','Item was successfully updated!');
    
    }
}
