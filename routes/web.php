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

Route::get('/', 'AttenController@index')->name('atten');
Route::get('members/comed/{id}/{month}', 'AttenController@comein')->name('comein');
Route::get('login/{provider}', 'SocialController@redirect');
Route::get('login/{provider}/callback', 'SocialController@Callback');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
