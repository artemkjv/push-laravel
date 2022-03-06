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

Route::group(['namespace' => '\\App\\Http\\Controllers\\Api\\'], function () {

    Route::group(['as' => 'api.app.'], function (){
        Route::get('/apps/{uuid}/show', 'AppController@show')->name('show');
        Route::group(['middleware' => 'api.auth'], function (){
            Route::post('/apps/store', 'AppController@store')->name('store');
            Route::put('/apps/{uuid}', 'AppController@update')->name('update');
        });
    });

    Route::group(['as' => 'api.customPush.', 'middleware' => 'api.auth'], function (){
       Route::post('/custom-pushes/store', 'CustomPushController@store')->name('store');
       Route::put('/custom-pushes/{id}', 'CustomPushController@update')->name('update');
    });

    Route::group(['as' => 'api.autoPush.', 'middleware' => 'api.auth'], function (){
        Route::post('/auto-pushes/store', 'AutoPushController@store')->name('store');
        Route::put('/auto-pushes/{id}', 'AutoPushController@update')->name('update');
    });

    Route::group(['as' => 'api.weeklyPush.', 'middleware' => 'api.auth'], function (){
        Route::post('/weekly-pushes/store', 'WeeklyPushController@store')->name('store');
        Route::put('/weekly-pushes/{id}', 'WeeklyPushController@update')->name('update');
    });

    Route::group(['as' => 'api.pushUser.'], function (){
        Route::post('/push-users', 'PushUserController@store')->name('store');
        Route::get('/push-users/{registrationId}/session', 'PushUserController@addSession')->name('session');
        Route::patch('/push-users/{registrationId}/transition', 'PushUserController@addTransition')->name('transition');
        Route::patch('/push-users/{registrationId}', 'PushUserController@update')->name('update');
        Route::patch('/push-users/{registrationId}/tag', 'PushUserController@addTag')->name('tag');
        Route::patch('/push-users/{registrationId}/time', 'PushUserController@addTime')->name('time');
    });

    Route::group(['as' => 'api.legacy.app.'], function (){
        Route::get('/app/{uuid}/view', 'LegacyAppController@show')->name('show');
    });

    Route::group(['as' => 'api.legacy.pushUser.'], function (){
        Route::post('/user/subscribe', 'LegacyPushUserController@store')->name('store');
        Route::get('/user/{registrationId}/session', 'LegacyPushUserController@addSession')->name('session');
        Route::put('/user/update', 'LegacyPushUserController@update')->name('update');
        Route::post('/tag/save', 'LegacyPushUserController@addTag')->name('tag');
        Route::post('/user/time', 'LegacyPushUserController@addTime')->name('time');
        Route::post('/user/{registrationId}/transition', 'LegacyPushUserController@addTransition')->name('transition');
    });

});
