<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
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
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::group(['middleware'=>'auth:api'], function (){
    Route::get('projects/{id}/tasks', [TaskController::class, 'index']);
    Route::post('projects/{id}/tasks', [TaskController::class, 'store']);
    Route::get('projects/{id}/tasks/{task_id}', [TaskController::class, 'show']);
    Route::put('projects/{id}/tasks/{task_id}', [TaskController::class, 'update']);
    Route::delete('projects/{id}/tasks/{task_id}', [TaskController::class, 'destroy']);
});
Route::group(['middleware'=>'auth:api'], function (){
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
    Route::get('projects', [ProjectController::class, 'index']);
    Route::post('projects', [ProjectController::class, 'store']);
    Route::get('projects/{id}', [ProjectController::class, 'show']);
    Route::put('projects/{id}', [ProjectController::class, 'update']);
    Route::delete('projects/{id}', [ProjectController::class, 'destroy']);
});
