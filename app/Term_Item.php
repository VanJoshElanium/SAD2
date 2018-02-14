<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term_Item extends Model
{
    protected $primaryKey = 'ti_id';
    protected $table = 'term_items';

    /* The attributes that are mass assignable. */
    protected $fillable = [
         'ti_qty', 'ti_term_id', 'ti_inventory_id', 'ti_date', 'ti_worker_id'
    ];

    public function worker()
    {
        return $this->belongsTo('App\Worker', 'ti_worker_id', 'worker_id');
    }
}
