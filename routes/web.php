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
Route::get('/{any}', 'SpaController@index')->where('any', '.*');



// Route::get('/', 'AttenController@index')->name('atten');
// Route::get('members/comed/{id}/{month}', 'AttenController@comein')->name('comein');
// Route::get('login/{provider}', 'SocialController@redirect');
// Route::get('login/{provider}/callback', 'SocialController@Callback');
// Route::get('/stitexam/pdf', 'nation\StitexamController@pdfgennerate');

// Route::resource('stitexam', 'nation\StitexamController');
// Route::get('statistics',['as'=>'explace2.index','uses'=>'ExplaceController@index']);
// Route::get('statistics/view/{id}',['as'=>'explace2.show','uses'=>'ExplaceController@show']);


// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// Route::group(['middleware' => ['auth']], function() {
//     Route::resource('roles','RoleController');
//     Route::resource('users','UserController');


//     Route::resource('explace-all','ExplaceAllController');
//     Route::resource('country','nation\CountryController');
// Route::resource('stitexam', 'nation\StitexamController');
// Route::resource('level', 'nation\LevelController');
// Route::resource('explace', 'nation\ExplaceController');

//   // สถิติ
//   Route::post('stats-ajax', ['as'=>'stats-ajax','uses'=>'nation\StitexamController@statsAjax']);
// });