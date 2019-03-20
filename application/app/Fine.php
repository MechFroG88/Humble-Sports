<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PersonalReceipt;

class Fine extends Model
{
    protected $visible = ['fine'];

    public function receipt(){
        return $this->hasMany('App\PersonalReceipt');
    }
}
