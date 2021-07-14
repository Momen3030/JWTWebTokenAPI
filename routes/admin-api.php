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



Route::group(['prefix'=>'admin','namespace'=>'Api'],function (){
    Route::post('login','AdminController@login');
    Route::post('logout', 'AdminController@logout');
    Route::group(['middleware'=>['auth.jwt:admin']],function () {
    Route::post('product','ProductController@store');
    Route::get('profile','AdminController@profile');
    });
});