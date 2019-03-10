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

Route::redirect('/', '/books');
Route::get('/login', 'IndexController@login');
Route::get('/login/callback', 'IndexController@callback');
Route::get('/logout', 'IndexController@logout');
Route::get('/books', 'BookController@index');
Route::get('/books/add', 'BookController@add');
Route::post('/books/add', 'BookController@create');
Route::get('/books/{id}', 'BookController@view');
Route::get('/books/{id}/edit', 'BookController@edit');
Route::post('/books/{id}/edit', 'BookController@update');
Route::post('/books/{id}/delete', 'BookController@delete');
