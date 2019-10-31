<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return 'Ok';
});

/**
 * Auth route
 */
Route::prefix('/auth')->group(function() {
    Route::post('/login', 'Admin\AuthController@login');
    Route::post('/logout', 'Admin\AuthController@logout');
    Route::get('/user', 'Admin\AuthController@user');
});

/**
 * Users Route
 */
Route::prefix('/users')->middleware(['role:admin', 'jwt:api'])->group(function() {
    Route::get('/guides', 'Admin\User\HomeController@getGuideUser');
    Route::get('/guides/{id}', 'Admin\User\HomeController@getGuideUserProfile');
    Route::post('/guides/{id}', 'Admin\User\HomeController@changeGuideUserActiveStatus');
});

/**
 * Tours Route
 */
Route::prefix('/tours')->middleware(['role:admin', 'jwt:api'])->group(function() {
    Route::get('/', 'Admin\Tour\HomeController@getTour');
    Route::get('/{id}', 'Admin\Tour\HomeController@getTourProfile');
    Route::post('/{id}', 'Admin\Tour\HomeController@changeTourActiveStatus');
});

/**
 * Geo route
 */
Route::prefix('/geo')->middleware(['role:admin', 'jwt:api'])->group(function() {
    Route::get('/country', 'Admin\Geo\CountryController@index');
    Route::get('/city/{iso}', 'Admin\Geo\CityController@index');
    Route::post('/city/{iso}', 'Admin\Geo\CityController@create');
    Route::delete('/city/{id}', 'Admin\Geo\CityController@destroy');
});

/**
 * Dashboard
 */
Route::prefix('/dashboard')->middleware(['role:admin', 'jwt:api'])->group(function () {
   Route::get('/', 'Admin\Dashboard\HomeController@index');
});

/**
 * Comment
 */
Route::prefix('/comment')->group(function () {
    Route::get('/', 'Admin\Comment\HomeController@index');
    Route::post('/{id}', 'Admin\Comment\HomeController@changeCommentActiveStatus');
});

/**
 * Language
 */
Route::prefix('/language')->group(function () {
    Route::get('/', 'Admin\Language\HomeController@index');
    Route::post('/{id}', 'Admin\Language\HomeController@create');
    Route::delete('/{id}', 'Admin\Language\HomeController@destroy');
});
