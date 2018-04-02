<?php

namespace App;

use Carbon\Carbon;
use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Inventory extends Model
{

    use LogsActivity;

    protected $primaryKey = 'inventory_id';

    protected $fillable = [
        'inventory_qty', 'inventory_price', 'inventory_status', 'inventory_name', 'inventory_desc',
    ];

    protected static $logAttributes = [
        'inventory_qty', 'inventory_price', 'inventory_status', 'inventory_name', 'inventory_desc',
    ];

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return ucfirst($eventName) . " undamaged inventory item";
    }

    public $sortable = ['inventory_quantity', 'inventory_id', 'inventory_price', 'received_at'];

    protected $hidden = [
        'remember_token',
    ];

    /* MUTATORS */

    /* ACCESSORS */
    public static function currdate()
    {
        $now = Carbon::now() -> toDateTimeString();
        $erase = substr($now, -3);
        $now = str_replace($erase, '', $now);
        $now = str_replace(' ', 'T', $now);
        return $now;
    }


    /* OTHERS */
    public function searchableAs()
    {
        return 'inventory_index';
    }

    public function supplier()
    {
        return $this->belongsTo('App\Supplier', 'inventory_supplier_id', 'supplier_id');
    }

    public function terms()
    {
        return $this->belongsToMany('App/Terms', 'term_items', 'inventory_id', 'term_id');
    }

    public function repair()
    {
        return $this->hasOne('App\Repair', 'repair_inventory_id');
    }

    public function stockin_items(){
        return $this->belongsToMany('App\Stockin_Item', 'stockins', 'inventory_id', 'si_item_id');
    }
}
