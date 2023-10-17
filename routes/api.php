<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\EmployeeController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\ImageController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', function(){
    return 'welcome to eManager';
});

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function(){

    // account management routes

    Route::post('/signup', [AuthController::class, 'register']);

    Route::post('/login', [AuthController::class, 'login']);

    Route::post('/images/upload', [ImageController::class, 'store']);

    // middleware

    Route::group(['middleware' => ['auth:sanctum']], function() {

        Route::post('/request_recover', [AuthController::class, 'recover']);

        Route::put('/edit_profile/{id}', [UserController::class, 'update']);

        Route::delete('/delete_profile/{id}', [UserController::class, 'destroy']);

        Route::get('/images/{id}', [ImageController::class, 'getImageByUserId']);

        // Employee management routes

        Route::post('/add', [EmployeeController::class, 'store']);

        Route::get('/employees', [EmployeeController::class, 'index']);

        Route::get('/employee/{id}', [EmployeeController::class, 'show']);

        Route::get('/employee/email/{email}', [EmployeeController::class, 'showByEmail']);

        Route::put('/edit/{id}', [EmployeeController::class, 'update']);

        Route::delete('/remove/{id}', [EmployeeController::class, 'destroy']);

        Route::get('/search/{text}', [EmployeeController::class, 'search']);
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    echo "";
    return $request->user();
});
