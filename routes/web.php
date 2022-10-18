<?php

use Illuminate\Support\Facades\Route;

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
    return view('beranda');
});

Route::get('/login', 'MainController@login');
Route::post('/login', 'MainController@userPostLogin');
Route::post('/order', 'MainController@order');

Route::get('/dashboard', 'MainController@home');
Route::get('/checkin', 'MainController@checkin');
Route::get('/report', 'MainController@report');
Route::get('/request/data/{type}','MainController@requestData');

Route::post('/check/ticket', 'MainController@checkinTicket');