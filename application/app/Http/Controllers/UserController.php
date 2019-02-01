<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use App\User;

class UserController extends Controller
{

    private $rules = [
        "username" => "required|unique:users,username,NULL,id,deleted_at,NULL",
        "cn_name"  => array("required","regex:/[\x{4e00}-\x{9fa5}]+/u"),
        "password" => "required",
        "type"     => "required|integer|between:0,1",
    ];

    public function login(Request $data)
    {
        if (Auth::attempt($data,$remember)) {
            return redirect()->intended();
        }
    }

    public function create(Request $data)
    {
        $validate = $data->validate($this->rules);

        $user = new user;
        $user->username = $data->username;
        $user->cn_name = $data->cn_name;
        $user->type = $data->type;
        $user->password = Hash::make($data->password);
        $user->save();
        return response("Successful operation",200);
    }

    public function get()
    {
        $user = user::all();
        return response($user->toJson(),200);
    }

}