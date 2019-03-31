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
Route::middleware('auth') ->put('item/{id}','ItemController@edit');
Route::middleware('auth') ->delete('item/{id}','ItemController@delete');
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
Route::middleware('auth')->get('rent/personal/sort','PersonalRentController@get_sorted');
Route::middleware('auth')->put('rent/personal/expired','PersonalRentController@update_expired');
Route::middleware('auth')->put('rent/personal/{id}/return','PersonalRentController@update_return');
Route::middleware('auth')->put('rent/personal/pay/{id}','PersonalRentController@pay');
Route::middleware('auth')->put('rent/personal/revert/{id}','PersonalRentController@revert');
Route::middleware('auth')->delete('rent/personal/{id}','PersonalRentController@delete');


/**
 * GroupRent Route
 */
Route::middleware('auth')->post('rent/group','GroupRentController@create');
Route::middleware('auth')->get('rent/group','GroupRentController@get');
Route::middleware('auth')->get('rent/group/sort','GroupRentController@get_sorted');
Route::middleware('auth')->put('rent/group/expired','GroupRentController@update_expired');
Route::middleware('auth')->put('rent/group/{id}/return','GroupRentController@update_return');
Route::middleware('auth')->put('rent/group/pay/{id}','GroupRentController@pay');
Route::middleware('auth')->put('rent/group/revert/{id}','GroupRentController@revert');
Route::middleware('auth')->delete('rent/group/{id}','GroupRentController@delete');
/**
 * PersonalReceipt Route
 */
Route::middleware('auth')->get('receipt/personal/{id}','PersonalReceiptController@get_receipt');

/**
 * GroupReceipt Route
 */
Route::middleware('auth')->get('receipt/group/{id}','GroupReceiptController@get_receipt');

/**
 * Report Route
 */
Route::middleware('auth')->get('report/stats','ReportController@get_stats');
Route::middleware('auth')->get('report/','ReportController@get_year')->defaults('year',date("Y"));
Route::middleware('auth')->get('report/{year}','ReportController@get_year');