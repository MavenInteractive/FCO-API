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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth'     => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['prefix' => 'api/v1.0'], function() {
    Route::post('auth/register', ['as' => 'api.v1.0.auth.register', 'uses' => 'UserController@register']);
    Route::post('auth/login', ['as' => 'api.v1.0.auth.login', 'uses' => 'UserController@login']);
    Route::post('auth/reset', ['as' => 'api.v1.0.auth.reset', 'uses' => 'UserController@reset']);
    Route::get('auth/logout', ['as' => 'api.v1.0.auth.logout', 'uses' => 'UserController@logout']);
});

Route::group([
        'prefix'     => 'api/v1.0',
        'middleware' => [
            'before' => 'jwt.auth'
        ]
    ], function() {
    Route::resource('users', 'UserController');
    Route::resource('categories', 'CategoryController');
});

