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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
|     return $request->user();
| });
*/

Route::group([ 'prefix' => '/v1/auth', 'namespace' => 'api\v1' ], function(){
	Route::post('login', 'AuthController@store');
    Route::middleware(['AuthJwtMiddleware'])->group(function () {
        Route::get('me', 'AuthController@me');
        Route::get('refresh', 'AuthController@refreshToken');
        Route::get('logout', 'AuthController@logout');
    });
});

Route::group([ 'prefix' => '/v1/todo', 'namespace' => 'api\v1' ], function(){
    Route::middleware(['AuthJwtMiddleware'])->group(function () {
        Route::get('', 'TodoController@index');
        Route::post('', 'TodoController@store');
        Route::get('/{id}', 'TodoController@show');
        Route::put('/{id}', 'TodoController@update');
        Route::delete('/{id}', 'TodoController@destroy');
    });
});
