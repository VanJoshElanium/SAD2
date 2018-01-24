<?php

namespace App;

use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $primaryKey = 'profile_id';

    use Searchable;
    use Sortable;
    /* The attributes that are mass assignable. */

    protected $fillable = [
        'fname', 'mname', 'lname', 'gender', 'bday', 'cnum',
    ];

    public $sortable = [
    	'fname', 'mname', 'lname'
    ];

    /* RELATIONSHIPS */
    public function user()
    {
        return $this->belongsTo('App\User', 'profile_user_id', 'user_id');
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
