<?php

namespace App;

use Carbon\Carbon;
use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use Searchable;
    use Sortable;

    protected $primaryKey = 'inventory_id';

    protected $fillable = [
        'inventory_quantity', 'inventory_price', 'inventory_status', 'inventory_damaged', 'received_at', 'inventory_user_id',
    ];

    public $sortable = ['inventory_quantity', 'inventory_id', 'inventory_price', 'received_at'];

    protected $hidden = [
        'remember_token',
    ];

    /* MUTATORS */

    /* ACCESSORS */
    public static function currdate()
    {
        $now = Carbon::now() -> toDateTimeString();
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

    public function stockin()
    {
        return $this->hasMany('App\Stockin', 'si_inventory_id');
    }

    
}
