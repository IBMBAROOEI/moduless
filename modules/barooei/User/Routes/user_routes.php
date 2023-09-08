<?php


use barooei\User\Http\Controllers\AuthUsersController;
use Illuminate\Support\Facades\Route;





Route::group(['namespace' => 'barooei\User\Http\Controllers'], function () {
    Route::post('api/user/register', [AuthUsersController::class, 'register']);
    Route::post('api/user/login', [AuthUsersController::class, 'login']);

    Route::group(['middleware' => 'jwt_auth'], function () {
    Route::post('api/user/refresh', [AuthUsersController::class, 'refresh']);
    Route::get('api/user/profile', [AuthUsersController::class, 'profile']);
    Route::get('api/user/logout', [AuthUsersController::class, 'logout']);
    });

});


