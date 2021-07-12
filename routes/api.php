<?php

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

Route::group([

    'middleware' => 'api',
    'prefix' => 'v1'

], function () {


    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::apiResource('test', 'TestController');
    Route::apiResource('AmountAssigned', 'AmountAssignedController');
    Route::apiResource('Voucher', 'VoucherController');
    Route::get('coordinadores', 'UserController@getCoordinadores');
    Route::get('cashRegister/registersCajaChia','CashRegisterController@registersCajaChia');
    Route::apiResource('cashRegister','CashRegisterController');

});
