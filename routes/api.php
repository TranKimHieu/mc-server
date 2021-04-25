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
