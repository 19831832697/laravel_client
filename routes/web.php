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

Route::get('encrypt','pass\PassController@encrypt');
Route::get('encrypt_pass','pass\PassController@encrypt_pass');
Route::get('mi','pass\PassController@mi');
Route::get('jie','pass\PassController@jie');
Route::get('rec','pass\PassController@rec');
Route::get('sign','pass\PassController@sign');
Route::get('decrypt','pass\PaController@decrypt');

Route::get('reg','user\UserController@reg');//注册视图
Route::post('regDo','user\UserController@regDo');//注册执行
Route::get('login','user\UserController@login');//登录视图
Route::post('loginDo','user\UserController@loginDo');//登录执行

Route::any('register','user\RegController@register');
