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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// REST API - Blog
Route::get('/blog', 'Api\BlogController@index')->name('api/blog');
Route::post('/blog/get', 'Api\BlogController@get')->name('api/blog/get');
Route::post('/blog/post', 'Api\BlogController@post')->name('api/blog/post');
Route::post('/blog/delete', 'Api\BlogController@delete')->name('api/blog/delete');
