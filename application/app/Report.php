<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PersonalReceipt;
use App\GroupReceipt;
use App\PersonalRent;
use App\GroupRent;


class Report extends Model
{
    public $timestamps = false;
    public function grouprent(){
        return $this->hasMany('App\GroupRent');
    }

    public function personalrent(){
        return $this->hasMany('App\PersonalRent');
    }

    public function groupreceipt(){
        return $this->hasMany('App\GroupReceipt');
    }

    public function personalreceipt(){
        return $this->hasMany('App\PersonalReceipt');
    }
}
