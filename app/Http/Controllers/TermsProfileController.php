<?php

namespace App\Http\Controllers;

use PDF;
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
        $term = Term::find($id);

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

        // AVAILABLE COLLECTORS (FOR EDITING TERM DETAILS FORM)
        $collectors = DB::table('profiles as T1')
                    -> join('users as T2', 'T2.user_id', '=', 'T1.profile_user_id')
                    -> whereNotIn('user_id', function($query) use($id, $term){
                        $query -> select('worker_user_id')
                               -> from('workers')
                               -> join('terms', 'term_id', '=', 'worker_term_id')
                               -> where([
                                    ['term_id', '!=', $id],
                                    ['term_status' , '=', 1],
                                    ['worker_type' , '=', 0],
                                  ])
                               -> where(function($q) use($term){
                                    $q->where('terms.finish_date', '=', null)
                                        ->orWhere([
                                            ['terms.finish_date', '>', $term[0] -> start_date]
                                        ]);
                                });
                        })
                    -> select('user_id', 'fname', 'mname', 'lname')
                    -> where([
                            ['user_type' , '=', 2],
                            ['user_status' , '=', 1]
                        ])
                    -> get();
       
        //AVAILABLE PEDDLERS (FOR ADDING PEDDLERS FORM)
        $a_peddlers = DB::table('profiles as T1')
                    -> join('users as T2', 'T2.user_id', '=', 'T1.profile_user_id')
                    -> whereNotIn('user_id', function($query) use($term){
                        $query -> select('worker_user_id')
                               -> from('workers')
                               -> join('terms', 'term_id', '=', 'worker_term_id')
                               -> where([
                                    ['term_status' , '=', 1]
                                ])
                               // -> where(function($q) use ($term) {
                               //     $q->where([
                               //          ['end_date', '>=', $term[0]->start_date]
                               //        ])
                                     ->Where([
                                         ['terms.end_date', '=', null]
                                     ]);
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
                -> orderBy('workers.updated_at', 'desc')
                -> paginate(5);
    
        //TERM EXPENSES
        $expenses = Term::join('expenses', 'terms.term_id', '=', 'expense_term_id')
                    -> select('terms.term_id', 'terms.term_status', 'expenses.*')
                    -> where([
                        ['terms.term_status', '=', '1'],
                        ['terms.term_id', '=', $id]
                    ])
                    -> orderBy('expenses.updated_at', 'desc')
                    -> paginate(5);

        $total_expense = DB::table('expenses')
                        -> where ('expenses.expense_term_id', '=', $id)
                        -> sum('expense_amt');

        //TERM ITEMS
        $term_items = Term::join('term_items', 'terms.term_id', '=', 'term_items.ti_term_id')
                    -> join('inventories', 'inventories.inventory_id', '=', 'term_items.ti_inventory_id')
                    -> join ('supplies', 'supplies_inventory_id', '=', 'inventory_id')
                    -> join('suppliers', 'suppliers.supplier_id', '=', 'supplies_supplier_id')
                    -> select ('terms.term_id', 'term_items.*', 'inventories.inventory_name', 'inventories.inventory_price', 'suppliers.supplier_name', 'suppliers.supplier_id')
                    -> where ([
                        ['terms.term_status', '=', '1'],
                        ['terms.term_id', '=', $id]
                    ])
                    -> orderBy('term_items.updated_at', 'desc')
                    -> paginate(10);

        //AVAILABLE ITEMS
        $a_items = Inventory::join ('supplies', 'supplies_inventory_id', '=', 'inventory_id')
                            -> join('suppliers', 'suppliers.supplier_id', '=', 'supplies_supplier_id')
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
                        -> sum('ti_udamaged');

        $total_damages += DB::table('term_items')
                        -> where ('term_items.ti_term_id', '=', $id)
                        -> sum('ti_rdamaged');

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
                    -> orderBy('sales.updated_at', 'desc')
                    -> paginate(5);
                    
        //TERM CUSTOMERS
        $unpaid_customers = Customer_Order::join('customers', 'customer_id', '=', 'co_customer_id')
                    -> join ('profiles', 'customer_profile_id', '=', 'profile_id')
                    -> join ('orders', 'order_co_id', '=', 'co_id')
                    -> join ('terms', 'term_id', '=', 'co_term_id')
                    -> join ('term_items', 'order_ti_id', '=', 'ti_id')
                    -> join ('inventories', 'ti_inventory_id', '=', 'inventory_id')
                    -> select ('co_id', 'customers.*', 'profiles.*', (DB::raw('SUM((ti_price) * orders.order_qty) as total_payable')))
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
                    -> join ('profiles', 'customer_profile_id', '=', 'profile_id')
                    -> join ('orders', 'order_co_id', '=', 'co_id')
                    -> join ('terms', 'term_id', '=', 'co_term_id')
                    -> join ('term_items', 'order_ti_id', '=', 'ti_id')
                    -> join ('inventories', 'ti_inventory_id', '=', 'inventory_id')
                    -> select ('co_id', 'customers.*', 'profiles.*', 'co_collect_date', (DB::raw('SUM((inventories.inventory_price + (inventories.inventory_price * 0.25)) * orders.order_qty) as total_payable')))
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




        return view('termsprofile', compact('curr_user', 'workers', 'term', 'a_peddlers', 'expenses', 'term_items', 'sales', 'total_expense', 'peddlers', 'total_items', 'total_damages', 'total_sales', 'total_returns', 'suppliers', 'a_items', 'unpaid_customers', 'paid_customers', 'total_collected', 'total_sale', 'collectors'));
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
        $now = Carbon::now() -> toDateString();

        $term = Term::find($id);
        $term_collector = Term::find($id)
                          -> join('workers', 'worker_term_id', '=', 'term_id')
                          -> select ('worker_user_id', 'worker_id')
                          -> where ([
                              ['term_id', '=', $id],
                              ['worker_term_id', '=', $id],
                              ['worker_type', '=', 0],
                            ])
                          -> get();

        if ($request -> et_finishdate != null && $request -> et_enddate != null){
          $validator = Validator::make($request->all(), [
              'et_collector' => 'required|string',
              'et_startdate' => 'required|date|unique:terms,start_date,' .$term -> term_id .',term_id,location,' .$request-> et_location .'|before:' .$request -> et_enddate .',' .$request-> et_finishdate,
              'et_location' => 'required|string|unique:terms,location,' .$term -> term_id .',term_id,start_date,' .$request-> et_startdate,
              'et_enddate' => 'nullable|date|before_or_equal:'.$now .'|before:' .$request->et_finishdate .'|after:'.$request -> et_startdate,
              'et_finishdate' =>'nullable|date|before_or_equal:'.$now .'|after:' .$request -> et_enddate .',' .$request-> et_startdate,
          ]);
        }
        elseif ($request -> et_enddate == null && $request -> et_finishdate == null){
          $validator = Validator::make($request->all(), [
              'et_collector' => 'required|string',
              'et_startdate' => 'required|date|unique:terms,start_date,' .$term -> term_id .',term_id,location,' .$request-> et_location .'|before_or_equal:' .$now,
              'et_location' => 'required|string|unique:terms,location,' .$term -> term_id .',term_id,start_date,' .$request-> et_startdate,
              'et_enddate' => 'nullable|date|before_or_equal:' .$now .'|after:' .$request-> et_startdate,
              'et_finishdate' =>'nullable|date|before_or_equal:' .$now .'|after:' .$request -> et_enddate .',' .$request-> et_startdate, 
          ]);
        }
        else{
          $validator = Validator::make($request->all(), [
              'et_collector' => 'required|string',
              'et_startdate' => 'required|date|unique:terms,start_date,' .$term -> term_id .',term_id,location,' .$request-> et_location .'|before_or_equal:' .$now .'|before:' .$request -> et_enddate,
              'et_location' => 'required|string|unique:terms,location,' .$term -> term_id .',term_id,start_date,' .$request-> et_startdate,
              'et_enddate' => 'nullable|date|before_or_equal:' .$now .'|after:' .$request-> et_startdate,
              'et_finishdate' =>'nullable|date|before_or_equal:' .$now .'|after:' .$request -> et_enddate .',' .$request-> et_startdate, 
          ]);
        }

        $attributeNames = array(
                   'et_collector' => 'collector',
                   'et_location' => 'location',
                   'et_startdate' => 'starting date',
                   'et_enddate' => 'peddling end',
                   'et_finishdate' => 'peddling end',
                );
            $validator->setAttributeNames($attributeNames);

        if ($validator->fails()){
          return redirect('/termsprofile/'.$id)
                ->withErrors($validator, 'editTerm')
                ->with('error_id', $id)
                ->withInput($request->all());
        }
        else{  
          $term -> location = $request -> et_location;
          $term -> start_date = $request -> et_startdate;
          $term -> end_date = $request -> et_enddate;
          $term -> finish_date = $request -> et_finishdate;
          $term -> save();

          if ($term_collector[0] -> worker_user_id != $request -> et_collector){
            $new_collector = new Worker;
            $new_collector -> worker_term_id = $id;
            $new_collector -> worker_user_id = $request -> et_collector;
            $new_collector -> worker_type = 0; //collector
            $new_collector -> save();

            $old_collector = Worker::destroy($term_collector[0] -> worker_id);
          }
          return redirect('termsprofile/' .$id) -> with('update-term-success','Term was successfully edited!');
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
        
    }

    public function printSales($id){
      $term_items = Term::join('term_items', 'terms.term_id', '=', 'term_items.ti_term_id')
                    -> join ('workers', 'worker_term_id', '=', 'term_id')
                    -> join ('profiles as handler', 'handler.profile_user_id', '=', 'ti_user_id')
                    -> join('profiles as worker', 'worker.profile_user_id', '=', 'worker_user_id')
                    -> join('inventories', 'inventories.inventory_id', '=', 'term_items.ti_inventory_id')
                    -> join ('supplies', 'supplies_inventory_id', '=', 'inventory_id')
                    -> join ('suppliers', 'suppliers.supplier_id', '=', 'supplies_supplier_id')
                    -> select ('terms.*', 'term_items.*', 'inventories.inventory_name', 'inventories.inventory_price', 'suppliers.supplier_name', 'suppliers.supplier_id', 'worker.fname as cfname', 'worker.mname as cmname', 'worker.lname as clname', 'handler.fname as hfname', 'handler.mname as hmname', 'handler.lname as hlname')
                    -> where ([
                        ['terms.term_id', '=', $id],
                        ['worker_term_id', '=', $id]
                    ])
                    -> groupBy('ti_id')
                    -> get();
                    
      $workers = Term::join('workers', 'terms.term_id', '=', 'worker_term_id')
            -> join('users', 'workers.worker_user_id', '=', 'users.user_id')
            -> join('profiles', 'users.user_id', '=', 'profiles.profile_user_id')
            -> select('terms.*', 'workers.*', 'profiles.*')
            -> where([
                    ['terms.term_id', '=', $id],
                    ['workers.worker_term_id', '=', $id],
                    ['terms.term_status', '=', 1],
                    ['workers.worker_type', '!=', 0]
                ])
            -> get();

      //TERM EXPENSES
      $expenses = Term::join('expenses', 'terms.term_id', '=', 'expense_term_id')
                -> select('terms.term_id', 'terms.term_status', 'expenses.*')
                -> where([
                    ['terms.term_status', '=', '1'],
                    ['terms.term_id', '=', $id]
                ])
                -> get();

      $total_expense = DB::table('expenses')
                    -> where ('expenses.expense_term_id', '=', $id)
                    -> sum('expense_amt');

      $total_items = DB::table('term_items')
                    -> where ('term_items.ti_term_id', '=', $id)
                    -> count('ti_id');

      $total_quantity = DB::table('term_items')
                    -> where ('term_items.ti_term_id', '=', $id)
                    -> sum('ti_original');

      $total_damages = DB::table('term_items')
                        -> where ('term_items.ti_term_id', '=', $id)
                        -> sum('ti_udamaged');

      $total_damages += DB::table('term_items')
                        -> where ('term_items.ti_term_id', '=', $id)
                        -> sum('ti_rdamaged');

      $total_returns = DB::table('term_items')
                    -> where ('term_items.ti_term_id', '=', $id)
                    -> sum('ti_returned');

      $total_sales = ($total_quantity - ($total_damages + $total_returns));

      $pdf = PDF::loadView('termsales', compact('term_items', 'expenses', 'total_expense', 'total_sales', 'total_items', 'total_quantity', 'total_damages', 'total_returns', 'workers'));

      return $pdf->stream();
    }

    public function getTermDetails($id){
      $termdata = Term::find($id)
                  -> join('workers', 'worker_term_id', '=', 'term_id')
                  -> join('profiles', 'profile_user_id', '=', 'worker_user_id')
                  -> select ('terms.*', 'profiles.fname', 'profiles.mname', 'profiles.lname', 'workers.worker_user_id')
                  -> where ([
                      ['term_id', '=', $id],
                      ['worker_term_id', '=', $id],
                      ['worker_type', '=', 0], //collector
                    ])
                  -> get();
      return $termdata;
    }

}
