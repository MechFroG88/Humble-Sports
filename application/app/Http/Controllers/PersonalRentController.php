<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PersonalReceipt;
use App\PersonalRent;
use Carbon\Carbon;
use App\Report;
use Validator;
use App\Item;
use App\Fine;
use Auth;

class PersonalRentController extends PersonalReceiptController
{
    private $rules = [
        "student_id" => "required",
        "item_id"    => "required",
        "item_tag"   => "required",
        "due_date"   => "required|date",
    ];

    public function create(Request $data)
    {
        $validator = Validator::make($data->all(),$this->rules);
        if ($validator->fails()) return $this->fail();
        $data->request->add(['item_out' => date('Y-m-d H:i:s')]); 
        $data->request->add(['teacher'  => Auth::user()->cn_name]);
        personalrent::create($data->all());
        $date  = date('Y-m-d H:i:s');
        $year  = Carbon::createFromFormat('Y-m-d H:i:s', $date)->year;
        $month = Carbon::createFromFormat('Y-m-d H:i:s', $date)->month;
        $total = report::where('year',$year)
                       ->where('month',$month)
                       ->select('total')
                       ->first();
        if (report::where('month', '=',$month)->where('year','=',$year)->count() > 0){                
        report::where('month','=',$month)
              ->where('year' ,'=',$year)
              ->update(['total'=> $total->total + 1]);
        return $this->ok();
        }
        else{
        $report        = new report;
        $report->month = $month;
        $report->year  = $year;
        $report->total = '1';           
        $report->save();
        return $this->ok();            
        }
    }

    public function get()
    {       
        $personalrent = personalrent::with('student','item')->get();
        return response($personalrent->toJson(),200); 
    }

    public function get_sorted()
    {       
        $personalrent = personalrent::with('student','item')->get()->sortByDesc('status');
        return response($personalrent->toJson(),200); 
    }

    public function update_return(Request $data,$id)
    {
        $lost     = $data->lost;
        $status   = personalrent::where('id',$id)->pluck('status')->first();
        if($lost>0){
            personalrent::where('id', $id)
                        ->update(["status"   => "7",
                                  "item_in"  => date('Y-m-d H:i:s'),
                                  "lost"     => $lost]);
            $this->create_receipt($id);   
        }elseif($lost==0){
            if($status!=2){
                personalrent::where('id', $id)
                            ->update(["status"   => "0",
                                      "item_in"  => date('Y-m-d H:i:s'),
                                      "lost"     => $lost]);
            }elseif($status==2){ 
                personalrent::where('id', $id)
                            ->update(["status"   => "6",
                                      "item_in"  => date('Y-m-d H:i:s'),
                                      "lost"     => $lost]);
                $this->create_receipt($id);
            }
        }
        return $this->ok();
    }

    public function pay($id)
    {
        $status = personalrent::where('id', $id)->get()->first()->status;
        if ($status == 6){
            personalrent::where('id', $id)
                        ->update(["status"   => "3"]);
        }
        else if ($status == 7){
            personalrent::where('id', $id)
                        ->update(["status"   => "4"]);
        }
        else if ($status == 8){
            personalrent::where('id', $id)
                        ->update(["status"   => "5"]);
        }
        return $this->ok();
    }

    public function delete($id)
    {
        if (!(personalrent::where('id', $id)->get()->first()->teacher != Auth::user()->id 
            || Auth::user()->type != 0)) return $this->fail();
        personalrent::where('id', $id)->delete();
        return $this->ok();
    }

    public function revert($id)
    {
        $status = personalrent::where('id', $id)->get()->first()->status;
        if ($status == 6){
            personalrent::where('id', $id)
                        ->update(["status"   => "2",
                                  "item_in"  => NULL]);
        }
        else if ($status == 7){
            personalrent::where('id', $id)
                        ->update(["status"   => "1",
                                  "item_in"  => NULL]);
        }
        else if ($status == 8){
            personalrent::where('id', $id)
                        ->update(["status"   => "2",
                                  "item_in"  => NULL]);
        }
        if ($status >= 6 && $status <= 8) personalreceipt::where('id',$id)->delete();
        return $this->ok();
    }

    public function update_expired()
    {   
        personalrent::where('status'  ,'=','1')
                    ->whereDate('due_date','<=',date('Y-m-d H:i:s'))
                    ->update(["status" => "2"]);
        return $this->ok();
    }
    
}

    