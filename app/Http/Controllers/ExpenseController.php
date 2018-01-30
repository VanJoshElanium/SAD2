<?php

namespace App\Http\Controllers;

use Validator;
use App\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
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
        $expenses = DB::Table('expenses')
                    -> select ('expenses.expense_name')
                    -> where ('expenses.expense_term_id', '=', $request -> term_id)
                    -> get();
        $length = count($expenses);

        $validator = Validator::make($request->all(), [
            'add_exp_name' => array(
                            'required',
                            'unique:expenses,expense_name,NULL,expense_id,expense_term_id,' .$request-> term_id
                        ),
        ]);

        if ($validator->fails()) {
            return redirect('/termsprofile/' .$request-> term_id)
                ->withErrors($validator, 'addExpense')
                ->withInput($request->all());
        }
        else{
            $expense = new Expense;
            $expense -> expense_name = $request -> add_exp_name;
            $expense -> expense_amt = $request-> add_exp_amt;
            $expense -> expense_term_id = $request-> term_id;
            $expense -> save();
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
        $expense = Expense::find($id);
        $expense -> expense_name = $request -> edit_exp_name;
        $expense -> expense_amt = $request-> edit_exp_amt;
        $expense -> save();

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
        $expense = Expense::find($id);
        $term = $expense -> expense_term_id;

        $expense = Expense::destroy($id);
        return redirect('/termsprofile/' .$term);
    }

    public function getExpense($id){
        $expensedata = Expense::find($id);
        return $expensedata;
    }
}
