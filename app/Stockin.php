<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Stockin extends Model
{
    use LogsActivity;

    protected $primaryKey = 'si_id';

    protected $fillable = [
        'si_date', 'si_inventory_id', 'si_user_id,', 'si_qty', 'si_term_id',
    ];

    protected static $logAttributes = [
        'si_date', 'si_inventory_id', 'si_user_id,', 'si_qty', 'si_term_id'
    ];

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
        {
            return ucfirst($eventName) . " stock-in";
        }

    public function inventory()
    {
        return $this->belongsTo('App\Inventory', 'si_inventory_id', 'inventory_id');
    }


    public function term()
    {
        return $this->belongsTo('App\Term', 'si_term_id', 'term_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'si_user_id', 'user_id');
    }
}
