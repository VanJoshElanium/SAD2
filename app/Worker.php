<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $primaryKey = 'worker_id';

    /* The attributes that are mass assignable. */
    protected $fillable = [
         'worker_type', 'worker_user_id', 'worker_term_id'
    ];

    /* RELATIONSHIPS */
    public function user()
	{
	    return $this->belongsTo('App\User', 'worker_user_id', 'user_id');
	}

	public function term()
    {
        return $this->belongsTo('App\User', 'worker_term_id', 'term_id');
    }

    public function term_items()
    {
        return $this->hasMany('App\Term_items', 'ti_worker_id');
    }
}
