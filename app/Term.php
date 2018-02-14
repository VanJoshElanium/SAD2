<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $primaryKey = 'term_id';

    /* The attributes that are mass assignable. */
    protected $fillable = [
         'start_date', 'end_date', 'finish_date', 'term_status', 'location'
    ];

    /* RELATIONSHIPS */
    public function workers(){
        return $this->hasMany('App\Worker', 'worker_term_id');
    }

    // public function repairs()
    // {
    //     return $this->hasMany('App\Repair', 'repair_term_id');
    // }  

    public function expenses()
    {
        return $this->hasMany('App\Expense', 'expense_term_id');
    } 

    public function sales()
    {
        return $this->hasMany('App\Sale', 'sale_term_id');
    } 

    public function customer_orders()
    {
        return $this->hasMany('App\Customer_Order', 'co_term_id');
    } 

    public function inventories()
    {
        return $this->belongsToMany('App\Inventories', 'term_items', 'term_id', 'inventory_id');
    } 
}
