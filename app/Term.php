<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Term extends Model
{
    use LogsActivity;

    protected $primaryKey = 'term_id';

    /* The attributes that are mass assignable. */
    protected $fillable = [
         'start_date', 'end_date', 'finish_date', 'term_status', 'location'
    ];


    protected static $logAttributes = [
         'start_date', 'end_date', 'finish_date', 'term_status', 'location'
    ]; 

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return ucfirst($eventName) . " term details";
    }

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

    public function stockins()
    {
        return $this->hasMany('App\Stockin_Item', 'si_term_id');
    } 

    public function repairs()
    {
        return $this->hasMany('App\Repair', 'repair_term_id');
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

    public function term_items()
    {
        return $this->hasMany('App\Term_Item', 'ti_term_id');
    } 
}
