<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PersonalRent;
use Carbon\Carbon;
use App\Report;
use Validator;
use App\Item;
use Auth;

class PersonalRentController extends Controller
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
        $personalrent = personalrent::with('student','item')->get()->makeHidden(['id']);
        return response($personalrent->toJson(),200); 
    }

    public function update_returned($id)
    {
        personalrent::where('id', $id)
                    ->update(["status"  => "0",
                              "item_in" => date('Y-m-d H:i:s')]);
        return $this->ok();
    }

    public function update_lost($id)
    {
        personalrent::where('id', $id)
                    ->update(["status"  => "3",
                              "item_in" => date('Y-m-d H:i:s')]);
        return $this->ok();
    }

    public function update_expired()
    {   
        personalrent::where('status'  ,'=','1')
                    ->where('due_date','<=',date('Y-m-d H:i:s'))
                    ->update(["status" => "2"]);
        return $this->ok();
    }
    
}

    