<?php

namespace App;

use Carbon\Carbon;
use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'order_ti_id', 'order_co_id', 'order_qty',
    ];

    //RELATIONSHIPS
    public function customer_order()
    {
        return $this->belongsTo('App\Customer_Order', 'order_co_id', 'co_id');
    }
}
