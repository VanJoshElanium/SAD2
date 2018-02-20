<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Worker extends Model
{
    use LogsActivity;

    protected $primaryKey = 'worker_id';

    /* The attributes that are mass assignable. */
    protected $fillable = [
         'worker_type', 'worker_user_id', 'worker_term_id'
    ];

    protected static $logAttributes = [
         'worker_type', 'worker_user_id', 'worker_term_id'
    ];

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return ucfirst($eventName) . " term worker";
    }

    /* RELATIONSHIPS */
    public function user()
	{
	    return $this->belongsTo('App\User', 'worker_user_id', 'user_id');
	}

	public function term()
    {
        return $this->belongsTo('App\User', 'worker_term_id', 'term_id');
    }

    // public function term_items()
    // {
    //     return $this->hasMany('App\Term_items', 'ti_worker_id');
    // }
}
