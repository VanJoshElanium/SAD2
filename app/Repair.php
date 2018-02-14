<?php

namespace App;
use Carbon\Carbon;
use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{

    
    protected $primaryKey = 'repair_id';

    protected $fillable = [
        'repair_inventory_id', 'repair_status',  'repair_qty',
    ];

    public function inventory()
    {
        return $this->belongsTo('App\Inventory', 'repair_inventory_id', 'inventory_id');
    }

    // public function term()
    // {
    //     return $this->belongsTo('App\Term', 'repair_term_id', 'term_id');
    // }
    
}
