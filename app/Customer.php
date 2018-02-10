<?php

namespace App;

use Carbon\Carbon;
use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'customer_fname', 'customer_mname', 'customer_lname', 'customer_gender', 'customer_addr', 'customer_cnum', 'customer_status',
    ];

    //RELATIONSHIPS
    public function customer_orders()
    {
        return $this->hasMany('App\Customer_Order', 'co_customer_id');
    }
}
