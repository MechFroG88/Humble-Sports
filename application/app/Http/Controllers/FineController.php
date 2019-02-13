<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Fine;

class FineController extends Controller
{
    private $rules = [
        "fine" => "required|integer"
    ];

    public function change_fine(request $data)
    {
        $validator = Validator::make($data->all(), $this->rules);
        if ($validator->fails()) return $this->fail();
        $fine       = new fine;
        $fine->fine = $data->fine;
        $fine->save();
        return $this->ok();
    }

    public function get()
    {
        $id   = fine::max('id');
        $fine = fine::where('id', $id)->pluck('fine');
        return response($fine->toJson(),200);

    }
}


