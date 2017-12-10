<?php

namespace App;

use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Searchable;
    use Sortable;
    /* The attributes that are mass assignable. */
    protected $fillable = [
        'fname', 'mname', 'lname', 'username','password', 'gender', 'bday', 'cnum', 'user_type', 'user_status'
    ];

    public $sortable = ['id', 'fname', 'mname', 'lname', 'cnum', 'user_type'];

    protected $hidden = [
        'password', 'remember_token',
    ];


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

    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }


    /* ACCESSORS */
    public function getIdAttribute($value){
        return $this->attributes['id'];
    }


    public function getGenderAttribute($value){
        if ($this->attributes['gender'] ==  0)
            return "Male";
        else  
            return "Female";
    }

    public function getUserTypeAttribute($value){
        if ($this->attributes['user_type'] ==  0)
            return "Administrator";

        else if ($this->attributes['user_type'] == 1) 
            return "Owner";

        else if ($this->attributes['user_type']== 2) 
            return "Collector";

        else if ($this->attributes['user_type'] == 3) 
            return "Peddler";
            
        else return "Staff";
    }

    public function searchableAs()
    {
        return 'users_index';
    }
}
