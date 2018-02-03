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



/* Dynamic thing Routes */

Route::get('/{thingName}/{channel}/{input?}', 'Thing\ThingController@touch');


Auth::routes();

Route::get('/', 'Views\HomeController@index')->name('home');

