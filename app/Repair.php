<?php

namespace App;
use Carbon\Carbon;
use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Repair extends Model
{

    use LogsActivity;

    protected $primaryKey = 'repair_id';

    protected $fillable = [
        'repair_inventory_id', 'repair_status',  'repair_qty', 'repair_ddate', 'repair_fdate', 'repair_user_id'
    ];

    protected static $logAttributes = [
        'repair_inventory_id', 'repair_status',  'repair_qty', 'repair_ddate', 'repair_fdate', 'repair_user_id'
    ];

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
        {
            return ucfirst($eventName) . " damaged inventory item";
        }

    public function inventory()
    {
        return $this->belongsTo('App\Inventory', 'repair_inventory_id', 'inventory_id');
    }

    public function term()
    {
        return $this->belongsTo('App\Term', 'repair_term_id', 'term_id');
    }

    // public function term()
    // {
    //     return $this->belongsTo('App\Term', 'repair_term_id', 'term_id');
    // }
    
}
