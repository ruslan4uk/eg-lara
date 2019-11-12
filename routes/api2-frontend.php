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
 * Init data
 */
Route::get('/init', 'InitController@init');

/**
 * Search route
 */
Route::prefix('/search')->group(function() {
    Route::get('/city', 'Search\GeoController@searchCity');
});

/**
 * Auth route
 */
Route::prefix('/auth')->group(function() {
    Route::post('/login', 'AuthController@login');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/register', 'AuthController@register');
    Route::get('/user', 'AuthController@user');
    Route::post('/confirm-send', 'AuthController@confirmSend');
    Route::post('/confirm', 'AuthController@confirm');
    Route::post('/change-password', 'AuthController@changePassword');
});

/**
 * Guide profile get, update, upload
 */
Route::prefix('/profile')->group(function() {
    Route::get('/', 'Guide\ProfileController@index');
    Route::post('/', 'Guide\ProfileController@store');
    Route::post('/upload-avatar', 'Guide\ProfileController@uploadAvatar');
    Route::post('/upload', 'Guide\ProfileController@multiUploader');
    Route::post('/upload/delete', 'Guide\ProfileController@multiUploaderDelete');

    /**
     * Guide crud tour
     */
    Route::resource('tours', 'Guide\TourController');
    Route::post('/tours/uploader/avatar/{id}', 'Guide\TourController@uploadAvatar');
    Route::post('/tours/uploader/multi/{id}', 'Guide\TourController@uploadMulti');
    Route::post('/tours/uploader/multi/{id}/delete', 'Guide\TourController@uploadMultiDelete');
});

/**
 * Frontend routers
 */
Route::prefix('/front')->group(function() {
   Route::get('/main', 'Frontend\MainController@index');

   Route::get('/user/{id}', 'Frontend\UserController@showUserInfo');
   Route::get('/user/{id}/excursions', 'Frontend\UserController@showUserTours');
   Route::get('/user/{id}/responses', 'Frontend\UserController@showUserResponses');
});




