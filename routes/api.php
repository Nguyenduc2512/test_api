<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('test_order','App\Http\Controllers\testApiController@getListBank')->name('test_api');
Route::post('send_order','App\Http\Controllers\testApiController@sendOrder')->name('send_order');
Route::get('test_success','App\Http\Controllers\testApiController@success')->name('test_success');
Route::get('test_detail','App\Http\Controllers\testApiController@detail')->name('test_detail');
Route::post('webhook_return', 'App\Http\Controllers\testApiController@webhookNotification')->name('webhook_notification');
