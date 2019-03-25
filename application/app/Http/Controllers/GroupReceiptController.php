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
        if ($days != 0 && fine::max('id') <= 0) return $this->fail();
        $fine_id               = fine::max('id');
        $single_fine           = fine::where('id',$fine_id)->select('fine')->first();    
        $item_id               = grouprent::where('id',$id)->pluck('item_id');
        $single_price          = item::where('id',$item_id)->select('price')->first();
        if (groupreceipt::where('grouprent_id',$id)->exists()){
            groupreceipt::where('grouprent_id',$id)
                           ->update([
                               "grouprent_id" => $id,
                               "fine" => $fine->fine,
                               "days" => ($date >= $item_in) ? 0 : $date->diffInDays($item_in),
                               "total_fine" => $fine->fine*$receipt->days,
                               "price" => $price->price,
                               "lost" => grouprent::where('id',$id)->pluck('lost')->first(),
                               "total_price" => $price->price * $receipt->lost,
                               "user_id" => Auth::user()->id,
                           ]);
            grouprent::where('id', $id)
                     ->update(["item_in" => date('Y-m-d H:i:s')]);
            
            return $this->ok();
        }
        $receipt               = new groupreceipt;
        $receipt->grouprent_id = $id;
        $receipt->single_fine  = $single_fine->fine;  
        $receipt->total_fine   = $single_fine->fine*$days;
        $receipt->days         = $days;
        $receipt->single_price = $single_price->price;
        $receipt->lost         = grouprent::where('id',$id)->pluck('lost')->first();
        $receipt->total_price  = $single_price->price * $receipt->amount; 
        $receipt->user_id      = Auth::user()->id;
        $receipt->save();
        grouprent::where('id', $id)
                 ->update(["item_in" => date('Y-m-d H:i:s')]);
        return $this->ok();
    }
    
    public function get_receipt($id)
    {
        $groupreceipt = groupreceipt::with('user','grouprent','grouprent.item')
                                    ->where('grouprent_id',$id);
        return response($groupreceipt->toJson(),200);
    }

}