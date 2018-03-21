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

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $curr_usr = Auth::user();

        //WORKER
        $pts = DB::table('terms')
                            -> join ('workers', 'term_id', '=', 'worker_term_id')
                            -> where ('worker_user_id', '=', $curr_usr -> user_id)
                            -> select ('terms.*')
                            -> paginate (10);              
        return view('dashboard', compact('curr_usr', 'pts', 'c_pts'));
    }

}
