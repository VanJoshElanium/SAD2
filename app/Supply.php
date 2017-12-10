<?php

namespace App;

use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    use Searchable;
    use Sortable;

    protected $primaryKey = 'supply_id';

    protected $fillable = ['supply_supplier_id', 'supply_name', 'supply_price', 'supply_status'];

    public $sortable = ['supply_name', 'supply_price'];

    protected $hidden = [
       'remember_token',
    ];

	/* MUTATORS */
    public function setSupplyNameAttribute($value){
        $this->attributes['supply_name'] = ucfirst($value);
    }

    public function searchableAs()
    {
        return 'supplies_index';
    }
}
