<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['username','cn_name','password','type'];
    protected $visible = ['id','cn_name', 'type'];

    public function receipt(){
        return $this->hasMany('App/Receipt');
    }

}
