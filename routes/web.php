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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/notify', 'NotifyController@NotifyUsers');
Route::post('/notify/all', 'NotifyController@sendNotify')->name('noteall');
Route::post('/notify/devices', 'NotifyController@sendDeviceNotify')->name('note_to_device');
