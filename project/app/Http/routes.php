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
use Illuminate\Http\Request;
Route::post ( '/', function (Request $request) {
    \Stripe\Stripe::setApiKey ( 'sk_test_8cnU38GePfiBbNfvSFVsUsEX' );
    try {
        \Stripe\Charge::create ( array (
                "amount" => 300 * 100,
                "currency" => "usd",
                "source" => $request->input ( 'stripeToken' ), // obtained with Stripe.js
                "description" => "Test payment." 
        ) );
        Session::flash ( 'success-message', 'Payment done successfully !' );
        return Redirect::back ();
    } catch ( \Exception $e ) {
        Session::flash ( 'fail-message', "Error! Please Try again." );
        return Redirect::back ();
    }
});
Route::group(['middleware' => ['web']], function () {
	   Route::get('/', 'HomeController@index');
   	Route::controller('dashboard', 'DashboardController');
   	Route::controller('user','UserController');
   	Route::controller('role', 'RoleController');
   	Route::controller('homepage-section','HomepageSectionController');
   	Route::controller('language-management','LanguageManagementController');
      Route::controller('language-price','LanguagePriceController');
      Route::controller('language-package','LanguagePackageController');
   	Route::controller('translation-application','TranslationApplicationController');
   	Route::controllers([
   		'auth' => 'Auth\AuthController',
   		'password' => 'Auth\PasswordController',
   	]);	
});
