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

Route::get('/sample-view', function () {
    return view('sample');
});

Route::get('/dashboard', function () {
    return view('sample');
})->name('dashboard');

Route::group(['prefix' => 'drivers'], function() {
    
	Route::get('/', 'DriverDatatablesController@index')
	->name('driver_lists');

	Route::get('/anydata', 'DriverDatatablesController@anyData')
	->name('driver_anydata');

	Route::get('/create', 'DriverDatatablesController@create')
	->name('driver_create');

	Route::post('/create', 'DriverDatatablesController@store')
	->name('driver_create');

	Route::get('/{id}/view', 'DriverDatatablesController@show')
	->name('driver_view');

	Route::get('/{id}/edit', 'DriverDatatablesController@edit')
	->name('driver_edit');

	Route::post('/{id}/edit', 'DriverDatatablesController@update')
	->name('driver_edit');

	// Route::post('/{id}/delete', 'DriverDatatablesController')
	// ->name('driver_delete');
});

