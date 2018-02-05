<?php

namespace App\Http\Controllers;


use App\Term;
use App\User;
use Validator;
use App\Worker;
use App\Inventory;
use App\Term_Item;
use App\Expense;
use App\Sale;
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
                $term_item -> ti_inventory_id = $input['add_ti_item_name'][$i];
                $term_item -> ti_original = $input['add_ti_qty'][$i];
                $term_item -> ti_term_id = $request-> term_id;
                $term_item -> save();
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

        $inven_qty = Term_Item::where('term_items.ti_id', '=', $request -> edit_ti_item_name)
                    -> join ('inventories', 'inventory_id', '=', 'ti_inventory_id')
                    -> select ('inventory_qty')
                    -> get();
                    
        $validator = Validator::make($request->all(), [
                'edit_item_original' => 'numeric|max:' .$inven_qty[0] -> inventory_qty,
                'edit_item_damages'  => 'numeric|max:' .($request-> edit_item_original),
                'edit_item_returns'  => 'numeric|max:' .($request-> edit_item_original)
        ]);
        
        if ($validator->fails()) {
            return redirect('/termsprofile/' .$request-> term_id)
                ->withErrors($validator, 'editItem')
                ->withInput($request->all());
        }
        else{
            $term_item = Term_Item::find($request-> edit_ti_item_name);
            // $term_item -> ti_date = $request -> edit_ti_date;
            $term_item -> ti_original = $request-> edit_item_original;
            $term_item -> ti_damaged = $request-> edit_item_damages;
            $term_item -> ti_returned = $request-> edit_item_returns;
            $term_item -> save();
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
        $term = $term_item -> ti_term_id;

        $term_item = Term_Item::destroy($id);
        return redirect('/termsprofile/' .$term);
    }

    public function getTermItem($id)
    {
        $tidata = Term_Item::find($id);
        return $tidata;
    }
}
