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

/**
 * User Route
 */

Route::post('user/login','UserController@login');
Route::middleware('auth') ->get('user','UserController@get');
Route::middleware('auth') ->get('user/current','UserController@get_current');
Route::middleware('auth') ->get('user/{id}','UserController@get_single');
Route::middleware('auth') ->put('user/password','UserController@change_password');
Route::middleware('auth') ->put('user/username','UserController@change_username');
Route::middleware('auth') ->post('user/logout','UserController@logout');
Route::middleware('admin')->post('user','UserController@create');
Route::middleware('admin')->put('user/{id}','UserController@update_type');
Route::middleware('admin')->delete('user/{id}','UserController@delete');

/**
 * Student Route
 */
Route::middleware('auth')->post('student','StudentController@create');
Route::middleware('auth')->get('student','StudentController@get');

/**
 * Item Route
 */
Route::middleware('admin')->post('item','ItemController@create');
Route::middleware('auth') ->get('item','ItemController@get');
Route::middleware('auth') ->get('item/{id}','ItemController@get_single');
Route::middleware('auth') ->get('item/record/{id}','ItemController@get_single_rent');

/**
 * Fine Route
 */
Route::middleware('auth')->post('fine','FineController@change_fine');
Route::middleware('auth')->get('fine','FineController@get');

/**
 * PersonalRent Route
 */
Route::middleware('auth')->post('rent/personal','PersonalRentController@create');
Route::middleware('auth')->get('rent/personal','PersonalRentController@get');
Route::middleware('auth')->put('rent/personal/expired','PersonalRentController@update_expired');
Route::middleware('auth')->put('rent/personal/{id}/return','PersonalRentController@update_return');

/**
 * GroupRent Route
 */
Route::middleware('auth')->post('rent/group','GroupRentController@create');
Route::middleware('auth')->get('rent/group','GroupRentController@get');
Route::middleware('auth')->put('rent/group/expired','GroupRentController@update_expired');
Route::middleware('auth')->put('rent/group/{id}/return','GroupRentController@update_return');

/**
 * PersonalReceipt Route
 */
Route::middleware('auth')->post('receipt/personal/{id}','PersonalReceiptController@create_receipt');
Route::middleware('auth')->get('receipt/personal/{id}','PersonalReceiptController@get_receipt');

/**
 * GroupReceipt Route
 */
Route::middleware('auth')->post('receipt/group/{id}','GroupReceiptController@create_receipt');
Route::middleware('auth')->get('receipt/group/{id}','GroupReceiptController@get_receipt');

/**
 * Report Route
 */
Route::middleware('auth')->get('report','ReportController@get_stats');
Route::middleware('auth')->get('report/month','ReportController@get_month');