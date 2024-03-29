<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PersonalRent;
use App\Student;
use App\Item;
use App\User;
use App\Fine;

class PersonalReceipt extends Model
{
    protected $visible = ['id','total_fine','fine','price','days','user','personalrent','lost','total_price'];

    public function item(){
        return $this->belongsTo('App\Item','price')->withTrashed();;
    }
    public function user(){
        return $this->belongsTo('App\User')->withTrashed()->select(array('id','cn_name'));
    }
    public function personalrent(){
        return $this->belongsTo('App\PersonalRent','id')->select(array('id','student_id','item_id','item_out','item_in','due_date'));
    }
    public function fine(){
        return $this->belongsTo('App\Fine');
    }

}
