<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $primaryKey = 'log_id';

    protected $fillable = [
        'log_table', 'log_desc',  'log_time', 'log_user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'log_user_id', 'user_id');
    }
}
