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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TermsProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $curr_usr = Auth::user();

        //BASIC TERM DETAILS: LOC, COLLECTOR, DATES
        $term = Term::join('workers', 'terms.term_id', '=', 'worker_term_id')
                -> join('users', 'workers.worker_user_id', '=', 'users.user_id')
                -> join('profiles', 'users.user_id', '=', 'profiles.profile_user_id')
                -> select('terms.*', 'workers.*', 'profiles.fname', 'profiles.mname', 'profiles.lname')
                -> where([
                        ['terms.term_id', '=', $id],
                        ['workers.worker_term_id', '=', $id],
                        ['terms.term_status', '=', 1],
                        ['workers.worker_type', '=', 0]
                    ])
                -> get();
       
        //AVAILABLE PEDDLERS (FOR ADDING PEDDLERS FORM)
        $a_peddlers = DB::table('profiles as T1')
                    -> join('users as T2', 'T2.user_id', '=', 'T1.profile_user_id')
                    -> whereNotIn('user_id', function($query){
                        $query -> select('worker_user_id')
                               -> from('workers')
                               -> join('terms', 'term_id', '=', 'worker_term_id')
                               -> where([
                                    ['term_status' , '=', 1],
                                    ['terms.end_date', '=', null]
                                ]);
                              //  -> where(function($q) {
                              //     $q->where('end_date', '<=', Carbon::now() -> toDateString())
                              //       ->orWhere([
                              //           ['terms.end_date', '=', null]
                              //       ]);
                              // });
                        })
                    -> select('user_id', 'fname', 'mname', 'lname')
                    -> where([
                            ['user_type' , '=', 3],
                            ['user_status' , '=', 1]
                        ])
                    -> get();

        //ALL PEDDLERS
        $peddlers = DB::table('profiles as T1')
                    -> join('users as T2', 'T2.user_id', '=', 'T1.profile_user_id')
                    -> select('user_id', 'fname', 'mname', 'lname')
                    -> where([
                            ['user_type' , '=', 3],
                            ['user_status' , '=', 1]
                        ])
                    -> get();

        //TERM PEDDLERS
        $workers = Term::join('workers', 'terms.term_id', '=', 'worker_term_id')
                -> join('users', 'workers.worker_user_id', '=', 'users.user_id')
                -> join('profiles', 'users.user_id', '=', 'profiles.profile_user_id')
                -> select('terms.*', 'workers.*', 'profiles.fname', 'profiles.mname', 'profiles.lname')
                -> where([
                        ['terms.term_id', '=', $id],
                        ['workers.worker_term_id', '=', $id],
                        ['terms.term_status', '=', 1],
                        ['workers.worker_type', '!=', 0]
                    ])
                -> paginate(5);
    
        //TERM EXPENSES
        $expenses = Term::join('expenses', 'terms.term_id', '=', 'expense_term_id')
                    -> select('terms.term_id', 'terms.term_status', 'expenses.*')
                    -> where([
                        ['terms.term_status', '=', '1'],
                        ['terms.term_id', '=', $id]
                    ])
                    -> paginate(5);

        $total_expense = DB::table('expenses')
                        -> where ('expenses.expense_term_id', '=', $id)
                        -> sum('expense_amt');

        //TERM ITEMS
        $term_items = Term::join('term_items', 'terms.term_id', '=', 'term_items.ti_term_id')
                    -> join('inventories', 'inventories.inventory_id', '=', 'term_items.ti_inventory_id')
                    -> join('suppliers', 'suppliers.supplier_id', '=', 'inventories.inventory_supplier_id')
                    -> select ('terms.term_id', 'term_items.*', 'inventories.inventory_name', 'inventories.inventory_price', 'suppliers.supplier_name', 'suppliers.supplier_id')
                    -> where ([
                        ['terms.term_status', '=', '1'],
                        ['terms.term_id', '=', $id]
                    ])
                    -> paginate(5);

        //AVAILABLE ITEMS
        $a_items = Inventory::join('suppliers', 'suppliers.supplier_id', '=', 'inventory_supplier_id')
                            -> select('inventories.*', 'suppliers.supplier_name')
                            -> where([
                                    ['inventory_status', '=', '1'],
                                    ['inventory_qty', '>', '0'],
                                ])
                            ->  whereNotIn('inventory_id', function($query) use ($id){
                                $query -> select('term_items.ti_inventory_id')
                                       -> from('term_items')
                                       -> join('terms', 'terms.term_id', '=', 'term_items.ti_term_id')
                                       -> where([
                                            ['terms.term_status' , '=', 1],
                                            ['terms.term_id', '=', $id]
                                          ]);
                                })
                            -> orderBy('supplier_name', 'asc')
                            -> get();

        //SUPPLIERS
        $suppliers = Supplier::where('supplier_status' , '=', 1) -> get();

        //NUMBER OF TERM ITEMS
        $total_items = DB::table('term_items')
                        -> where ('term_items.ti_term_id', '=', $id)
                        -> count('ti_id');

        $total_quantity = DB::table('term_items')
                        -> where ('term_items.ti_term_id', '=', $id)
                        -> sum('ti_original');

        $total_damages = DB::table('term_items')
                        -> where ('term_items.ti_term_id', '=', $id)
                        -> sum('ti_damaged');

        $total_returns = DB::table('term_items')
                        -> where ('term_items.ti_term_id', '=', $id)
                        -> sum('ti_returned');

        $total_sales = ($total_quantity - ($total_damages + $total_returns));


        //TERM SALES
        $sales = Term::join('sales', 'terms.term_id', '=', 'sale_term_id')
                    -> select ('terms.term_id', 'terms.term_status', 'sales.*')
                    -> where ([
                        ['terms.term_status', '=', '1'],
                        ['terms.term_id', '=', $id]
                    ])
                    -> paginate(5);
                    
        //TERM CUSTOMERS
        $unpaid_customers = Customer_Order::join('customers', 'customer_id', '=', 'co_customer_id')
                    -> join ('orders', 'order_co_id', '=', 'co_id')
                    -> join ('terms', 'term_id', '=', 'co_term_id')
                    -> join ('term_items', 'order_ti_id', '=', 'ti_id')
                    -> join ('inventories', 'ti_inventory_id', '=', 'inventory_id')
                    -> select ('co_id', 'customers.*', (DB::raw('SUM((inventories.inventory_price + (inventories.inventory_price * 0.25)) * orders.order_qty) as total_payable')))
                    -> where ([
                        ['terms.term_status', '=', '1'],
                        ['terms.term_id', '=', $id],
                        ['customer_orders.co_term_id', '=', $id],
                        ['term_items.ti_term_id', '=', $id],
                        ['co_status', '=', 0]
                    ])
                    -> groupBy('co_id')
                    -> paginate(5);

        $paid_customers = Customer_Order::join('customers', 'customer_id', '=', 'co_customer_id')
                    -> join ('orders', 'order_co_id', '=', 'co_id')
                    -> join ('terms', 'term_id', '=', 'co_term_id')
                    -> join ('term_items', 'order_ti_id', '=', 'ti_id')
                    -> join ('inventories', 'ti_inventory_id', '=', 'inventory_id')
                    -> select ('co_id', 'customers.*', 'co_collect_date', (DB::raw('SUM((inventories.inventory_price + (inventories.inventory_price * 0.25)) * orders.order_qty) as total_payable')))
                    -> where ([
                        ['terms.term_status', '=', '1'],
                        ['terms.term_id', '=', $id],
                        ['customer_orders.co_term_id', '=', $id],
                        ['term_items.ti_term_id', '=', $id],
                        ['co_status', '=', 1]
                    ])
                    -> groupBy('co_id')
                    -> paginate(5);

        $total_sale = 0;

        $total_collected = DB::table('sales')
                        -> where ('sales.sale_term_id', '=', $id)
                        -> sum('sales_amt');




        return view('termsprofile', compact('curr_user', 'workers', 'term', 'a_peddlers', 'expenses', 'term_items', 'sales', 'total_expense', 'peddlers', 'total_items', 'total_damages', 'total_sales', 'total_returns', 'suppliers', 'a_items', 'unpaid_customers', 'paid_customers', 'total_collected', 'total_sale'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
