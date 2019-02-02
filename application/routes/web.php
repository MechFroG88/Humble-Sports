<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('login','UserController@login');
Route::middleware('admin')->post('user','UserController@create');
Route::middleware('admin')->get('user','UserController@get');
Route::middleware('auth')->put('user/password','UserController@change_password');
Route::middleware('auth')->post('logout','UserController@logout');
Route::middleware('auth')->get('user/{id}','UserController@get_single');
Route::middleware('admin')->put('user/{id}','UserController@update_type');
Route::middleware('admin')->delete('user/{id}','UserController@delete');