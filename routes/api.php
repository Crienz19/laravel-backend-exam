<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Protected routes by sanctum
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index']);
    Route::post('/roles', [App\Http\Controllers\RoleController::class, 'store']);
    Route::patch('/role/{id}/patch', [App\Http\Controllers\RoleController::class, 'update']);
    Route::delete('/role/{id}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
    
    Route::post('/users', [App\Http\Controllers\UserController::class, 'store']);
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
    Route::patch('/user/{id}/patch', [App\Http\Controllers\UserController::class, 'update']);
    Route::delete('/user/{id}/delete', [App\Http\Controllers\UserController::class, 'destroy']);

    Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout']);

});