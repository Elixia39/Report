<?php

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



// Route::get('/setEvents', 'EventController@setEvents');
// Route::post('/ajax/addEvent', 'EventController@addEvent');
// Route::post('/ajax/editEventDate', 'EventController@editEventDate');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'CalendarController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('main');

    //フォルダ作成機能
    Route::get('/report/folders/create', 'FolderController@showCreateForm')->name('folders.create');
    Route::post('/report/folders/create', 'FolderController@create');

    //休日設定
    Route::get('/report', 'CalendarController@getHoliday')->name('calendar.holiday');
    Route::post('/report', 'CalendarController@createHoliday');
    //休日の編集機能(更新と削除)
    Route::get('/report/{id}', 'CalendarController@getHolidayId')->name('calendar.edit');
    Route::post('/report/{id}', 'CalendarController@deleteHoliday')->name('delete.holiday');

    Route::group(['middleware' => ['can:view,folder']], function () {

        //日報一覧ページ
        Route::get('/folders/{folder}/reports', 'ReportController@index')->name('reports.index');

        //日報作成機能
        Route::get('/report/{folder}/DailyReport/create', 'ReportController@showCreateForm')->name('reports.create');
        Route::post('/report/{folder}/DailyReport/create', 'ReportController@create');

        //日報編集機能
        Route::get('/report/{folder}/DailyReport/{report}/edit', 'ReportController@showEditForm')->name('reports.edit');
        Route::post('/report/{folder}/DailyReport/{report}/edit', 'ReportController@edit');
    });
});


Route::get('/test', 'TestController@index')->name('test');
Route::post('/test', 'TestController@keisan')->name('keisan');



Auth::routes();
