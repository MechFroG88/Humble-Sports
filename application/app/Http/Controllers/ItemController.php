<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PersonalRent;
use App\GroupRent;
use Validator;
use App\Item;

class ItemController extends Controller
{
    private $rules = [
        "type"     => ["required"],
        "start_id" => "required|integer",
        "end_id"   => "required|integer",
        "price"    => "required|numeric",
    ];

    public function create(Request $data)
    {
        $validator = Validator::make($data->all(), $this->rules);
        if ($validator->fails()) return $this->fail();
        item::create($data->all());
        return $this->ok();
    }

    public function get()
    {
        $item = item::all();
        return response($item->toJson(),200);
    }

    public function get_single($id)
    {
        $item = item::where('id', $id)->get()->first();
        return response($item->toJson(),200);
    }

    public function get_single_rent($id)
    {
        $merged = collect();
        $personalrent = personalrent::where('item_id',$id)->get()
                                    ->makeHidden(['item_tag','amount','lost','due_date','returned'])
                                    ->sortByDesc('item_out');

        $grouprent    = grouprent::where('item_id',$id)->get()
                                  ->makeHidden(['item_tag','amount','lost','due_date','returned','cn_name','class','phone_no'])
                                  ->sortByDesc('item_out');
        foreach ($personalrent as $single_personalrent){
            $merged->push($single_personalrent);
        }
        foreach ($grouprent as $single_grouprent){
            $merged->push($single_grouprent);
        }
        return response($merged->toJson(),200);
    }
}
