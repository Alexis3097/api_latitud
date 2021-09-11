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
    Route::get('Voucher/getDataSelects', 'VoucherController@getDataSelects');
    Route::apiResource('Voucher', 'VoucherController');
    Route::get('coordinadores', 'UserController@getCoordinadores');

    Route::get('cashRegister/registersXUser/{id}','CashRegisterController@registersXUser');
    Route::get('cashRegister/getRegistersXUser/{id}','CashRegisterController@getRegistersXUser');
    Route::get('cashRegister/getRegistersXCajaChica/{id}','CashRegisterController@getRegistersXCajaChica');
    Route::get('cashRegister/RegisterWithVoucher/{id}','CashRegisterController@RegisterWithVoucher');
    Route::apiResource('cashRegister','CashRegisterController');

    Route::get('box/cajaChica','BoxController@cajaChica');
    Route::put( 'box/approveExpense/{id}', 'BoxController@approveExpense');
    Route::put( 'box/discountBox/{id}', 'BoxController@discountBox');
    Route::get('user/getUserXId/{id}','UserController@getUserXId');
    Route::get('user/onlyUser','UserController@onlyUser');
    Route::get('user/getBoss','UserController@getBoss');
    Route::get('userType','UserTypeController@index');
    Route::put('user/changePasswordFromUser/{id}','UserController@changePasswordFromUser');
    Route::apiResource('user', 'UserController');
    Route::post('notificationtokens', 'NotificationTokenController@saveUserToken');


});
