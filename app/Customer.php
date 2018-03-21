<?php

namespace App;

use Carbon\Carbon;
use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Customer extends Model
{
	use LogsActivity;
    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'customer_fname', 'customer_mname', 'customer_lname', 'customer_gender', 'customer_addr', 'customer_cnum', 'customer_status','order_collect_date', 'order_order_date'
    ];

    protected static $logAttributes = [
        'customer_fname', 'customer_mname', 'customer_lname', 'customer_gender', 'customer_addr', 'customer_cnum', 'customer_status','order_collect_date', 'order_order_date'
    ];

	protected static $logOnlyDirty = true;

	public function getDescriptionForEvent(string $eventName): string
	    {
	        return ucfirst($eventName) . " customer";
	    }
    
    //RELATIONSHIPS
    public function customer_orders()
    {
        return $this->hasMany('App\Customer_Order', 'co_customer_id');
    }
}
