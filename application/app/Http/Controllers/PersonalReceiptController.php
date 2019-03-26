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
        if ($days != 0 && fine::max('id') <= 0) return $this->fail();
        $fine_id                  = fine::max('id');
        $fine                     = fine::where('id',$fine_id)->select('fine')->first();  
        $item_id                  = personalrent::where('id',$id)->pluck('item_id');
        $price                    = item::where('id',$item_id)->select('price')->first();
        if (personalreceipt::where('personalrent_id',$id)->exists()){
            personalreceipt::where('personalrent_id',$id)
                           ->update([
                               "personal_rent_id" => $id,
                               "fine" => $fine->fine,
                               "days" => $days,
                               "total_fine" => $fine->fine*$receipt->days,
                               "price" => $price->price,
                               "lost" => personalrent::where('id',$id)->pluck('lost')->first(),
                               "total_price" => $price->price * $receipt->lost,
                               "user_id" => Auth::user()->id,
                           ]);
            personalrent::where('id', $id)
                        ->update(["item_in" => date('Y-m-d H:i:s')]);
            
            return $this->ok();
        }
        $receipt                  = new personalreceipt;
        $receipt->personalrent_id = $id;
        $receipt->fine            = $fine->fine;
        $receipt->days            = $days;
        $receipt->total_fine      = $fine->fine*$receipt->days;
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
        $receipt = personalreceipt::with('user','personalrent','personalrent.student','personalrent.item')
                                  ->where('personalrent_id',$id)->get();
        if (!isset($receipt)){
            $receipt = collect();
        }
        return response($personalreceipt->toJson(),200);
    }
}
