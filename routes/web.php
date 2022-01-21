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

Route::group(['middleware' => ['auth', 'verified'], 'namespace' => '\\App\\Http\\Controllers\\', 'mid'], function (){
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
            Route::patch('/apps/{id}/push', 'AppController@push')->name('push');
        });

        Route::group(['as' => 'segment.'], function (){
           Route::get('/segments', 'SegmentController@index')->name('index');
           Route::get('/segments/create', 'SegmentController@create')->name('create');
           Route::post('/segments/create', 'SegmentController@store')->name('store');
           Route::get('/segments/{id}', 'SegmentController@edit')->name('edit');
           Route::delete('/segments/{id}', 'SegmentController@destroy')->name('destroy');
           Route::put('/segments/{id}', 'SegmentController@update')->name('update');
           Route::post('/segments/{id}/copy', 'SegmentController@copy')->name('copy');
        });

        Route::group(['as' => 'template.'], function (){
            Route::get('/templates', 'TemplateController@index')->name('index');
            Route::get('/templates/create', 'TemplateController@create')->name('create');
            Route::post('/templates/create', 'TemplateController@store')->name('store');
            Route::get('/templates/{id}', 'TemplateController@edit')->name('edit');
            Route::delete('/templates/{id}', 'TemplateController@destroy')->name('destroy');
            Route::put('/templates/{id}', 'TemplateController@update')->name('update');
            Route::post('/templates/{id}/copy', 'TemplateController@copy')->name('copy');
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
            Route::post('/custom-pushes/{id}/copy', 'CustomPushController@copy')->name('copy');
        });

        Route::group(['as' => 'weeklyPush.'], function (){
            Route::get('/weekly-pushes', 'WeeklyPushController@index')->name('index');
            Route::get('/weekly-pushes/create', 'WeeklyPushController@create')->name('create');
            Route::post('/weekly-pushes/create', 'WeeklyPushController@store')->name('store');
            Route::get('/weekly-pushes/{id}', 'WeeklyPushController@edit')->name('edit');
            Route::delete('/weekly-pushes/{id}', 'WeeklyPushController@destroy')->name('destroy');
            Route::put('/weekly-pushes/{id}', 'WeeklyPushController@update')->name('update');
            Route::post('/weekly-pushes/{id}/copy', 'WeeklyPushController@copy')->name('copy');
        });

        Route::group(['as' => 'autoPush.'], function (){
            Route::get('/auto-pushes', 'AutoPushController@index')->name('index');
            Route::get('/auto-pushes/create', 'AutoPushController@create')->name('create');
            Route::post('/auto-pushes/create', 'AutoPushController@store')->name('store');
            Route::get('/auto-pushes/{id}', 'AutoPushController@edit')->name('edit');
            Route::delete('/auto-pushes/{id}', 'AutoPushController@destroy')->name('destroy');
            Route::put('/auto-pushes/{id}', 'AutoPushController@update')->name('update');
            Route::post('/auto-pushes/{id}/copy', 'AutoPushController@copy')->name('copy');
        });

        Route::get('/moderators', 'ModeratorController@index')->name('moderator.index');

        Route::group(['as' => 'moderator.', 'middleware' => ['not.moderator']], function (){
            Route::get('/moderators/create', 'ModeratorController@create')->name('create');
            Route::post('/moderators/create', 'ModeratorController@store')->name('store');
            Route::get('/moderators/{id}', 'ModeratorController@edit')->name('edit');
            Route::get('/moderators/{id}/segments', 'ModeratorController@editSegments')->name('edit.segments');
            Route::get('/moderators/{id}/templates', 'ModeratorController@editTemplates')->name('edit.templates');
            Route::get('/moderators/{id}/custom-pushes', 'ModeratorController@editCustomPushes')->name('edit.customPushes');
            Route::get('/moderators/{id}/auto-pushes', 'ModeratorController@editAutoPushes')->name('edit.autoPushes');
            Route::get('/moderators/{id}/weekly-pushes', 'ModeratorController@editWeeklyPushes')->name('edit.weeklyPushes');
            Route::delete('/moderators/{id}', 'ModeratorController@destroy')->name('destroy');
            Route::put('/moderators/{id}', 'ModeratorController@update')->name('update');
            Route::put('/moderators/{id}/segments', 'ModeratorController@updateSegments')->name('update.segments');
            Route::put('/moderators/{id}/templates', 'ModeratorController@updateTemplates')->name('update.templates');
            Route::put('/moderators/{id}/custom-pushes', 'ModeratorController@updateCustomPushes')->name('update.customPushes');
            Route::put('/moderators/{id}/auto-pushes', 'ModeratorController@updateAutoPushes')->name('update.autoPushes');
            Route::put('/moderators/{id}/weekly-pushes', 'ModeratorController@updateWeeklyPushes')->name('update.weeklyPushes');
        });

        Route::group(['as' => 'moderator.', 'middleware' => ['moderator']], function (){
            Route::get('/moderators/{id}/apps', 'ModeratorController@renderApps')->name('apps.render');
            Route::patch('/moderators/{id}/apps', 'ModeratorController@handleApps')->name('apps.handle');
        });

        Route::group(['as' => 'sentPush.'], function (){
            Route::get('/sent-pushes', 'SentPushController@index')->name('index');
            Route::delete('/sent-pushes/{id}', 'SentPushController@destroy')->name('destroy');
            Route::get('/sent-pushes/{id}', 'SentPushController@show')->name('show');
        });

    });

});

Route::group(['middleware' => ['auth', 'verified', 'admin-manager'], 'namespace' => '\\App\\Http\\Controllers\\Admin', 'as' => 'admin.', 'prefix' => '/admin'], function (){
    Route::group(['as' => 'user.'], function (){
        Route::get('/users', 'UserController@index')->name('index');
        Route::get('/users/{id}', 'UserController@show')->name('show');
        Route::delete('/users/{id}', 'UserController@destroy')->name('destroy');
    });

    Route::group(['middleware' => ['user.managed'], 'prefix' => '/user/{userId}'], function (){
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

        Route::group(['as' => 'customPush.'], function (){
            Route::get('/custom-pushes', 'CustomPushController@index')->name('index');
            Route::get('/custom-pushes/create', 'CustomPushController@create')->name('create');
            Route::post('/custom-pushes/create', 'CustomPushController@store')->name('store');
            Route::get('/custom-pushes/{id}', 'CustomPushController@edit')->name('edit');
            Route::delete('/custom-pushes/{id}', 'CustomPushController@destroy')->name('destroy');
            Route::put('/custom-pushes/{id}', 'CustomPushController@update')->name('update');
        });

        Route::group(['as' => 'autoPush.'], function (){
            Route::get('/auto-pushes', 'AutoPushController@index')->name('index');
            Route::get('/auto-pushes/create', 'AutoPushController@create')->name('create');
            Route::post('/auto-pushes/create', 'AutoPushController@store')->name('store');
            Route::get('/auto-pushes/{id}', 'AutoPushController@edit')->name('edit');
            Route::delete('/auto-pushes/{id}', 'AutoPushController@destroy')->name('destroy');
            Route::put('/auto-pushes/{id}', 'AutoPushController@update')->name('update');
        });

        Route::group(['as' => 'weeklyPush.'], function (){
            Route::get('/weekly-pushes', 'WeeklyPushController@index')->name('index');
            Route::get('/weekly-pushes/create', 'WeeklyPushController@create')->name('create');
            Route::post('/weekly-pushes/create', 'WeeklyPushController@store')->name('store');
            Route::get('/weekly-pushes/{id}', 'WeeklyPushController@edit')->name('edit');
            Route::delete('/weekly-pushes/{id}', 'WeeklyPushController@destroy')->name('destroy');
            Route::put('/weekly-pushes/{id}', 'WeeklyPushController@update')->name('update');
        });

        Route::group(['as' => 'pushUser.'], function (){
            Route::get('/push-users', 'PushUserController@index')->name('index');
            Route::delete('/push-users/{id}', 'PushUserController@destroy')->name('destroy');
        });

        Route::group(['as' => 'sentPush.'], function (){
            Route::get('/sent-pushes', 'SentPushController@index')->name('index');
            Route::delete('/sent-pushes/{id}', 'SentPushController@destroy')->name('destroy');
            Route::get('/sent-pushes/{id}', 'SentPushController@show')->name('show');
        });

    });

    Route::group(['middleware' => 'admin'], function (){

        Route::group(['as' => 'manager.'], function (){
            Route::get('/managers', 'ManagerController@index')->name('index');
            Route::get('/managers/create', 'ManagerController@create')->name('create');
            Route::get('/managers/{id}', 'ManagerController@edit')->name('edit');
            Route::post('/managers/create', 'ManagerController@store')->name('store');
            Route::put('/managers/{id}', 'ManagerController@update')->name('update');
            Route::delete('/managers/{id}', 'ManagerController@destroy')->name('destroy');
        });

        Route::group(['as' => 'tariff.'], function (){
            Route::get('/tariffs', 'TariffController@index')->name('index');
            Route::get('/tariffs/create', 'TariffController@create')->name('create');
            Route::post('/tariffs/create', 'TariffController@store')->name('store');
            Route::get('/tariffs/{id}', 'TariffController@edit')->name('edit');
            Route::put('/tariffs/{id}', 'TariffController@update')->name('update');
            Route::delete('/tariffs/{id}', 'TariffController@destroy')->name('destroy');
        });

    });

});

Auth::routes();

