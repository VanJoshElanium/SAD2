<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Expense extends Model
{
	use LogsActivity;

    protected $primaryKey = 'expense_id';

    /* The attributes that are mass assignable. */
    protected $fillable = [
         'expense_name', 'expense_desc', 'expense_amt', 'expense_date', 'expense_term_id'
    ];

    protected static $logAttributes = [
         'expense_name', 'expense_desc', 'expense_amt', 'expense_date', 'expense_term_id'
    ];

	protected static $logOnlyDirty = true;

	public function getDescriptionForEvent(string $eventName): string
	    {
	        return ucfirst($eventName) . " term expense";
	    }

    public function term()
    {
        return $this->belongsTo('App\Term', 'expense_term_id', 'expense_id');
    }
}
