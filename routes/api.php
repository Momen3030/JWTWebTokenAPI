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

Route::group(['namespace'=>'Api','prefix'=>'user'],function (){
    Route::post('login','UserController@login');
    Route::post('logout', 'UserController@logout');
    Route::get('products','ProductController@allProducts');
    Route::group(['middleware'=>['auth.jwt:user']],function () {
        Route::get('profile','UserController@profile');
        });
});