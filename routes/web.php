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

Route::any('index','IndexController@index');
Route::any('login','IndexController@login');
Route::any('register','IndexController@register');
Route::any('login1','LoginController@index');
Route::any('login2','LoginController@index1');
Route::any('shop','IndexController@shop');
Route::any('goods{goods_id}','IndexController@goods');
Route::any('cart{goods_id}','IndexController@cart');
Route::any('pay','IndexController@pay');

Route::any('prize','IndexController@prize');



