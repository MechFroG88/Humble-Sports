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
    public function create_receipt($id)
    {
        $date                     = Carbon::parse(personalrent::where('id',$id)->pluck('due_date')->first());
        $item_in                  = Carbon::parse(personalrent::where('id',$id)->pluck('item_in')->first());
        $days                     = ($date >= $item_in) ? 0 : $date->diffInDays($item_in);
        $fine_id                  = fine::max('id');
        $fine                     = fine::where('id',$fine_id)->pluck('fine')->first();  
        $item_id                  = personalrent::where('id',$id)->pluck('item_id')->first();
        $price                    = item::where('id',$item_id)->pluck('price')->first();
        $lost                     = personalrent::where('id',$id)->pluck('lost')->first();
        $receipt                  = new personalreceipt;
        $receipt->id              = $id;
        $receipt->fine            = $fine;
        $receipt->days            = $days;
        $receipt->total_fine      = $fine*$days;
        $receipt->price           = $price;
        $receipt->lost            = $lost;
        $receipt->total_price     = $price*$lost; 
        $receipt->user_id         = Auth::user()->id;
        $receipt->save();
        return $this->ok();
    }
    
    public function get_receipt($id)
    {
        $receipt = personalreceipt::with('user','personalrent','personalrent.student','personalrent.item')
                                  ->where('id',$id)->get()->first();
        if (!isset($receipt)){
            $receipt = collect();
        }
        return response($receipt->toJson(),200);
    }
}
