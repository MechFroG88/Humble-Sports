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
        $receipt               = new groupreceipt;
        $receipt->grouprent_id = $id;
        $fine_id               = fine::max('id');
        $single_fine           = fine::where('id',$fine_id)->select('fine')->first();
        $receipt->single_fine  = $single_fine->fine;
        $date                  = Carbon::parse(grouprent::where('id',$id)->pluck('due_date')->first());
        $item_in               = Carbon::parse(grouprent::where('id',$id)->pluck('item_in')->first());
        $days                  = ($date >= $item_in) ? 0 : $date->diffInDays($item_in);
        $receipt->total_fine   = $single_fine->fine*$days;
        $receipt->days         = $days;
        $item_id               = grouprent::where('id',$id)->pluck('item_id');
        $single_price          = item::where('id',$item_id)->select('price')->first();
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
        $groupreceipt = groupreceipt::with('user','grouprent','grouprent.item')->find($id);
        return response($groupreceipt->toJson(),200);
    }

}