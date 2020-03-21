<?php

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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace', 'prefix' => 'manageSchedule'], function() {

    Route::group(['prefix' => 'schedule'], function() {
        Route::group(['middleware' => 'role:admin'],function (){
            Route::delete('delete/{id}',['as' => 'schedule.delete', 'uses' => 'ScheduleController@delete']);
            Route::get('edit/{id}',['as' => 'schedule.edit', 'uses' => 'ScheduleController@edit']);
            Route::post('update/{id}',['as' => 'schedule.update', 'uses' => 'ScheduleController@update']);
        });
        Route::get('/',['as' => 'schedule.list', 'uses' => 'ScheduleController@index']);
        Route::get('create',['as' => 'schedule.create', 'uses' => 'ScheduleController@create']);
        Route::post('store',['as' => 'schedule.store', 'uses' => 'ScheduleController@store']);
        Route::post('import',['as' => 'schedule.import', 'uses' => 'ImportExcelController@import']);
    });
    Route::group(['prefix' => 'user'], function() {
        Route::group(['middleware' => 'role:admin'],function (){
            Route::delete('delete/{id}',['as' => 'user.delete', 'uses' => 'UserController@delete']);
            Route::get('edit/{id}',['as' => 'user.edit', 'uses' => 'UserController@edit']);
            Route::get('create',['as' => 'user.create', 'uses' => 'UserController@create']);
            Route::post('store',['as' => 'user.store', 'uses' => 'UserController@store']);
            Route::post('update/{id}',['as' => 'user.update', 'uses' => 'UserController@update']);
        });
        Route::get('/',['as' => 'user.list', 'uses' => 'UserController@index']);
    });
    Route::group(['prefix' => 'construction'], function() {
        Route::get('/',['as' => 'construction.list', 'uses' => 'ConstructionController@index']);
        Route::get('detail/{id}',['as' => 'construction.detail', 'uses' => 'ConstructionController@detail']);
        Route::get('detail-work/{id}',['as' => 'construction.detailwork', 'uses' => 'ConstructionController@detailWork']);
        Route::get('update/{id}',['as' => 'construction.update', 'uses' => 'ConstructionController@getUpdate']);
        Route::post('update',['as' => 'construction.post.update', 'uses' => 'ConstructionController@postUpdate']);
    });
});
