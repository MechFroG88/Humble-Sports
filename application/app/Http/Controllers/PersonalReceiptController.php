<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PersonalReceipt;
use App\PersonalRent;
use App\GroupRent;
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
        $receipt->user_id         = Auth::user()->id;
        $receipt->type            = 3;
        $receipt->save();
        return $this->ok();
    }
    
    public function get_receipt($id)
    {
        $personalreceipt = personalreceipt::with('user','personalrent','personalrent.student','personalrent.item')->find($id);
        return response($personalreceipt->toJson(),200);
    }
}
