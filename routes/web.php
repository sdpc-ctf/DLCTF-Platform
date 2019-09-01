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

Route::get('/','ctfController@index');
/*
ctf
*/
Route::get('challenges','ctfController@challenges');
Route::get('challenges/{type}','ctfController@ctftype')->where('type','[a-z]+');
Route::get('scoreboard','ctfController@score');
Route::post('flag/submit','ctfController@submitflag');
Route::any('notice','ctfController@notice');
/*
admin
*/
Route::get('ctfadmin/task','adminController@seetask');
Route::any('ctfadmin/task/add','adminController@addtask');
Route::any('ctfadmin/task/edit/{id}','adminController@edittask')->where('id','[0-9]+');
Route::get('ctfadmin/home','adminController@index');
Route::any('ctfadmin/task/hint','adminController@hintadd');
Route::get('ctfadmin/task/delete/{id}','adminController@delete')->where('id','[0-9]+');
Route::get('ctfadmin/task/hide/{id}','adminController@hide')->where('id','[0-9]+');
Route::any('ctfadmin/notice','adminController@notice');
Route::get('ctfadmin/task/open/{id}','adminController@open')->where('id','[0-9]+');
Route::get('ctfadmin/notice/delete/{id}','adminController@noticedelete')->where('id','[0-9]+');
Route::any('ctfadmin/notice/edit/{id}','adminController@noticeedit')->where('id','[0-9]+');
Route::get('ctfadmin/team','adminController@seeteam');
Route::any('ctfadmin/team/edit/{id}','adminController@editteam')->where('id','[0-9]+');
Route::get('ctfadmin/team/delete/{id}','adminController@deleteteam')->where('id','[0-9]+');




Auth::routes();

Route::get('/home', 'ctfController@index');
Route::get('/about','ctfController@about');
