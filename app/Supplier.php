<?php

namespace App;

use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Supplier extends Model
{
    use LogsActivity;

    protected $primaryKey = 'supplier_id';

    protected $fillable = [
        'supplier_name', 'supplier_addr', 'supplier_email', 'supplier_cnum', 'supplier_status', 
        'supplier_cp', 'supplier_owner'
    ];

    protected static $logAttributes = [
        'supplier_name', 'supplier_addr', 'supplier_email', 'supplier_cnum', 'supplier_status', 'supplier_cp', 'supplier_owner'
    ];

    protected static $logOnlyDirty = true;


    public function getDescriptionForEvent(string $eventName): string
    {
        return ucfirst($eventName) . " supplier";
    }

    /* MUTATORS */
    public function setSupplierNameAttribute($value){
        $this->attributes['supplier_name'] = ucfirst($value);
    }

    public function setSupplierAddrAttribute($value){
        $this->attributes['supplier_addr'] = ucfirst($value);
    }

    /* ACCESSORS */

    /* OTHERS */
    public function searchableAs()
    {
        return 'suppliers_index';
    }

    public function inventories()
    {
        return $this->hasMany('App\Inventory', 'inventory_supplier_id');
    }
}
