<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $primaryKey = "id"; 
    public $incrementing  = false;
    protected $hidden     = ['created_at','updated_at'];

    public function personalrent(){
        return $this->hasMany('App\PersonalRent');
    }
    public function grouprent(){
        return $this->hasMany('App\GroupRent');
    }
}
