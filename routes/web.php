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

    });

});

Auth::routes();

