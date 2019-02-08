<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $primaryKey = "id"; 
    public $incrementing = false;
    protected $visible = ['id','cn_name', 'type'];
}
