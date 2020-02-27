<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('users/register' , 'RegisterController@register');


Route::post('users/login' , 'RegisterController@login');