<?php

namespace App;

use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use LogsActivity;
    
    // protected $logName = 'user';
    protected $primaryKey = 'user_id';

    /* The attributes that are mass assignable. */
    protected $fillable = [
         'user_id', 'username','password', 'user_type', 'user_status'
    ];

    protected static $logAttributes = [
         'user_id', 'username','password', 'user_type', 'user_status'
    ];

    protected static $logOnlyDirty = true;

    public $sortable = ['id', 'user_type'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /* ACTIVITY LOGGING*/
    public function getDescriptionForEvent(string $eventName): string
    {
        return ucfirst($eventName) . " user";
    }

    /* RELATIONSHIPS */
    public function profile()
    {
        return $this->hasOne('App\Profile', 'profile_user_id');
    }

    public function worker()
    {
        return $this->hasOne('App\Worker', 'worker_user_id');
    }

    public function stockins()
    {
        return $this->hasMany('App\Stockin', 'si_user_id');
    }

    public function logs()
    {
        return $this->hasMany('App\Log', 'log_user_id');
    }

    public function term_items()
    {
        return $this->hasMany('App\Term_items', 'ti_user_id');
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
