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
    public function create_fine($id)
    {
        $receipt               = new groupreceipt;
        $receipt->grouprent_id = $id;
        $fine_id               = fine::max('id');
        $single_fine           = fine::where('id',$fine_id)->select('fine')->first();
        $receipt->single_fine  = $single_fine->fine;
        $date                  = Carbon::parse(grouprent::where('id',$id)->pluck('due_date')->first());
        $now                   = Carbon::now();
        $days                  = $date->diffInDays($now);
        $receipt->total        = $single_fine->fine*$days;
        $receipt->user_id      = Auth::user()->id;
        $receipt->type         = 2;
        $receipt->save();
        return $this->ok();
    }
    
    public function create_lost($id)
    {
        $receipt               = new groupreceipt;
        $receipt->grouprent_id = $id;
        $item_id               = grouprent::where('id',$id)->pluck('item_id');
        $single_price          = item::where('id',$item_id)->select('price')->first();
        $receipt->single_price = $single_price->price;
        $amount                = grouprent::where('id',$id)->pluck('lost')->first();
        $receipt->total        = $single_price->price * $amount; 
        $receipt->user_id      = Auth::user()->id;
        $receipt->type         = 3;
        $receipt->save();
        return $this->ok();
    }
    
    public function get_receipt($id)
    {
        $groupreceipt = groupreceipt::with('user','grouprent','grouprent.item')->find($id);
        return response($groupreceipt->toJson(),200);
    }

}