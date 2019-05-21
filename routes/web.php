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

Route::get('/Passport','PassPort\IndexController@login');

Route::post('/logininfo','PassPort\IndexController@logininfo');
Route::any('/user','PassPort\IndexController@user')->Middleware('Cookie');
Route::post('/register','PassPort\JieController@register');
Route::post('reg','User\UserController@reg');
Route::post('login','User\UserController@login');