<?php

namespace App;

use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Supply extends Model
{

    protected $primaryKey = 'supply_id';
    protected $table = 'supplies';

    // use LogsActivity;

    protected $fillable = ['supplies_supplier_id', 'supplies_inventory_id'];


    // protected static $logAttributes = ['supplies_supplier_id', 'supplies_inventory_id'];

    // protected static $logOnlyDirty = true;

    // public function getDescriptionForEvent(string $eventName): string
    // {
    //     return ucfirst($eventName) . "supplier's item";
    // }

	// /* MUTATORS */
 //    public function setSupplyNameAttribute($value){
 //        $this->attributes['inventory_name'] = ucfirst($value);
 //    }

    // public function searchableAs()
    // {
    //     return 'supplies_index';
    // }
}
