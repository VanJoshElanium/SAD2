<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $primaryKey = 'expense_id';

    /* The attributes that are mass assignable. */
    protected $fillable = [
         'expense_name', 'expense_desc', 'expense_amt', 'expense_date', 'expense_term_id'
    ];

    public function term()
    {
        return $this->belongsTo('App\Term', 'expense_term_id', 'expense_id');
    }
}
