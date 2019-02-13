<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use Validator;

class StudentController extends Controller
{
    private $rules = [
        "id"       => "required|integer",
        "cn_name"  => ["required","regex:/[\x{4e00}-\x{9fa5}]+/u"],
        "class"    => "required",
        "phone_no" => "",
        "picture"  => ""
    ];

    public function create(Request $data)
    {
        $validator = Validator::make($data->all(), $this->rules);
        if ($validator->fails()) return $this->fail();
        $student           = new student;
        $student->id       = $data->id;
        $student->cn_name  = $data->cn_name;
        $student->class    = $data->class;
        $student->phone_no = isset($data->phone_no) ? $data->phone_no : "";
        $student->picture  = isset($data->picture)  ? $data->picture  : "";
        $student->save();
        return $this->ok();     
    }

    public function get()
    {
        $student = student::all();
        return response($student->toJson(),200);
    }
}
