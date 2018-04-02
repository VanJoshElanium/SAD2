<?php

namespace App;

use Carbon\Carbon;
use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Order extends Model
{
	use LogsActivity;

    protected $primaryKey = 'order_id';

    protected $fillable = [
        'order_ti_id', 'order_co_id', 'order_qty',
    ];

    protected static $logAttributes = [
        'order_ti_id', 'order_co_id', 'order_qty',
    ];

	protected static $logOnlyDirty = true;

	public function getDescriptionForEvent(string $eventName): string
	    {
	        return ucfirst($eventName) . " customer's order";
	    }

    //RELATIONSHIPS
    public function customer_order()
    {
        return $this->belongsTo('App\Customer_Order', 'order_co_id', 'co_id');
    }
}
