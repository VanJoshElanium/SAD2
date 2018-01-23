<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $primaryKey = 'term_id';

    /* The attributes that are mass assignable. */
    protected $fillable = [
         'start_date', 'end_date', 'finish_date', 'term_status', 'location'
    ];

    /* RELATIONSHIPS */
    public function worker(){
        return $this->hasMany('App\Worker', 'worker_term_id');
    }
  
}
