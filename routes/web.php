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
// QUEUE - Send Mail
Route::get('/sendmail', 'SendMailController@index')->name('sendmail');
// CRUD - Blog
Route::get('/blog', 'BlogController@index')->name('blog');
Route::post('/blog/post', 'BlogController@post')->name('blog/post');
Route::post('/blog/delete', 'BlogController@delete')->name('blog/delete');
// CRUD - Convert
Route::get('/convert', 'ConvertController@index')->name('convert');
Route::post('/convert/post', 'ConvertController@post')->name('convert/post');
