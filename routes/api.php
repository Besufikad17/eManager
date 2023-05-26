<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;

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

// account management routes

Route::get('/users', [UserController::class, 'index']);

Route::post('/signup', [UserController::class, 'store']);


// Employee management routes

Route::post('/add', [EmployeeController::class, 'store']);

Route::get('/employees', [EmployeeController::class, 'index']);

Route::get('/employee/:id');

Route::put('/edit/:id');

Route::delete('/remove/:id');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    echo "";
    return $request->user();
});
