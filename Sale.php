<?php

namespace App;

use App\Term;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Sale extends Model
{
	use LogsActivity;

    protected $primaryKey = 'sale_id';

    /* The attributes that are mass assignable. */
    protected $fillable = [
         'sale_amt', 'sale_date', 'sale_remarks', 'sale_term_id',
    ];

    protected static $logAttributes = [
         'sale_amt', 'sale_date', 'sale_remarks', 'sale_term_id',
    ];


	protected static $logOnlyDirty = true;

	public function getDescriptionForEvent(string $eventName): string
	    {
	        return ucfirst($eventName) . " term collection";
	    }

    public function term()
    {
        return $this->belongsTo('App\Term', 'sale_term_id', 'term_id');
    }
}
