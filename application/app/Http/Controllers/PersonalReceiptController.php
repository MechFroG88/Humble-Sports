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
        $receipt                  = new personalreceipt;
        $receipt->personalrent_id = $id;
        $fine_id                  = fine::max('id');
        $fine                     = fine::where('id',$fine_id)->select('fine')->first();
        $receipt->fine            = $fine->fine;
        $date                     = Carbon::parse(personalrent::where('id',$id)->pluck('due_date')->first());
        $item_in                  = Carbon::parse(personalrent::where('id',$id)->pluck('item_in')->first());
        $receipt->days            = $date->diffInDays($item_in);
        $receipt->total_fine      = $fine->fine*$receipt->days;
        $item_id                  = personalrent::where('id',$id)->pluck('item_id');
        $price                    = item::where('id',$item_id)->select('price')->first();
        $receipt->price           = $price->price;
        $receipt->lost            = personalrent::where('id',$id)->pluck('lost')->first();
        $receipt->total_price     = $price->price * $receipt->lost; 
        $receipt->user_id         = Auth::user()->id;
        $receipt->save();
        personalrent::where('id', $id)
                    ->update(["item_in" => date('Y-m-d H:i:s')]);
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
