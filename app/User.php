<?php

namespace App;

use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $primaryKey = 'user_id';

    use Searchable, Sortable;

    /* The attributes that are mass assignable. */
    protected $fillable = [
         'username','password', 'user_type', 'user_status'
    ];

    public $sortable = ['id', 'user_type'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /* RELATIONSHIPS */
    public function profile()
    {
        return $this->hasOne('App\Profile', 'profile_user_id');
    }

    public function worker()
    {
        return $this->hasOne('App\Worker', 'worker_user_id');
    }

    public function stockin()
    {
        return $this->hasMany('App\Stockin', 'si_user_id');
    }



    /* MUTATORS */
    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }


    /* ACCESSORS */
    public function getIdAttribute($value){
        return $this->attributes['user_id'];
    }


    public function getUserTypeAttribute($value){
        if ($this->attributes['user_type'] ==  0)
            return "Administrator";

        else if ($this->attributes['user_type'] == 1) 
            return "Owner";

        else if ($this->attributes['user_type']== 2) 
            return "Collector";

        else return "Worker";
    }

    public function searchableAs()
    {
        return 'users_index';
    }
}
