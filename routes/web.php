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

// Route::get('/', 'CalendarController@index')->name('home');



Route::get('/report/{id}/reports', 'CalendarController@index')->name('home');

//休日設定
Route::get('/report', 'CalendarController@getHoliday')->name('calendar.holiday');
Route::post('/report', 'CalendarController@createHoliday');

//休日の編集機能(更新と削除)
Route::get('/report/{id}', 'CalendarController@getHolidayId')->name('calendar.edit');
Route::post('/report/{id}', 'CalendarController@deleteHoliday')->name('delete.holiday');

//フォルダ作成機能
Route::get('/report/folders/create', 'FolderController@showCreateForm')->name('folders.create');
Route::post('/report/folders/create', 'FolderController@create');
