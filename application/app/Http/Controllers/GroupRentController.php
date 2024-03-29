<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\GroupReceipt;
use App\GroupRent;
use App\Report;
use App\Student;
use App\Fine;
use Validator;
use Auth;


class GroupRentController extends GroupReceiptController
{
    private $rules = [
        "group_name" => "required",
        "student_id" => "required",
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
        if (student::where('id',$data->only('student_id')['student_id'])->exists()){
                    student::where('id',$data->only('student_id')['student_id'])
                   ->update(['phone_no' => $data->only('phone_no')['phone_no']]);
        }
        $data->request->remove('phone_no');
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
    
    public function get_sorted()
    {
        $grouprent = grouprent::with('item','student')->get()->sortByDesc('status');
        return response($grouprent->toJson(),200);
    }

    public function update_return(Request $data,$id)
    {
        $status   = grouprent::where('id',$id)->pluck('status')->first();
        $lost     = $data->lost;
        $amount   = grouprent::where('id',$id)->pluck('amount')->first();
        $returned = $amount - $lost;
        if($lost>0){
            if ($status == 2){
                grouprent::where('id', $id)
                ->update(["status"   => "8",
                          "item_in"  => date('Y-m-d H:i:s'),
                          "lost"     => $lost,
                          "returned" => $returned]);
            } else {
                grouprent::where('id', $id)
                ->update(["status"   => "7",
                          "item_in"  => date('Y-m-d H:i:s'),
                          "lost"     => $lost,
                          "returned" => $returned]);
            }
            $this->create_receipt($id);
        }
        elseif($lost==0){
            if($status!=2){
                grouprent::where('id', $id)
                ->update(["status"   => "0",
                          "item_in"  => date('Y-m-d H:i:s'),
                          "lost"     => $lost,
                          "returned" => $returned]);
            } else {
                grouprent::where('id', $id)
                ->update(["status"   => "6",
                          "item_in"  => date('Y-m-d H:i:s'),
                          "lost"     => $lost,
                          "returned" => $returned]);
                $this->create_receipt($id);
            }          
        }
        return $this->ok();
    }

    public function pay($id)
    {
        $status = grouprent::where('id', $id)->get()->first()->status;
        if ($status == 6){
            grouprent::where('id', $id)
                        ->update(["status"   => "3"]);
        }
        else if ($status == 7){
            grouprent::where('id', $id)
                        ->update(["status"   => "4"]);
        }
        else if ($status == 8){
            grouprent::where('id', $id)
                        ->update(["status"   => "5"]);
        }
        return $this->ok();
    }

    public function revert($id)
    {
        $status = grouprent::where('id', $id)->get()->first()->status;
        if ($status == 6){
            grouprent::where('id', $id)
                        ->update(["status"   => "2",
                                  "item_in"  => NULL]);
        }
        else if ($status == 7){
            grouprent::where('id', $id)
                        ->update(["status"   => "1",
                                  "item_in"  => NULL]);
        }
        else if ($status == 8){
            grouprent::where('id', $id)
                        ->update(["status"   => "2",
                                  "item_in"  => NULL]);
        }
        if ($status >= 6 && $status <= 8) groupreceipt::where('id',$id)->delete();
        return $this->ok();
    }

    public function delete($id)
    {
        if (!(grouprent::where('id', $id)->get()->first()->teacher != Auth::user()->id 
            || Auth::user()->type != 0)) return $this->fail();
        grouprent::where('id', $id)->delete();
        return $this->ok();
    }

    public function update_expired()
    {   
        grouprent::where('status','=','1')
                 ->whereDate('due_date','<=', date('Y-m-d H:i:s'))
                 ->update(["status" => "2"]);
        return $this->ok();
    }
}
