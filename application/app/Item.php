<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Item;

class Item extends Model
{
    use SoftDeletes;
    protected $visible  = ['id','type','start_id','end_id','price'];
    protected $fillable = ['type','start_id','end_id','price','status'];
    protected $dates    = ['deleted_at'];

    public function personalrent(){
         return $this->hasMany('App\PersonalRent');
    }

    public function grouprent(){
        return $this->hasMany('App\GroupRent');
    }
}
