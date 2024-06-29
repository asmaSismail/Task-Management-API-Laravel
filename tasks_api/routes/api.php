<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminTasksController;
use App\Http\Controllers\UserTasksController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Public Routes
Route::post('/login',[AuthController::class, 'login']);
Route::post('/register',[AuthController::class, 'register']);

//Protected Routes
Route::group(['middleware'=>['auth:sanctum']],function(){
    //admin Routes
    Route::group(['middleware'=>['admin']],function(){
         Route::get('/admin/tasks',[AdminTasksController::class, 'index']);
         Route::get('/admin/tasks/deleted',[AdminTasksController::class, 'tasksDeleted']);
         Route::post('/admin/tasks',[AdminTasksController::class, 'store']);
         Route::get('/admin/tasks/{id}',[AdminTasksController::class, 'show']);
         Route::put('/admin/tasks/{id}',[AdminTasksController::class, 'update']);
         Route::delete('/admin/tasks/{id}',[AdminTasksController::class, 'destroy']);
         
    });

    //user Routes
    Route::group([],function(){
        Route::get('/user/tasks',[UserTasksController::class, 'index']);
        Route::post('/user/tasks',[UserTasksController::class, 'store']);
        Route::get('/user/tasks/{id}',[UserTasksController::class, 'show']);
        Route::put('/user/tasks/{id}',[UserTasksController::class, 'update']);
        Route::delete('/user/tasks/{id}',[UserTasksController::class, 'destroy']);
    });

    Route::post('/logout',[AuthController::class, 'logout']);
   
});
