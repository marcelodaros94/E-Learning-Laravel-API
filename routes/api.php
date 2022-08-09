<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [ 'as' => 'login', 'uses' => 'App\Http\Controllers\AuthController@login']);
    Route::post('logout', [ 'as' => 'logout', 'uses' => 'App\Http\Controllers\AuthController@logout']);
    Route::post('refresh', [ 'as' => 'refresh', 'uses' => 'App\Http\Controllers\AuthController@refresh']);
    Route::post('me', [ 'as' => 'me', 'uses' => 'App\Http\Controllers\AuthController@me']);
    Route::post('register', [ 'as' => 'register', 'uses' => 'App\Http\Controllers\AuthController@register']);
    Route::get('course/{id}', [ 'as' => 'course', 'uses' => 'App\Http\Controllers\CursoController@getWithDetailByUser']);
    Route::put('progress', [ 'as' => 'progress', 'uses' => 'App\Http\Controllers\DetalleProgresoController@updateProgress']);
});

Route::group([
    'middleware' => 'api'
], function ($router) {
    Route::get('course', [ 'as' => 'courses', 'uses' => 'App\Http\Controllers\CursoController@index']);
    Route::get('course/{id}', [ 'as' => 'course', 'uses' => 'App\Http\Controllers\CursoController@getWithDetail']);
});