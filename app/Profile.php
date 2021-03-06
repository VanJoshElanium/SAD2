<?php

namespace App;

use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Profile extends Model
{
    use LogsActivity; 
    
    protected $primaryKey = 'profile_id';
    protected static $recordEvents = ['updated'];

    /* The attributes that are mass assignable. */
    protected $fillable = [
        'fname', 'mname', 'lname', 'gender', 'bday', 'cnum',
    ];

    protected static $logAttributes = [
        'fname', 'mname', 'lname', 'gender', 'bday', 'cnum',
    ];
    
    protected static $logOnlyDirty = true;

    
    public $sortable = [
    	'fname', 'mname', 'lname'
    ];

    /* ACTIVITY LOGGING*/
    public function getDescriptionForEvent(string $eventName): string
    {
        return ucfirst($eventName) . " user";
    }

    /* RELATIONSHIPS */
    public function user()
    {
        return $this->belongsTo('App\User', 'profile_user_id', 'user_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_profile_id', 'customer_id');
    }

    /* MUTATORS */
    public function setFnameAttribute($value){
        $this->attributes['fname'] = ucfirst($value);
    }

    public function setMnameAttribute($value){
        $this->attributes['mname'] = ucfirst($value);
    }


    public function setLnameAttribute($value){
        $this->attributes['lname'] = ucfirst($value);
    }


    /* ACCESSORS */
    public function getGenderAttribute($value){
        if ($this->attributes['gender'] ==  0)
            return "Male";
        else  
            return "Female";
    }

    public function searchableAs()
    {
        return 'profiles_index';
    }
}
