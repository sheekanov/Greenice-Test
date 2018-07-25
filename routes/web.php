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

Route::get('/', 'PlaceController@index')->name('home');


Route::get('/create', 'PlaceController@create')->name('create');
Route::post('/create', 'PlaceController@store')->name('store');

Route::get('/edit/{placeId}', 'PlaceController@edit')->name('edit');
Route::post('/update/{placeId}', 'PlaceController@update')->name('update');

Route::get('/delete/{placeId}', 'PlaceController@delete')->name('delete');

