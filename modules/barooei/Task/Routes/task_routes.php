<?php


use barooei\Task\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;





Route::group(['namespace' => 'barooei\User\Http\Controllers'], function () {


    // Route::group(['middleware' => 'jwt_auth'], function () {
    Route::post('api/task/save', [TaskController::class, 'save']);
    Route::get('api/task/show/{id}', [TaskController::class, 'show']);
 
    Route::get('api/task/all', [TaskController::class, 'all']);
    Route::delete('api/task/delete/{id}', [TaskController::class,'delete']);
    Route::put('api/task/update/{task_id}', [TaskController::class,'update']);
    Route::PATCH('api/task/type/{id}', [TaskController::class,'updateEnumField']);

    // });

});


