<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\GroupRent;
use App\Student;
use App\Item;
use App\User;
use App\Fine;

class GroupReceipt extends Model
{
    protected $visible = ['id','fine','total_price','days','lost','total_fine','price','fine','user','grouprent'];

    public function item(){
        return $this->belongsTo('App\Item')->withTrashed();
    }
    public function user(){
        return $this->belongsTo('App\User')->withTrashed()->select(array('id','cn_name'));
    }
    public function grouprent(){
        return $this->belongsTo('App\GroupRent','id');
    }
    public function fine(){
        return $this->belongsTo('App\Fine');
    }

}
