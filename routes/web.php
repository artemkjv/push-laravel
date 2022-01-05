<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::group(['middleware' => ['auth', 'verified'], 'namespace' => '\\App\\Http\\Controllers\\'], function (){
    Route::get('/two-factory/login', 'Auth\\TFAController@index')->name('auth.tfa.index');
    Route::post('/two-factory/login', 'Auth\\TFAController@login')->name('auth.tfa.login');

    Route::group(['middleware' => ['tfa']], function (){

        Route::get('/home', 'HomeController@index')->name('home');

        Route::group(['as' => 'user.'], function (){
            Route::get('/user', 'UserController@index')->name('index');
            Route::put('/user/change-password', 'UserController@changePassword')->name('changePassword');
            Route::put('/user/regenerate-token', 'UserController@regenerateToken')->name('regenerateToken');
        });

        Route::group(['as' => 'tfa.'], function (){
            Route::get('/two-factory', 'TFAController@index')->name('index');
            Route::put('/two-factory/enable', 'TFAController@enable')->name('enable');
            Route::put('/two-factory/disable', 'TFAController@disable')->name('disable');
        });

        Route::group(['as' => 'app.'], function (){
            Route::get('/apps', 'AppController@index')->name('index');
            Route::get('/apps/create', 'AppController@create')->name('create');
            Route::post('/apps/create', 'AppController@store')->name('store');
            Route::get('/apps/{id}', 'AppController@edit')->name('edit');
            Route::delete('/apps/{id}', 'AppController@destroy')->name('destroy');
            Route::put('/apps/{id}', 'AppController@update')->name('update');
            Route::get('/apps/{id}/show', 'AppController@show')->name('show');
        });

        Route::group(['as' => 'segment.'], function (){
           Route::get('/segments', 'SegmentController@index')->name('index');
           Route::get('/segments/create', 'SegmentController@create')->name('create');
           Route::post('/segments/create', 'SegmentController@store')->name('store');
           Route::get('/segments/{id}', 'SegmentController@edit')->name('edit');
           Route::delete('/segments/{id}', 'SegmentController@destroy')->name('destroy');
           Route::put('/segments/{id}', 'SegmentController@update')->name('update');
        });

        Route::group(['as' => 'template.'], function (){
            Route::get('/templates', 'TemplateController@index')->name('index');
            Route::get('/templates/create', 'TemplateController@create')->name('create');
            Route::post('/templates/create', 'TemplateController@store')->name('store');
            Route::get('/templates/{id}', 'TemplateController@edit')->name('edit');
            Route::delete('/templates/{id}', 'TemplateController@destroy')->name('destroy');
            Route::put('/templates/{id}', 'TemplateController@update')->name('update');
        });

        Route::group(['as' => 'pushUser.'], function (){
            Route::get('/push-users', 'PushUserController@index')->name('index');
            Route::delete('/push-users/{id}', 'PushUserController@destroy')->name('destroy');
        });

        Route::group(['as' => 'customPush.'], function (){
            Route::get('/custom-pushes', 'CustomPushController@index')->name('index');
            Route::get('/custom-pushes/create', 'CustomPushController@create')->name('create');
            Route::post('/custom-pushes/create', 'CustomPushController@store')->name('store');
            Route::get('/custom-pushes/{id}', 'CustomPushController@edit')->name('edit');
            Route::delete('/custom-pushes/{id}', 'CustomPushController@destroy')->name('destroy');
            Route::put('/custom-pushes/{id}', 'CustomPushController@update')->name('update');
        });

        Route::group(['as' => 'weeklyPush.'], function (){
            Route::get('/weekly-pushes', 'WeeklyPushController@index')->name('index');
            Route::get('/weekly-pushes/create', 'WeeklyPushController@create')->name('create');
            Route::post('/weekly-pushes/create', 'WeeklyPushController@store')->name('store');
            Route::get('/weekly-pushes/{id}', 'WeeklyPushController@edit')->name('edit');
            Route::delete('/weekly-pushes/{id}', 'WeeklyPushController@destroy')->name('destroy');
            Route::put('/weekly-pushes/{id}', 'WeeklyPushController@update')->name('update');
        });

        Route::group(['as' => 'autoPush.'], function (){
            Route::get('/auto-pushes', 'AutoPushController@index')->name('index');
            Route::get('/auto-pushes/create', 'AutoPushController@create')->name('create');
            Route::post('/auto-pushes/create', 'AutoPushController@store')->name('store');
            Route::get('/auto-pushes/{id}', 'AutoPushController@edit')->name('edit');
            Route::delete('/auto-pushes/{id}', 'AutoPushController@destroy')->name('destroy');
            Route::put('/auto-pushes/{id}', 'AutoPushController@update')->name('update');
        });

        Route::group(['as' => 'moderator.', 'middleware' => ['moderator']], function (){
            Route::get('/moderators', 'ModeratorController@index')->name('index');
            Route::get('/moderators/create', 'ModeratorController@create')->name('create');
            Route::post('/moderators/create', 'ModeratorController@store')->name('store');
            Route::get('/moderators/{id}', 'ModeratorController@edit')->name('edit');
            Route::delete('/moderators/{id}', 'ModeratorController@destroy')->name('destroy');
            Route::put('/moderators/{id}', 'ModeratorController@update')->name('update');
        });

        Route::group(['as' => 'sentPush.'], function (){
            Route::get('/sent-pushes', 'SentPushController@index')->name('index');
            Route::delete('/sent-pushes/{id}', 'SentPushController@destroy')->name('destroy');
            Route::get('/sent-pushes/{id}', 'SentPushController@show')->name('show');
        });

    });

});

Auth::routes();

