<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /* The attributes that are mass assignable. */
    protected $fillable = [
        'fname', 'mname', 'lname', 'username','password', 'gender', 'bday', 'cnum', 'user_type', 'user_status'
    ];

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

    public function setUserTypeAttribute($value){
        $this->attributes['user_type'] = 1;
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
            return "Collector";

        else if ($this->attributes['user_type']== 2) 
            return "Peddler";

        else if ($this->attributes['user_type'] == 3) 
            return "Staff";
            
        else return "Worker";
    }

}
