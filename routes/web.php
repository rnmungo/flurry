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

/***** 			Comunes 			*****/
Route::view('/', 'welcome');
Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function() {	
	/***** 			Recursos 			*****/
	Route::resource('/customers', 'CustomerController')->middleware('role:customers');
	Route::resource('/cadets', 'CadetController')->middleware('role:cadets');
	Route::resource('/products', 'ProductController')->middleware('role:products');
	Route::resource('/tastes', 'TasteController')->middleware('role:tastes');
	Route::resource('/users', 'UserController')->except('show');

	/*****		 Pseudo-Recursos		*****/	
	Route::get('/roles', 'RoleController@index')->middleware('role:roles');

	/***** 	Configuración del sistema 	*****/
	Route::get('/settings/reset', 'SettingsController@resetSettings')->middleware('role:settings');
	Route::resource('/settings', 'SettingsController')->only(['index', 'update'])->middleware('role:settings');

	/***** 			Extras 			*****/
	Route::view('/about', 'about')->name('about');
	Route::view('/help', 'help')->name('help');
	Route::view('/develop', 'develop')->name('develop');
	Route::get('/users/{user}/avatar', 'UserController@show_change_avatar')->name('users.change-avatar');
	Route::get('/users/{user}/password', 'UserController@show_change_password')->name('users.change-password');
});

Auth::routes();
