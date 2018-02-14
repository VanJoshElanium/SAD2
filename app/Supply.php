<?php

namespace App;

use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{

    protected $primaryKey = 'inventory_id';

    protected $fillable = ['inventory_supplier_id', 'inventory_name', 'inventory_price', 'inventory_qty'];

    public $sortable = [ 'inventory_id','inventory_name', 'inventory_price'];

    protected $hidden = [
       'remember_token',
    ];

	/* MUTATORS */
    public function setSupplyNameAttribute($value){
        $this->attributes['inventory_name'] = ucfirst($value);
    }

    public function searchableAs()
    {
        return 'supplies_index';
    }
}
