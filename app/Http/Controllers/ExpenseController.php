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
        $validator = Validator::make($request->all(), [
            'add_exp_name' => array(
                            'required',
                            'unique:expenses,expense_name,null,null,expense_term_id,' .$request-> term_id
                        ),
            'add_exp_amt' => 'required|numeric|min:1'
        ]);

        $attributeNames = array(
                   'add_exp_name' => "expense name",
                   'add_exp_amt' => 'amount',
                );
        $validator->setAttributeNames($attributeNames);

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
        return redirect('/termsprofile/' .$request-> term_id) -> with('store-expense-success','Expense was successfully added to term!');
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
        $validator = Validator::make($request->all(), [
            'edit_exp_name' => array(
                            'required',
                            'unique:expenses,expense_name,' .$id .',expense_id,expense_term_id,' .$request-> term_id
                        ),
            'edit_exp_amt' => 'required|numeric|min:1'
        ]);

        $attributeNames = array(
                   'edit_exp_name' => "expense name",
                   'edit_exp_amt' => 'amount',
                );
        $validator->setAttributeNames($attributeNames);

        if ($validator->fails()) {
            return redirect('/termsprofile/' .$request-> term_id)
                ->withErrors($validator, 'editExpense')
                ->withInput($request->all())
                ->with('error_id', $id);
        }
        else{
            $expense = Expense::find($id);
            $expense -> expense_name = $request -> edit_exp_name;
            $expense -> expense_amt = $request-> edit_exp_amt;
            $expense -> save();

            return redirect('/termsprofile/' .$request-> term_id) -> with('update-expense-success','Expense was successfully edited!');
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
        $expense = Expense::find($id);
        $term = $expense -> expense_term_id;

        $expense = Expense::destroy($id);
        return redirect('/termsprofile/' .$term) -> with('destroy-expense-success','Expense was successfully removed from term!');
    }

    public function getExpense($id){
        $expensedata = Expense::find($id);
        return $expensedata;
    }
}
