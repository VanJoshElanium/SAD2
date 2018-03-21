<?php


namespace App\Http\Controllers;

use Validator;
use App\User;
use App\Supply;
use App\Repair;
use App\Stockin;
use App\Stockin_Item;
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

        //ACTIVE SUPPLIERS
        $suppliers = Supplier::where('supplier_status' , '=', 1)
                    ->get();

        //ACTIVE WORKERS
        $workers = User::where([
                        ['user_type', '=', 3], //WORKER USER TYPE
                        ['user_status', '=', 1]
                    ])
                    -> join('profiles', 'profiles.profile_user_id', '=', 'users.user_id')
                    -> select('users.user_id', 'profiles.fname', 'profiles.mname', 'profiles.lname')
                    -> get();

        $users = User::join('profiles', 'profiles.profile_user_id', '=', 'users.user_id')
                    -> select('users.user_id', 'profiles.fname', 'profiles.mname', 'profiles.lname') 
                    -> get();


        if($request->has('titlesearch')){
            $items = Inventory::search($request->input('titlesearch')) 
                -> paginate(5);
        }else{
            //DAMAGED ITEMS
            $rrepairs = Repair::join('inventories', 'inventories.inventory_id', '=', 'repairs.repair_inventory_id')
                -> join('suppliers', 'suppliers.supplier_id', '=', 'inventories.inventory_supplier_id')
                -> select('inventories.*',  'repairs.*', 'suppliers.supplier_name', 'suppliers.supplier_id')
                -> where('repair_status', '1')
                -> groupBy('inventory_id')
                -> orderBy('repairs.updated_at', 'desc')
                -> paginate(10);

            $urepairs = Repair::join('inventories', 'inventories.inventory_id', '=', 'repairs.repair_inventory_id')
                -> join('suppliers', 'suppliers.supplier_id', '=', 'inventories.inventory_supplier_id')
                -> select('inventories.*',  'repairs.*', 'suppliers.supplier_name', 'suppliers.supplier_id')
                -> where('repair_status', '0')
                -> groupBy('inventory_id')
                -> orderBy('repairs.updated_at', 'desc')
                -> paginate(10);
            
            //ACTIVE INVENTORY ITEMS
            $items = Inventory::join('suppliers', 'suppliers.supplier_id', '=', 'inventories.inventory_supplier_id')
                // -> join('suppliers', 'suppliers.supplier_id', '=', 'supplies.supply_supplier_id')
                -> select('inventories.*',  'suppliers.supplier_name')
                -> orderBy('inventories.updated_at', 'desc')
                -> paginate(10);
        } 
        return view('inventory', compact('items', 'curr_usr', 'suppliers', 'workers', 'rrepairs', 'urepairs', 'users'));
    }

    public function getItem($id)
    {
        $itemdata= Inventory::join('stockins', 'si_inventory_id', '=', 'inventories.inventory_id')
                -> join('stockin_items', 'si_item_id','=', 'si_si_id')
                -> join('users', 'users.user_id', '=', 'stockin_items.si_user_id')
                -> join('profiles', 'profiles.profile_user_id', '=', 'users.user_id')
                -> join('suppliers', 'suppliers.supplier_id', '=', 'inventories.inventory_supplier_id')
                -> select('inventories.*', 'stockins.*', 'stockin_items.*', 'suppliers.supplier_id', 'suppliers.supplier_name', 'profiles.fname', 'profiles.mname', 'profiles.lname', 'users.user_id')
                -> where('inventories.inventory_id', '=', $id)
                -> orderBy ('si_date', 'desc')
                -> first();

        return $itemdata;
    }


    public function getSupply($id)
    {
        // $id = suppliers.supplier_id
        //GET SUPPLIERS SUPPLIED ITEMS

        $supplies = Inventory::select('inventories.inventory_id', 'inventories.inventory_name', 'inventories.inventory_qty', 'inventories.inventory_price')
                    -> where([
                            ['inventory_supplier_id', '=', $id],
                            ['inventory_status', '!=', 0]
                        ])
                    -> get();
        //Session::flash('message', 'User has been successfully created!');
        return $supplies;
    }

    public function getSupplyDamaged($id){
        $supplies = Inventory::select('inventories.inventory_id', 'inventories.inventory_name', 'inventories.inventory_qty', 'inventories.inventory_price')
                    -> where([
                            ['inventory_supplier_id', '=', $id]
                        ])
                    -> get();
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
        if ($id == -999) //STOCKING IN
        {
            $input = Input::all();
            
            $validator = Validator::make($request->all(), [
                'supply_name.*' => 'distinct'
            ]);
            
            $attributeNames = array(
                   'supply_name.*' => "item name",
                );
           $validator->setAttributeNames($attributeNames);

            if ($validator->fails()) 
            {
                return redirect('/inventory')
                    ->withErrors($validator, 'addUn')
                    ->withInput($request->all());
                    // ->with('upd-form-error', "Error! Duplicate item names.");
            }
            else
            {
                $si_item = new Stockin_Item;
                $si_item -> si_user_id = $request->get('inventory_user_id');
                $si_item -> save();

                for ($i=0; $i < count($input['inventory_quantity']); ++$i) {
                    $item = Inventory::find($input['supply_name'][$i]);
                    // $item -> inventory_user_id = $request->get('inventory_user_id');
                    // $item -> received_at = $request->get('received_at');
                    $item -> inventory_supplier_id = $input['supplier_name'];
                    // $item -> inventory_price = $input['inventory_price'][$i];
                    $item -> inventory_qty += $input['inventory_quantity'][$i];
                    $item -> inventory_status = 1;
                    $item -> save();
    

                    $stockin = new Stockin;
                    $stockin -> si_qty = $input['inventory_quantity'][$i];
                    $stockin -> si_date = $request->get('received_at');
                    $stockin -> si_inventory_id = $item -> inventory_id;
                    $stockin -> si_si_id = $si_item -> si_item_id;
                    $stockin -> save();


                }

                return redirect() -> back () -> with('store-undamaged-success', 'Item/s successfully stocked in!');
            }             
        }
        else //UPDATING
        {
            $input = Input::all();


            $validator = Validator::make($request->all(), [
                'view_inventory_quantity' => 'nullable'
            ]);
            
            $attributeNames = array(
                   'view_inventory_quantity.*' => "quantity",
                );
           $validator->setAttributeNames($attributeNames);

            if ($validator->fails()) 
            {
                return redirect('/inventory')
                    ->withErrors($validator, 'addUn')
                    ->withInput($request->all());
                    // ->with('input_error_id', $error_id);
            }
            else{   
                $item = Inventory::find($id);     
                
                $original_qty = $item -> inventory_qty;
                $item -> inventory_qty = $input['view_inventory_quantity'];
                $item -> save(); 

                if ($original_qty < $input['view_inventory_quantity']){

                    $si_item = new Stockin_Item;
                    $si_item -> si_user_id = \Auth::user() -> user_id;
                    $si_item -> save();

                    $stockin = new Stockin;
                    $stockin -> si_qty = ($input['view_inventory_quantity']-$original_qty);
                    $stockin -> si_date = Carbon::now() -> toDateTimeString();
                    $stockin -> si_inventory_id = $id;
                    $stockin -> si_si_id = $si_item -> si_item_id;
                    $stockin -> save();
                }
                return redirect() -> back() -> with ('update-undamaged-success', 'Item successfully edited!');
            }
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
        $item = Inventory::find($id);
        $item -> inventory_status = 0;
        $item -> save();
        //dd($supply); //for debugging purposes
        return redirect() -> back() -> with ('destroy-undamaged-success', 'Success! Item will be removed when its quantity becomes 0!');
        
        //Session::flash('message', 'User has been successfully removed!');*/
    }
}
