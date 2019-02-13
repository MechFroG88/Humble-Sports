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
    protected $visible = ['single_fine','single_price','fine','user','grouprent','type'];

    public function item(){
        return $this->belongsTo('App\Item');
    }
    public function user(){
        return $this->belongsTo('App\User')->select(array('id','cn_name'));
    }
    public function grouprent(){
        return $this->belongsTo('App\GroupRent');
    }
    public function fine(){
        return $this->belongsTo('App\Fine');
    }

}
