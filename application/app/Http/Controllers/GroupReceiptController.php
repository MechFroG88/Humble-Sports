<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PersonalRent;
use App\GroupRent;
use App\Student;
use App\User;
use App\Fine;
use App\GroupReceipt;
use App\Item;
use Carbon\Carbon;
use Auth;


class GroupReceiptController extends Controller
{
    public function create_receipt($id)
    {
        $date                  = Carbon::parse(grouprent::where('id',$id)->pluck('due_date')->first());
        $item_in               = Carbon::parse(grouprent::where('id',$id)->pluck('item_in')->first());
        $days                  = ($date >= $item_in) ? 0 : $date->diffInDays($item_in);
        $fine_id               = fine::max('id');
        $fine                  = fine::where('id',$fine_id)->select('fine')->first();    
        $item_id               = grouprent::where('id',$id)->pluck('item_id');
        $price                 = item::where('id',$item_id)->select('price')->first();
        $lost                  = grouprent::where('id',$id)->pluck('lost')->first();
        $receipt               = new groupreceipt;
        $receipt->id           = $id;
        $receipt->fine         = $fine->fine;  
        $receipt->total_fine   = $fine->fine*$days;
        $receipt->days         = $days;
        $receipt->price        = $price->price;
        $receipt->lost         = $lost;
        $receipt->total_price  = $price->price * $lost; 
        $receipt->user_id      = Auth::user()->id;
        $receipt->save();
        grouprent::where('id', $id)
                 ->update(["item_in" => date('Y-m-d H:i:s')]);
        return $this->ok();
    }
    
    public function get_receipt($id)
    {
        $groupreceipt = groupreceipt::with('user','grouprent','grouprent.item')
                                    ->where('id',$id)->get()->first();
        if (!isset($receipt)){
            $receipt = collect();
        }
        return response($groupreceipt->toJson(),200);
    }

}