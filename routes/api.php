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
    });

    Route::group(['as' => 'api.pushUser.'], function (){
        Route::post('/push-users', 'PushUserController@store')->name('store');
        Route::get('/push-users/{uuid}/session', 'PushUserController@addSession')->name('session');
        Route::patch('/push-users/{uuid}/transition', 'PushUserController@addTransition')->name('transition');
        Route::patch('/push-users/{uuid}', 'PushUserController@update')->name('update');
        Route::patch('/push-users/{uuid}/tag', 'PushUserController@addTag')->name('tag');
        Route::patch('/push-users/{uuid}/time', 'PushUserController@addTime')->name('time');
    });

});
