<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Stockin_Item extends Model
{
    use LogsActivity;

    protected $primaryKey = 'si_item_id';
    protected $table = 'stockin_items';

    protected $fillable = [
         'si_user_id,', 'si_date',  
    ];

    protected static $logAttributes = [
         'si_user_id,', 'si_date', 
    ];

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
        {
            return ucfirst($eventName) . " stock-in";
        }

    // public function term()
    // {
    //     return $this->belongsTo('App\Term', 'si_term_id', 'term_id');
    // }


    public function user()
    {
        return $this->belongsTo('App\User', 'si_user_id', 'user_id');
    }

    public function inventories(){
    	return $this->belongsToMany('App\Inventory', 'stockins', 'si_item_id', 'inventory_id');
    }

}
