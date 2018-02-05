<?php

namespace App;

use Carbon\Carbon;
use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;

class Customer_Order extends Model
{
    protected $primaryKey = 'co_id';
     protected $table = 'customer_orders';

    protected $fillable = [
        'co_term_id', 'co_customer_id', 'co_collect_date', 'co_status', 
    ];

    //RELATIONSHIPS
    public function orders()
    {
        return $this->hasMany('App\Order', 'order_co_id');
    } 

    public function term()
    {
        return $this->belongsTo('App\Term', 'co_term_id', 'term_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'co_customer_id', 'customer_id');
    }
}
