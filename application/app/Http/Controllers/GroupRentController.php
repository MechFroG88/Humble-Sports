<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\GroupRent;
use App\Report;
use Validator;
use Auth;


class GroupRentController extends Controller
{
    private $rules = [
        "group_name" => "required",
        "student_id" => "required",
        "class"      => "required",
        "phone_no"   => "required",
        "item_id"    => "required",
        "item_tag"   => "required",
        "amount"     => "required",
        "due_date"   => "required|date",
    ];

    public function create(Request $data)
    {
        $validator = Validator::make($data->all(),$this->rules);
        if ($validator->fails()) return $this->fail();
        $data->request->add(['item_out' => date('Y-m-d H:i:s')]); 
        $data->request->add(['teacher'  => Auth::user()->cn_name]);
        grouprent::create($data->all());
        $date     = date('Y-m-d H:i:s');
        $year     = Carbon::createFromFormat('Y-m-d H:i:s', $date)->year;
        $month    = Carbon::createFromFormat('Y-m-d H:i:s', $date)->month;
        $total    = report::where('year',$year)
                          ->where('month',$month)              
                          ->select('total')
                          ->first();
        if (report::where('month', '=',$month) -> where('year','=',$year) -> count() > 0){             
        report::where('month','=',$month)
              ->where('year' ,'=',$year)
              ->update(['total'=> $total->total + 1]);
        return $this->ok();
        }
        else{
        $report        = new report;
        $report->year  = $year;
        $report->month = $month;
        $report->total = '1';
        $report->save();
        return $this->ok();            
        }
    }

    public function get()
    {
        $grouprent = grouprent::with('item','student')->get();
        return response($grouprent->toJson(),200);
    }

    public function update_returned($id)
    {
        $amount = grouprent::where('id',$id)->pluck('amount')->first();
        grouprent::where('id', $id)
                 ->update(["status"   => "0",
                           "item_in"  => date('Y-m-d H:i:s'),
                           "returned" => $amount]);
        return $this->ok();
    }

    public function update_lost(Request $data,$id)
    {
        $lost     = $data->lost;
        $amount   = grouprent::where('id',$id)->pluck('amount')->first();
        $returned = $amount - $lost;
        grouprent::where('id', $id)
                 ->update(["status"   => "3",
                           "item_in"  => date('Y-m-d H:i:s'),
                           "lost"     => $lost,
                           "returned" => $returned]);
        return $this->ok();
    }

    public function update_expired()
    {   
        grouprent::update(["status" => "2"])
                 ->where('due_date','<=', date('Y-m-d H:i:s'))
                 ->where('status','=','1');
        return $this->ok();
    }
}
