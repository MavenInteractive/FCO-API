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
    Route::get('callouts', ['as' => 'callouts.index', 'uses' => 'CalloutController@index']);
    Route::get('categories', ['as' => 'categories.index', 'uses' => 'CategoryController@index']);
    Route::get('comments', ['as' => 'comments.index', 'uses' => 'CommentController@index']);
    Route::get('countries', ['as' => 'countries.index', 'uses' => 'CountriesController@index']);

    Route::resource('uploads', 'UploadController', [
        'only'  => ['show'],
        'names' => ['show' => 'uploads.show']
    ]);
});

Route::group([
    'prefix'     => 'api/v1.0',
    'middleware' => [
        'before' => 'jwt.auth'
    ]], function() {
        Route::post('callouts/upload', ['as' => 'callouts.upload', 'uses' => 'CalloutController@upload']);
        Route::post('users/{users}/upload', ['as' => 'users.upload', 'uses' => 'UserController@upload']);
        Route::get('users/{users}/callouts', ['as' => 'users.callouts', 'uses' => 'UserController@callouts']);

        Route::resource('users', 'UserController', [
            'except' => ['create', 'store'],
            'names'  => ['index' => 'users.index', 'show' => 'users.show', 'edit' => 'users.edit', 'update' => 'users.update', 'destroy' => 'users.destroy']
        ]);
        Route::resource('callouts', 'CalloutController', [
            'except' => ['create', 'index'],
            'names'  => ['show' => 'callouts.show', 'store' => 'callouts.store', 'edit' => 'callouts.edit', 'update' => 'callouts.update', 'destroy' => 'callouts.destroy']
        ]);
        Route::resource('comments', 'CommentController', [
            'except' => ['create', 'index'],
            'names'  => ['show' => 'comments.show', 'store' => 'comments.store', 'edit' => 'comments.edit', 'update' => 'comments.update', 'destroy' => 'comments.destroy']
        ]);
        Route::resource('roles', 'RoleController', [
            'only'  => ['index'],
            'names' => ['index' => 'roles.index']
        ]);
        Route::resource('votes', 'VoteController', [
            'only'  => ['store'],
            'names' => ['store' => 'votes.store']
        ]);
});
