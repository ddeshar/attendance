<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::post('/register', 'Auth\RegisterController@create');
Route::post('login', 'Api\PassportController@login');
Route::post('register', 'Api\PassportController@register');

// Route::get('/stitexam', 'nation\StitexamController@index');
Route::middleware('auth:api')->group(function () {
    
   
    Route::get('/user', 'Api\PassportController@getUser');
    Route::get('/stitexam', 'nation\StitexamController@index');
 
    
    Route::get('/stitexam/show/{edu_year}/{id_explace}/{id_level}', 'nation\StitexamController@show');


    Route::get('/explace','nation\ExplaceController@index');
    // Route::resource('products', 'ProductController');
});
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });