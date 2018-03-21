<?php

namespace App\Http\Controllers;

use App\Term;
use App\User;
use Validator;
use App\Worker;
use App\Term_Item;
use App\Customer;
use App\Customer_Order;
use App\Order;
use App\Expense;
use App\Sale;
use App\Supplier;
use App\Inventory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTerm;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
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
        
        for ($i=0; $i < count($input['item_name']); ++$i) {
            $ti_qty = Term_item::where('term_items.ti_id', '=', $input['item_name'][$i])
                    -> select ('ti_original')
                    -> get();

            $validator = Validator::make($request->all(), [
                    'item_name.*' => 'distinct',
                    'fname' => array(
                             'required',
                             'max:50',
                             'string',
                             'regex:/^[a-zA-Z-]/'), 
                    'mname' => array(
                                 'required',
                                 'max:1',
                                 'string',
                                 'regex:/^[a-zA-Z]/'),
                    'lname' => array(
                                 'required',
                                 'max:50',
                                 'string',
                                 'regex:/^[a-zA-Z-]/'),
                    'gender' => 'required|string',
                    'cnum' => 'required|digits:11',
                    'addr' => 'required|string',
                    'item_qty.' .$i  => 'numeric|min:1|max:' .$ti_qty[0] -> ti_original,
                ]);
        } 
            $attributeNames = array(
                    'item_name.*' => "item name",
                    'fname' => "first name",
                    'mname' => 'middle initial',
                    'lname' => 'last name',
                    'cnum' => 'contact number',
                    'addr' => 'address',
                    'item_qty.*' => 'quantity'
                );
            $validator->setAttributeNames($attributeNames);

            if ($validator->fails()) 
            {
                return redirect() -> back()
                    ->withErrors($validator, 'addCustomer')
                    ->withInput($request->all());
            }
            else
            {
                $customer = new Customer;
                $customer -> customer_fname = $input['fname'];
                $customer -> customer_mname = $input['mname'];
                $customer -> customer_lname = $input['lname'];
                $customer -> customer_gender = $input['gender'];
                $customer -> customer_addr = $input['addr'];
                $customer -> customer_cnum = $input['cnum'];
                $customer -> customer_status = 0;
                $customer -> save();

                $customer_order = new Customer_Order;
                $customer_order -> co_term_id = $request -> term_id;
                $customer_order -> co_customer_id = $customer -> customer_id;
                $customer_order -> co_status = 0;
                $customer_order -> save();

                for ($i=0; $i < count($input['item_name']); ++$i) {
                    $order = new Order;
                    $order -> order_qty = $input['item_qty'][$i];
                    $order -> order_ti_id = $input['item_name'][$i];
                    $order -> order_co_id = $customer_order -> co_id;
                    $order -> save();
                }

                return redirect('/termsprofile/' .$request-> term_id) -> with('store-customer-success','Customer was successfully added to term!');
            }      
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
        
        if ($request -> update_type != "confirm_payment"){
            for ($i=0; $i < count($input['edit_item_name']); ++$i) {
                $ti_qty = Term_item::where('term_items.ti_id', '=', $input['edit_item_name'][$i])
                        -> select ('ti_original')
                        -> get();

                $validator = Validator::make($request->all(), [
                        'edit_item_name.*' => 'distinct',
                        'edit_fname' => array(
                                 'required',
                                 'max:50',
                                 'string',
                                 'regex:/^[a-zA-Z-]/'), 
                        'edit_mname' => array(
                                     'required',
                                     'max:1',
                                     'string',
                                     'regex:/^[a-zA-Z]/'),
                        'edit_lname' => array(
                                     'required',
                                     'max:50',
                                     'string',
                                     'regex:/^[a-zA-Z-]/'),
                        'edit_gender' => 'required|string',
                        'edit_cnum' => 'required|digits:11',
                        'edit_addr' => 'required|string',
                        'edit_item_qty.' .$i  => 'numeric|min:1|max:' .$ti_qty[0] -> ti_original,
                    ]);

                    $attributeNames = array(
                        'edit_item_name.*' => 'item name',
                        'edit_fname' => "first name",
                        'edit_mname' => 'middle initial',
                        'edit_lname' => 'last name',
                        'edit_cnum' => 'contact number',
                        'edit_addr' => 'address',
                        'edit_item_qty.*' => 'quantity'
                    );

                if ($validator->fails()) 
                    {
                        return redirect('/termsprofile/' .$request-> term_id)
                            ->withErrors($validator, 'editCustomer')
                            ->withInput($request->all())
                            ->with('error_id', $id);
                    }
            }


            $customer = Customer_Order::join('customers', 'customer_id', '=', 'co_customer_id')
                    -> where ('co_id', '=', $id)
                    -> select ('co_customer_id')
                    -> get();
            $customer = Customer::find($customer[0] -> co_customer_id);

            $customer -> customer_fname = $input['edit_fname'];
            $customer -> customer_mname = $input['edit_mname'];
            $customer -> customer_lname = $input['edit_lname'];
            $customer -> customer_gender = $input['edit_gender'];
            $customer -> customer_addr = $input['edit_addr'];
            $customer -> customer_cnum = $input['edit_cnum'];
            $customer -> customer_status = 0;
            $customer -> save();

            $orders = Order::join('customer_orders', 'co_id', '=', 'order_co_id')
                        -> where ('co_id', '=', $id)
                        -> get();

            if (count($orders) == count($input['edit_item_name']))
                for ($i=0; $i < count($input['edit_item_name']); ++$i) {
                    $orders[$i] -> order_qty = $input['edit_item_qty'][$i];
                    $orders[$i] -> order_ti_id = $input['edit_item_name'][$i];
                    $orders[$i] -> save();
                }
            else dd('Whoops');
        }
        else{
            $customer_order = Customer_Order::find($id);
            $customer_order -> co_collect_date = $request -> collect_date;
            $customer_order -> co_status = 1;
            $customer_order -> save();        
        }

        return redirect('/termsprofile/' .$request-> term_id) -> with('destroy-customer-success','Customer was successfully edited!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer_order = Customer_Order::find($id);
        $term = $customer_order -> co_term_id;

        $customer_order -> orders() -> delete ();
        $customer_order -> delete();
        // $customer = Customer_Order::destroy($id);
        return redirect('/termsprofile/' .$term) -> with('destroy-customer-success','Customer was successfully removed from term!');
    }

    public function getCustomerOrder(Request $request){
        $codata = Customer_Order::join('customers', 'customer_id', '=', 'co_customer_id')
                    -> join ('orders', 'order_co_id', '=', 'co_id')
                    -> join ('terms', 'term_id', '=', 'co_term_id')
                    -> join ('term_items', 'order_ti_id', '=', 'ti_id')
                    -> join ('inventories', 'ti_inventory_id', '=', 'inventory_id')
                    -> join ('suppliers', 'inventory_supplier_id', '=', 'supplier_id')
                    -> select ('customers.*', 'inventory_name', 'supplier_name', 'ti_id', 'order_qty', 'inventory_price', 'co_id')
                    -> where ([
                        ['terms.term_status', '=', '1'],
                        ['terms.term_id', '=', $request -> term_id],
                        ['customer_orders.co_term_id', '=', $request -> term_id],
                        ['term_items.ti_term_id', '=', $request -> term_id],
                        ['co_id', '=', $request -> id],
                    ])
                    -> get();
        return $codata;
    }
}
