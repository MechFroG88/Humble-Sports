<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Validator;	
use App\User;
use Auth;

class UserController extends Controller
{

    private $rules = [
        "username" => "required|unique:users,username,NULL,id,deleted_at,NULL",
        "cn_name"  => ["required","regex:/[\x{4e00}-\x{9fa5}]+/u"],
        "password" => "required",
        "type"     => "required|integer|between:0,1",
    ];

    private $login_rules = [
        "username" => "required",
        "password" => "required"
    ];

    public function login(Request $data)
    {
        $validator = Validator::make($data->all(), $this->login_rules);
        if ($validator->fails()) return $this->fail();
        $data = $data->only('username','password');
        if (Auth::attempt($data,true)) {
            return $this->ok();
        } else {
            return response("Unauthorized",401);
        }
    }

    public function logout()
    {
        Auth::logout();
        return $this->ok();
    }

    public function create(Request $data)
    {
        $validator = Validator::make($data->all(), $this->rules);
        if ($validator->fails()) return $this->fail();
        $data->request->add(['password' => Hash::make($data->password)]); 
        user::create($data->all());
        return $this->ok();
    }

    public function get()
    {
        $user = user::all()->makeHidden('username');
        return response($user->toJson(),200);
    }

    public function change_password(Request $data)
    {   
        $validator = Validator::make($data->all(),array("password" => "required"));
        if ($validator->fails()) return $this->fail();
        user::where('id', Auth::user()->id)
            ->update(["password" => Hash::make($data->password)]);
        return $this->ok();
    }

    public function change_username(Request $data)
    {   
        $validator = Validator::make($data->all(),array("username" => "required"));
        if ($validator->fails()) return $this->fail();
        user::where('id', Auth::user()->id)
            ->update(["username" => $data->username]);
        return $this->ok();
    }

    public function get_single($id)
    {
        return response(user::find($id)->toJson(),200);
    }

    public function update_type(Request $data,$id)
    {
        $validator = Validator::make($data->all(),["type" => "required|between:0,1"]);
        if ($validator->fails()) return $this->fail();
        user::where('id', $id)
            ->update(["type" => $data->type]);
        return $this->ok();
    }

    public function delete(Request $data,$id)
    {
        user::where('id', $id)->delete();
        return $this->ok();
    }

}