<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\auth;
use \App\Http\Controllers;
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
Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('login', [auth\AuthController::class,'login'])->name('api.login');
});

Route::group([
    'middleware' => ['auth.jwt'],
    'prefix' => 'auth',
], function () {
    Route::get('me', [auth\AuthController::class,'me']);
    Route::post('logout',  [auth\AuthController::class,'logout']);
});

Route::group([
    'middleware' => ['auth.jwt'],
], function () {
    Route::get('my-project', [Controllers\ProjectController::class,'myProject']);
});

Route::group([
    'middleware' => ['auth.jwt'],
    'prefix' => 'task'
], function () {
    Route::get('list/{project_id}', [Controllers\TaskController::class,'getAll']);
    Route::get('list-parent/{projectId}', [Controllers\TaskController::class,'getParents']);
    Route::get('list-children/{parentId}', [Controllers\TaskController::class,'getChildren']);
    Route::post('store', [Controllers\TaskController::class,'store']);
    Route::put('update/{id}', [Controllers\TaskController::class,'update']);
});

Route::group([
    'middleware' => ['auth.jwt'],
    'prefix' => 'image'
], function () {
    Route::get('list/{task_id}', [Controllers\ImageController::class,'getByTask']);
});
Route::group([
    'prefix' => 'image'
], function () {
    Route::post('store', [Controllers\ImageController::class,'store']);
});

Route::group([
    'middleware' => ['auth.jwt'],
    'prefix' => 'user'
], function () {
    Route::get('all', [Controllers\UserController::class,'getAll']);
    Route::get('user-in-project/{project_id}', [Controllers\UserController::class,'getAllInProject']);
    Route::post('store-user', [Controllers\UserController::class,'storeUser']);
});

Route::group([
    'middleware' => ['auth.jwt'],
    'prefix' => 'notification'
], function () {
    Route::get('all/{userId}', [Controllers\NotificationController::class,'getAll']);
    Route::post('store', [Controllers\NotificationController::class,'store']);
});

Route::group([
    'middleware' => ['auth.jwt'],
    'prefix' => 'team'
], function () {
    Route::get('team-in-project/{project_id}', [Controllers\TeamController::class,'getTeamInProject']);
    Route::post('store', [Controllers\TeamController::class,'store']);
});
