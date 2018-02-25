<?php

namespace App;

use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Supply extends Model
{

    use LogsActivity;

    protected $primaryKey = 'inventory_id';

    protected $fillable = ['inventory_supplier_id', 'inventory_name', 'inventory_price', 'inventory_qty'];

    public $sortable = [ 'inventory_id','inventory_name', 'inventory_price'];

    protected $hidden = [
       'remember_token',
    ];

    protected static $logAttributes = ['inventory_supplier_id', 'inventory_name', 'inventory_price', 'inventory_qty'];

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return ucfirst($eventName) . "supplier's item";
    }

	/* MUTATORS */
    public function setSupplyNameAttribute($value){
        $this->attributes['inventory_name'] = ucfirst($value);
    }

    public function searchableAs()
    {
        return 'supplies_index';
    }
}
