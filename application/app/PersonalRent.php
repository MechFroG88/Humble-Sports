<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\PersonalReceipt;
use App\Student;
use App\item;


class PersonalRent extends Model
{
    use SoftDeletes;
    public $timestamps  = false;
    protected $hidden   = ['deleted_at','due_date','item_id'];
    protected $fillable = ['teacher','student_id','item_out','due_date','item_id','item_tag'];
    protected $dates    = ['deleted_at','item_in','item_out','due_date'];

    public function student(){
        return $this->belongsTo('App\Student');
    }
    public function item(){
        return $this->belongsTo('App\Item')->select(array('id', 'type'));
    }
    public function personalreceipt(){
         return $this->hasOne('App\PersonalReceipt');
    }   
}
