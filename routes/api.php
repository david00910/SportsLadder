<?php

use Illuminate\Http\Request;

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

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        // Below mention routes are public, user can access those without any restriction.
        // Create New User
        Route::post('register', 'AuthController@register');
        // Login User
        Route::post('login', 'AuthController@login');
        Route::get('users', 'UserController@index');

        // Refresh the JWT Token
        Route::get('refresh', 'AuthController@refresh');

        // Below mention routes are available only for the authenticated users.
        Route::middleware('auth:api')->group(function () {
            // USERS
            //Route::get('users', 'UserController@index');
            Route::get('user/{id}', 'UserController@show');
            Route::get('me', 'AuthController@me');

            // RESULTS
            Route::get('results', 'ResultsController@index');
            Route::get('result/{id}', 'ResultsController@show');


            // LOGOUT
            Route::post('logout', 'AuthController@logout');
        });
    });
});
