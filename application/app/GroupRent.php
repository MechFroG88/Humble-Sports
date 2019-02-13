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
    protected $hidden   = ["id","item_id","deleted_at"];
    protected $fillable = ['amount','teacher','cn_name','group_name','due_date','class','phone_no','item_id','item_tag','item_out'];
    protected $dates    = ["rent_in","rent_out","due_date"];

    public function student(){
        return $this->belongsTo('App\Student');
    }
    public function item(){
        return $this->belongsTo('App\Item');
    }
    public function groupreceipt(){
        return $this->hasOne('App\GroupReceipt');
    }
    public function report(){
        return $this->belongsTo('App\Report');
    }
}