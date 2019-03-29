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
Route::get('/details/{id}', 'WelcomeController@details_public')->name('details.public');

//filtro ricerca con ajax
Route::post('ajaxRequest', 'HomeController@ajaxRequestPost');

Route::get('ajaxRequest', 'HomeController@autocomplete');
// Route::get('/filtered', 'Api\FilterController@filter')->name('filtered');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::resource('/apartment', 'ApartmentController')->middleware('auth');
Route::resource('/message', 'MessageController');

// BRAINTREE

Route::get('/payment', 'PaymentsController@index')->name('payment.index');
Route::get('/payment/process', 'PaymentsController@process')->name('payment.process');

Route::post('/braintree/token', 'PaymentsController@token')->name('payment.token');




