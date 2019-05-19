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

Route::prefix('v1')->group(function() {
  // Auth
  Route::prefix('auth')->group(function() {
    Route::post('/register', 'ApiV1\Auth\AuthController@register');
    Route::post('/login', 'ApiV1\Auth\AuthController@login');
    Route::post('/logout', 'ApiV1\Auth\AuthController@logout');
  });

  // User cabinet (jwt token guard)
  Route::middleware('jwt:api')->group(function() {
    // Profile route
    Route::resource('profile', 'ApiV1\User\HomeController')->only('index', 'store');
    Route::post('profile/multi-upload', 'ApiV1\User\UploadController@multiUploader');
    Route::post('profile/multi-upload/delete', 'ApiV1\User\UploadController@multiUploaderDelete');
    Route::post('profile/upload-avatar', 'ApiV1\User\UploadController@uploadAvatar');
    // Tour route
    Route::resource('profile/tour', 'ApiV1\Tour\HomeController');
    Route::get('profile/tour-moderate', 'ApiV1\Tour\HomeController@moderate');
    Route::post('profile/tour/multi-upload/{id}', 'ApiV1\Tour\UploadController@multiUploader');
    Route::post('profile/tour/multi-upload/{id}/delete', 'ApiV1\Tour\UploadController@multiUploaderDelete');
    Route::post('profile/tour/upload-avatar/{id}', 'ApiV1\Tour\UploadController@uploadAvatar');
  });


  // helpers
  Route::prefix('helpers')->group(function() {
    Route::get('/all', 'ApiV1\Helpers\HomeController@all');
    // Route::resource('/services', 'ApiV1\Service\HomeController')->only('index');
    // Route::resource('/languagies', 'ApiV1\Language\HomeController')->only('index');
    // Route::resource('/currencies', 'ApiV1\Currency\HomeController')->only('index');
    // Route::resource('/contact_type', 'ApiV1\ContactType\HomeController')->only('index');
    // Route::resource('/categories', 'ApiV1\Category\HomeController')->only('index');
    // Route::resource('/people_category', 'ApiV1\PeopleCategory\HomeController')->only('index');
    // Route::resource('/timing', 'ApiV1\Timing\HomeController')->only('index');
    // Route::resource('/price_type', 'ApiV1\PriceType\HomeController')->only('index');
    // Geo
    Route::get('/city', 'ApiV1\Geo\CityController@index');
    Route::get('/city/id', 'ApiV1\Geo\CityController@id');
  });

  // Frontend (no Auth)
  Route::get('guide/{id}', 'ApiV1\Frontend\GuideController@index');
  Route::get('guide/{id}/tour/{tour}', 'ApiV1\Frontend\GuideController@tour');

  // Fronend catalog
  Route::get('country/{country}/city/{city}/guide', 'ApiV1\Frontend\CatalogController@guide');

  Route::get('country/{country}/city/{city}/{category?}', 'ApiV1\Frontend\CatalogController@tour');

  

});
