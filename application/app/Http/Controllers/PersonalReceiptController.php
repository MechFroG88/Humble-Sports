<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PersonalReceipt;
use App\PersonalRent;
use App\GroupRent;
use Carbon\Carbon;
use App\Student;
use App\User;       
use App\Fine;
use App\Item;
use Auth;

class PersonalReceiptController extends Controller
{
    public function create_fine($id)
    {
        $receipt                  = new personalreceipt;
        $receipt->personalrent_id = $id;
        $fine_id                  = fine::max('id');
        $fine                     = fine::where('id',$fine_id)->select('fine')->first();
        $receipt->fine            = $fine->fine;
        $date                     = Carbon::parse(grouprent::where('id',$id)->pluck('due_date')->first());
        $now                      = Carbon::now();
        $receipt->days            = $date->diffInDays($now);
        $receipt->total           = $fine->fine*$receipt->days;
        $receipt->user_id         = Auth::user()->id;
        $receipt->type            = 2;
        $receipt->save();
        return $this->ok();
    }

    public function create_lost($id)
    {
        $receipt                  = new personalreceipt;
        $receipt->personalrent_id = $id;
        $item_id                  = personalrent::where('id',$id)->pluck('item_id')->first();
        $fine                     = item::where('id',$item_id)->select('price')->first();
        $receipt->fine            = $fine->price;
        $date                     = Carbon::parse(grouprent::where('id',$id)->pluck('due_date')->first());
        $now                      = Carbon::now();
        $receipt->days            = $date->diffInDays($now);
        $receipt->total           = $fine->price*$receipt->days;
        $receipt->user_id         = Auth::user()->id;
        $receipt->type            = 3;
        $receipt->save();
        return $this->ok();
    }
    
    public function get_receipt($id)
    {
        $receipt = personalreceipt::with('user','personalrent','personalrent.student','personalrent.item')->find($id);
        if (!isset($receipt)){
            $receipt = collect();
        }
        return response($receipt->toJson(),200);
    }
}
