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
        "price"    => "required|integer",
        "title"    => ""
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
        $personalrent = personalrent::where('item_id',$id)->get();
        $grouprent    = grouprent::where('item_id',$id)->get()->makeHidden(['cn_name','class','phone_no']);
        $merged       = $personalrent->merge($grouprent);
        return response($merged->toJson(),200);
    }
}
