<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use SoftDeletes;
    protected $dates    = ['deleted_at'];
    protected $fillable = ['username','cn_name','password','type','deleted_at'];
    protected $visible  = ['id','cn_name', 'type','username'];

    public function receipt(){
        return $this->hasMany('App/Receipt');
    }

}
