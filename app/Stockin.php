<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stockin extends Model
{
    protected $primaryKey = 'si_id';

    protected $fillable = [
        'si_date', 'si_inventory_id', 'si_user_id'
    ];

    public function inventory()
    {
        return $this->belongsTo('App\Inventory', 'si_inventory_id', 'inventory_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'si_user_id', 'user_id');
    }
}
