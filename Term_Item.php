<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Term_Item extends Model
{
    use LogsActivity;

    protected $primaryKey = 'ti_id';
    protected $table = 'term_items';


    /* The attributes that are mass assignable. */
    protected $fillable = [
         'ti_term_id', 'ti_inventory_id', 'ti_date', 'ti_user_id', 'ti_udamaged', 'ti_rdamaged', 'ti_returned', 'ti_original','ti_price'
    ];

    protected static $logAttributes = [
         'ti_term_id', 'ti_inventory_id', 'ti_date', 'ti_user_id', 'ti_udamaged', 'ti_rdamaged', 'ti_returned', 'ti_original', 'ti_price'
    ];

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return ucfirst($eventName) . " term item";
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'ti_user_id', 'user_id');
    }
}
