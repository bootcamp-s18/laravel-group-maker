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

Route::get('/home', 'HomeController@index')->name('home')->middleware('settings');

Route::resource('/activities', 'ActivityController')->middleware('settings');

Route::resource('/groups', 'GroupController')->middleware('settings');

Route::get('/settings', 'SettingController@index');
Route::post('/settings', 'SettingController@store');
Route::put('/settings/{id}', 'SettingController@update');
Route::patch('/settings/{id}', 'SettingController@update');

Route::get('/not_configured', 'SettingController@not_configured');

