<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreSupplier;
use App\Http\Controllers\Controller;  
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $curr_usr = Auth::user();

        if($request->has('titlesearch')){
            $suppliers = Supplier::search($request->input('titlesearch')) 
                -> paginate(5);
        }else{
            $suppliers = Supplier::where('supplier_status' , '=', 1)
                -> sortable() 
                -> paginate(5);
        } 
        return view('suppliers', compact('suppliers', 'curr_usr'));
    }

    public function getSupplier($id)
    {
        $supplierdata = Supplier::find($id);
        //Session::flash('message', 'User has been successfully created!');
        return $supplierdata;
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
    public function store(StoreSupplier $request)
    {
        Supplier::create($request->all());
        //session()->flash('message', 'Successfully created a new supplier!');
        return redirect('/suppliers');
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
        $validator = Validator::make($request->all(), [
            'edit_supplier_name' => array(
                         'required',
                         'max:50',
                         'string'),
            'edit_supplier_addr' => array(
                         'required',
                         'max:100',
                         'string'),
            'edit_supplier_email' => 'required|email',
            'edit_supplier_cnum' => 'required|digits:11'
        ]);

        if ($validator->fails()) {
            return redirect('/suppliers')
                ->withErrors($validator, 'editSupplier')
                ->withInput($request->all())
                ->with('error_id', $id);
        }
        else{
            $supplier = Supplier::find($id);
            //dd($request-> all()); //for debugging purposes
            $supplier -> supplier_name = $request-> edit_supplier_name;
            $supplier -> supplier_addr = $request-> edit_supplier_addr;
            $supplier -> supplier_email = $request-> edit_supplier_email;
            $supplier -> supplier_cnum = $request-> edit_supplier_cnum;
            $supplier -> save();
            return redirect('/suppliers');
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
        $supplier = Supplier::find($id);
        $supplier -> supplier_status = 0;
        $supplier -> save();
        //dd($supplier); //for debugging purposes
        return redirect('/suppliers');
        //Session::flash('message', 'User has been successfully removed!');*/
    }
}
