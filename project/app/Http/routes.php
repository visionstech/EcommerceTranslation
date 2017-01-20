<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {
	Route::get('/', 'HomeController@index');
   	Route::controller('dashboard', 'DashboardController');
   	Route::controller('user','UserController');
   	Route::controller('role', 'RoleController');
   	Route::controller('homepage-section','HomepageSectionController');
   	Route::controller('translation-application','TranslationApplicationController');
	Route::controllers([
		'auth' => 'Auth\AuthController',
		'password' => 'Auth\PasswordController',
	]);	
});
