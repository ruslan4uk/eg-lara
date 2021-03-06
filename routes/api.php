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
  // Sitemap
  Route::get('/sitemap', 'ApiV1\Sitemap\HomeController@index');
  // Auth
  Route::prefix('auth')->group(function() {
    Route::post('/register', 'ApiV1\Auth\AuthController@register');
    Route::post('/login', 'ApiV1\Auth\AuthController@login');
    Route::post('/logout', 'ApiV1\Auth\AuthController@logout');
    Route::post('/me', 'ApiV1\Auth\AuthController@me');
    Route::post('/confirm', 'ApiV1\Auth\AuthController@confirm');
    Route::post('/change-password', 'ApiV1\Auth\AuthController@changePassword');
  });

  Route::get('/profile', 'ApiV1\User\HomeController@index');

  // User cabinet (jwt token guard)
  Route::middleware('jwt:api')->group(function() {
    // Profile route
    Route::resource('profile', 'ApiV1\User\HomeController')->only('store');
    Route::post('profile/multi-upload', 'ApiV1\User\UploadController@multiUploader');
    Route::post('profile/multi-upload/delete', 'ApiV1\User\UploadController@multiUploaderDelete');
    Route::post('profile/upload-avatar', 'ApiV1\User\UploadController@uploadAvatar');
    // Tour route
    Route::resource('profile/tour', 'ApiV1\Tour\HomeController');
    Route::get('profile/tour-moderate', 'ApiV1\Tour\HomeController@moderate');
    Route::post('profile/tour/multi-upload/{id}', 'ApiV1\Tour\UploadController@multiUploader');
    Route::post('profile/tour/multi-upload/{id}/delete', 'ApiV1\Tour\UploadController@multiUploaderDelete');
    Route::post('profile/tour/upload-avatar/{id}', 'ApiV1\Tour\UploadController@uploadAvatar');

    Route::post('guide/{id}/comment', 'ApiV1\Frontend\GuideController@addComment');

    // favorite
    Route::get('profile/favorite-guide', 'ApiV1\Favorite\HomeController@favoriteGuide');
    Route::post('profile/favorite-guide', 'ApiV1\Favorite\HomeController@deleteFavoriteGuide');
    Route::post('profile/favorite-guide-add', 'ApiV1\Favorite\HomeController@addFavoriteGuide');

    Route::get('profile/favorite-tour', 'ApiV1\Favorite\HomeController@favoriteTour');
    Route::post('profile/favorite-tour', 'ApiV1\Favorite\HomeController@deleteFavoriteTour');
    Route::post('profile/favorite-tour-add', 'ApiV1\Favorite\HomeController@addFavoriteTour');

    // Tourist route
    Route::resource('trstprofile', 'ApiV1\TrstProfile\UserController')->only('store');

  });


  // helpers
  Route::prefix('helpers')->group(function() {
    Route::get('/all', 'ApiV1\Helpers\HomeController@all');
    // Geo
    Route::get('/city', 'ApiV1\Geo\CityController@index');
    Route::get('/city/id', 'ApiV1\Geo\CityController@id');
  });

  // Frontend (no Auth)
  Route::get('guide/{id}', 'ApiV1\Frontend\GuideController@index');
  Route::get('guide/{id}/tour/{tour}', 'ApiV1\Frontend\GuideController@tour');
  // Article
  Route::get('article/{id}', 'ApiV1\Frontend\ArticleController@index');

  // Fronend catalog
  Route::get('country/{country}/city/{city}/guide', 'ApiV1\Frontend\CatalogController@guide');

  Route::get('country/{country}/city/{city}/article', 'ApiV1\Frontend\CatalogController@article');

  Route::get('country/{country}/city/{city}/{category?}', 'ApiV1\Frontend\CatalogController@tour');

  // Frontend country
  Route::get('country/{id}', 'ApiV1\Frontend\CountryController@index');




  // Admin
  Route::prefix('admin')->group(function() {
    Route::get('/city', 'ApiV1\Geo\CityController@index');
    Route::get('/city/id', 'ApiV1\Geo\CityController@id');
    // Auth
    Route::post('/auth/logout', 'ApiV1\Auth\AuthController@logout');
    Route::post('/auth/me', 'ApiV1\Auth\AuthController@me');
    Route::post('/auth/admin-login', 'ApiV1\Admin\AuthController@login');

    Route::middleware(['role:admin', 'jwt:api'])->group(function() {
      Route::get('/dashboard', 'ApiV1\Admin\DashboardController@index');
      Route::resource('/guides', 'ApiV1\Admin\GuideController');
      Route::resource('/tours', 'ApiV1\Admin\TourController');
      Route::resource('/comments', 'ApiV1\Admin\CommentController');

      Route::post('/articles/{id}/upload', 'ApiV1\Admin\ArticleController@uploadAvatar');
      Route::resource('/articles', 'ApiV1\Admin\ArticleController');
    });
  });

  /**
   * Messenger api route
   */
  Route::prefix('messenger')->middleware('jwt:api')->group(function() {

      Route::get('/dialogs', 'ApiV1\Messenger\DialogController@index');                                  // Список всех диалогов
      Route::get('/messages/{dialog_uid}/{last_id?}', 'ApiV1\Messenger\MessageController@show');         // Список сообщений определенного диалога

      Route::post('/messages', 'ApiV1\Messenger\MessageController@create');

      Route::post('/new', 'ApiV1\Messenger\MessageController@newMessage');

      // Upload files and photos
      Route::post('/upload', 'ApiV1\Messenger\UploadController@uploadFiles');

  });

});
