<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api'], function () {
//    Route::post('login', 'AuthController@login');
//    Route::post('logout', 'AuthController@logout');
//    Route::post('refresh', 'AuthController@refresh');
//    Route::post('me', 'AuthController@me');
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('register', 'Auth\RegisterController@register');
    Route::post('verification/verify', 'Auth\VerificationController@verify')
        ->name('verification.verify');
    Route::post('verification/resend', 'Auth\VerificationController@resen');
});
