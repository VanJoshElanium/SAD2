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
        // dd($request);
        $input = Input::all();
        
        for ($i=0; $i < count($input['add_ti_item_name']); ++$i) {

            $item_qty = Inventory::where('inventories.inventory_id', '=', $request -> add_ti_item_name)
                    -> select ('inventory_qty')
                    -> get();

            $validator = Validator::make($request->all(), [
                'add_ti_qty.' .$i  => 'numeric|min:1|max:' .$item_qty[0] -> inventory_qty,
                'add_ti_item_name.*' => 'distinct'
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
                $term_item -> ti_worker_id = $request -> add_ti_worker;
                $term_item -> ti_inventory_id = $input['add_ti_item_name'][$i];
                $term_item -> ti_original = $input['add_ti_qty'][$i];
                $term_item -> ti_damaged = 0;
                $term_item -> ti_returned = 0;
                $term_item -> ti_term_id = $request-> term_id;
                $term_item -> save();

                //Update quantity (deduct) of item in the undamaged inventory
                $inventory_item = Inventory::find($term_item -> ti_inventory_id);
                $inventory_item -> inventory_qty -= $term_item -> ti_original;
                $inventory_item -> save();
            }   
        }
    
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
        $term_item = Term_Item::find($request-> edit_ti_item_name);

        $inven_qty = Term_Item::where('term_items.ti_id', '=', $request -> edit_ti_item_name)
                    -> join ('inventories', 'inventory_id', '=', 'ti_inventory_id')
                    -> select ('inventory_qty')
                    -> get();
                    
        $validator = Validator::make($request->all(), [
                'edit_item_original' => 'numeric|max:' .($inven_qty[0] -> inventory_qty + $term_item -> ti_original),
                'edit_item_damages'  => 'numeric|max:' .($request-> edit_item_original),
                'edit_item_returns'  => 'numeric|max:' .($request-> edit_item_original)
        ]);
        
        if ($validator->fails()) {
            return redirect('/termsprofile/' .$request-> term_id)
                ->withErrors($validator, 'editItem')
                ->withInput($request->all());
        }
        else{
            //Get original quantities, before the update
            $original_qty = $term_item -> ti_original;
            $original_damaged = $term_item -> ti_damaged;
            $original_returned = $term_item -> ti_returned;

            //Update db with new quantities
            $term_item -> ti_original = $request-> edit_item_original;
            $term_item -> ti_damaged = $request-> edit_item_damages;
            $term_item -> ti_returned = $request-> edit_item_returns;
            $term_item -> save();


            // UPDATE UNDAMAGED INVENTORY
                $inventory_item = Inventory::find($term_item -> ti_inventory_id);
                //Update inventories.inventory_qty using edited ti_original qty
                    if ($original_qty <  $term_item -> ti_original) //ex.) 10 -> 11
                        $inventory_item -> inventory_qty -= ($term_item -> ti_original - $original_qty);

                    else if ($original_qty >  $term_item -> ti_original) //ex.) 5 -> 2
                        $inventory_item -> inventory_qty += ($original_qty - $term_item -> ti_original);
                    $inventory_item -> save();

                //Update inventories.inventory_qty using edited ti_returned qty
                    if ($original_returned <  $term_item -> ti_returned) //ex.) 0 -> 4
                        $inventory_item -> inventory_qty += ($term_item -> ti_returned - $original_returned);

                    else if ($original_returned >  $term_item -> ti_returned) //ex.) 4 -> 2
                        $inventory_item -> inventory_qty -= ($original_returned - $term_item -> ti_returned);

                    $inventory_item -> save();
            ///////////////////////////////

            // UPDATE DAMAGED INVENTORY
                if ($original_damaged == 0 && $term_item -> ti_damaged != 0){
                    //Create damaged item
                    $repair = new Repair;
                    $repair -> repair_inventory_id = $term_item -> ti_inventory_id;            
                    $repair -> repair_status = $request -> edit_item_dtype;

                    //Update repairs.repair_qty using edited ti_damaged_qty
                    $repair -> repair_qty = $term_item -> ti_damaged;
                    $repair -> save();
                }   
                else if ($original_damaged != 0 && $term_item -> ti_damaged != 0){
                    $repair = Repair::where('repair_inventory_id', '=', $term_item -> ti_inventory_id);
                    $repair -> repair_status = $request -> edit_item_dtype;

                    //Update repairs.repair_qty using edited ti_damaged_qty
                    if ($original_damaged <  $term_item -> ti_damaged) //ex.) 2 -> 3
                        $repair -> repair_qty += ($term_item -> ti_damaged - $original_damaged);

                    else if ($original_damaged >  $term_item -> ti_damaged) //ex.) 5 -> 2
                        $repair -> repair_qty -= ($original_damaged - $term_item -> ti_damaged);

                    $repair -> save();
                }
            ///////////////////////////////
        }
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
        $term_item = Term_Item::find($id);
        $inventory_item = Inventory::find($term_item -> ti_inventory_id);

        //DAMAGED INVENTORY
            if ($term_item -> ti_damaged != 0){
                $repair_item = Repair::where('repair_inventory_id', '=', $term_item-> ti_inventory_id) -> get();
                
                if ($term_item -> ti_damaged == $repair_item[0] -> repair_qty)
                    $repair = Repair::destroy($repair_item[0] -> repair_id);
                else{
                    $repair_item -> repair_qty -= $term_item -> ti_damaged;
                    $repair_item -> save();

                    $inventory_item -> inventory_qty += $term_item -> ti_damaged; //++damages
                    $inventory_item -> save();
                }
            }

        //UNDAMAGED INVENTORY
            $inventory_item -> inventory_qty += $term_item -> ti_returned; // ++returns
            $inventory_item -> inventory_qty += $term_item -> ti_original - ($term_item -> ti_returned + $term_item -> ti_damaged); // ++sold
            $inventory_item -> save();

            $term_item = Term_Item::destroy($id);

        return redirect('/termsprofile/' .$term_item -> ti_term_id);
    }

    public function getTermItem($id)
    {
        $tidata = Term_Item::find($id);
        return $tidata;
    }

    public function printItems($id){
        $term_items = Term::join('term_items', 'terms.term_id', '=', 'term_items.ti_term_id')
                    -> join('inventories', 'inventories.inventory_id', '=', 'term_items.ti_inventory_id')
                    -> join('suppliers', 'suppliers.supplier_id', '=', 'inventories.inventory_supplier_id')
                    -> select ('terms.term_id', 'term_items.*', 'inventories.inventory_name', 'inventories.inventory_price', 'suppliers.supplier_name', 'suppliers.supplier_id')
                    -> where ([
                        ['terms.term_id', '=', $id]
                    ])
                    -> get();
        $pdf = PDF::loadView('termitems', compact('term_items'));
        return $pdf->download('termitems.pdf');
    }
}
