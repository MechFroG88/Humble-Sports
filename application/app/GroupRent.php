<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\GroupReceipt;
use App\Student;
use App\Item;

class GroupRent extends Model
{
    use SoftDeletes;
    public $timestamps  = false;
    protected $hidden   = ['deleted_at'];
    protected $fillable = ['amount','teacher','student_id','group_name','due_date','item_id','item_tag','item_out','status'];
    protected $dates    = ["rent_in","rent_out","due_date"];

    public function student(){
        return $this->belongsTo('App\Student');
    }
    public function item(){
        return $this->belongsTo('App\Item')->select(array('id', 'type'));;
    }
    public function report(){
        return $this->belongsTo('App\Report');
    }
}
