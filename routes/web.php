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

Route::group(['middleware' => 'auth'], function() {
    Route::get('categories', 'CategoriesController@index');

    Route::get('categories/new', 'CategoriesController@create');
    Route::post('categories/store', 'CategoriesController@store');

    Route::get('categories/{category}/edit', 'CategoriesController@edit');
    Route::post('categories/{category}/update', 'CategoriesController@update');

    Route::get('/categories/{category}/delete', 'CategoriesController@destroy');
});


