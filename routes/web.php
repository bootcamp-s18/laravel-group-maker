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

Route::get('/activities', function() {
	$activities = \App\Activity::all();
	return view('activities.index', compact('activities'));
});

Route::get('/groups', function() {
	$groups = \App\Group::all();
	return view('groups.index', compact('groups'));
});

