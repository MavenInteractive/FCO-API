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

Route::get('dashboard', 'HomeController@index');

Route::controllers([
    'auth'     => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::group(['prefix' => 'api/v1.0'], function() {
    Route::post('auth/register', ['as' => 'auth.register', 'uses' => 'UserController@register']);
    Route::post('auth/login', ['as' => 'auth.login', 'uses' => 'UserController@login']);
    Route::post('auth/reset', ['as' => 'auth.reset', 'uses' => 'UserController@reset']);
    Route::get('auth/logout', ['as' => 'auth.logout', 'uses' => 'UserController@logout']);
});

Route::group([
    'prefix'     => 'api/v1.0',
    'middleware' => [
        'before' => 'jwt.auth'
    ]], function() {
        Route::resource('users', 'UserController', [
            'except' => ['create', 'store', 'show'],
            'names'  => ['index' => 'users.index', 'edit' => 'users.edit', 'update' => 'users.update', 'destroy' => 'users.destroy']
        ]);
        Route::resource('categories', 'CategoryController', [
            'except' => ['create', 'show'],
            'names'  => ['index' => 'categories.index', 'store' => 'categories.store', 'edit' => 'categories.edit', 'update' => 'categories.update', 'destroy' => 'categories.destroy']
        ]);
        Route::resource('callouts', 'CalloutController', [
            'except' => ['create', 'show'],
            'names'  => ['index' => 'callouts.index', 'store' => 'callouts.store', 'edit' => 'callouts.edit', 'update' => 'callouts.update', 'destroy' => 'callouts.destroy']
        ]);
});

