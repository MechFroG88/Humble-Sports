<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Item;

class Item extends Model
{
    protected $visible  = ['id','type','start_id','end_id','price'];
    protected $fillable = ['type','start_id','end_id','price'];

    public function personalrent(){
         return $this->hasMany('App\PersonalRent');
    }

    public function grouprent(){
        return $this->hasMany('App\GroupRent');
    }
}
