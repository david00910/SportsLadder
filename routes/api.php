<?php

use App\Http\Controllers\ClubController;
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

        // Refresh the JWT Token

        Route::get('refresh', 'AuthController@refresh');
        // Create New User
        Route::post('register', 'AuthController@register');
        // Login User
        Route::post('login', 'AuthController@login');

        // Public leaderboard
        Route::get('results', 'ResultsController@index');




        // Below mention routes are available only for the authenticated users.
        Route::middleware('auth:api')->group(function () {

            // USERS
            Route::get('users', 'UserController@index');
            Route::get('user/{id}', 'UserController@show');
            Route::get('me', array(
                'as' => 'me',
                'uses' => 'AuthController@me',
            ));

            // RESULTS

            Route::get('result/{id}', 'ResultsController@show');
            Route::get('result/create/users', 'ResultsController@create');
            Route::post('result/store', 'ResultsController@store');


            // CLUBS

            Route::get('clubs', 'ClubController@index');
            Route::get('club/{id}', 'ClubController@show');
            Route::post('clubs/store', 'ClubController@store');
            Route::post('clubs/edit/image/{id}', 'ClubController@changeImage');
            Route::post('clubs/edit/general/{id}', 'ClubController@editInfo');

                // Club Members

                Route::get('clubs/members/', 'ClubController@addMemberData');
                Route::post('clubs/member/delete/{id}', 'ClubController@deleteMember');
                Route::post('clubs/member/invite/{id}', 'ClubController@inviteMember');

            // NOTIFICATIONS

            Route::get('notifications', 'NotificationController@indexNotification');

            // LOGOUT
            Route::post('logout', 'AuthController@logout');
        });
    });
});
