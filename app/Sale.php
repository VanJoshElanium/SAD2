<?php

namespace App;

use App\Term;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $primaryKey = 'sale_id';

    /* The attributes that are mass assignable. */
    protected $fillable = [
         'sale_amt', 'sale_date', 'sale_remarks', 'sale_term_id',
    ];

    public function term()
    {
        return $this->belongsTo('App\Term', 'sale_term_id', 'term_id');
    }
}
