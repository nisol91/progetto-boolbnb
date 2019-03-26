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


Route::get('/', 'WelcomeController@index_public')->name('home.public');
Route::get('/filtered', 'Api\FilterController@filter')->name('filtered');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::resource('/apartment', 'ApartmentController')->middleware('auth');
