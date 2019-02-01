<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $visible = ['id','cn_name', 'type'];
}
