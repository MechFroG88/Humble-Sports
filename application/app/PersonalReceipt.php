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
    protected $visible = ['single_fine','fine','user','personalrent','type'];

    public function item(){
        return $this->belongsTo('App\Item');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function personalrent(){
        return $this->belongsTo('App\PersonalRent');
    }
    public function fine(){
        return $this->belongsTo('App\Fine');
    }

}
