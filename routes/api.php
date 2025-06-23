<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CommentController;
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
    Route::get('projects/{project_id}/tasks/{task_id}/comments', [CommentController::class, 'index']);
    Route::post('projects/{project_id}/tasks/{task_id}/comments', [CommentController::class, 'store']);
    Route::put('projects/{project_id}/tasks/{task_id}/comments/{comment_id}', [CommentController::class, 'update']);
    Route::delete('projects/{project_id}/tasks/{task_id}/comments/{comment_id}', [CommentController::class, 'destroy']);
});
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
Route::group(['middleware'=>'auth:api'], function (){
   Route::get('tags', [TagController::class, 'index']);
   Route::post('tags', [TagController::class, 'store']);
   Route::delete('tags/{id}', [TagController::class, 'destroy']);
});
