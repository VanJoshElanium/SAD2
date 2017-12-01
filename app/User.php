<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'mname', 'lname', 'username','password', 'gender', 'bday', 'cnum', 'user_type', 'user_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

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

}
