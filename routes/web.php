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
        Route::get('/',['as' => 'schedule.list', 'uses' => 'ScheduleController@index']);
        Route::post('delete/{id}',['as' => 'schedule.delete', 'uses' => 'ScheduleController@delete']);
        Route::get('edit/{id}',['as' => 'schedule.edit', 'uses' => 'ScheduleController@edit']);
        Route::get('create',['as' => 'schedule.create', 'uses' => 'ScheduleController@create']);
        Route::post('store',['as' => 'schedule.store', 'uses' => 'ScheduleController@store']);
        Route::post('update/{id}',['as' => 'schedule.update', 'uses' => 'ScheduleController@update']);

        Route::post('import',['as' => 'schedule.import', 'uses' => 'ImportExcelController@import']);
    });
});