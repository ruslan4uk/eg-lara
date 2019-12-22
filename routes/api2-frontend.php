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
    Route::get('/city-list/{country_id}', 'Search\GeoController@cityList');
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
Route::prefix('/profile')->middleware('jwt:api')->group(function() {
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

    /**
     * Profile favorite list
     */
    Route::get('/favorite/list', 'Frontend\FavoriteController@getFavoriteList');
});

/**
 * Frontend routers
 */
Route::prefix('/front')->group(function() {
   Route::get('/main', 'Frontend\MainController@index');

   Route::get('/user/{id}', 'Frontend\UserController@showUserInfo');
   Route::get('/user/{id}/excursions', 'Frontend\UserController@showUserTours');

   Route::get('/user/{id}/responses', 'Frontend\UserController@showUserResponses');
   Route::post('/user/{id}/responses', 'Frontend\UserController@saveUserResponses');

   Route::get('/excursion/{id}', 'Frontend\TourController@getUserExcursion');

   Route::get('/get/tour/{country}/{city}', 'Frontend\SearchController@searchTour');
   Route::get('/get/guide/{country}/{city}', 'Frontend\SearchController@searchGuide');

   // Favorite routes
   Route::post('/favorite/add', 'Frontend\FavoriteController@addFavoriteTour');
   Route::post('/favorite/delete', 'Frontend\FavoriteController@deleteFavoriteTour');
});


/**
 * Messenger api route
 * ->middleware('jwt:api')
 */
Route::prefix('messenger')->group(function() {

    Route::get('/unread', 'Messenger\MessageController@unreadCount');

    Route::middleware('jwt:api')->group(function() {
        Route::get('/dialogs', 'Messenger\DialogController@index');                                  // Список всех диалогов
        Route::get('/messages/{dialog_uid}/{last_id?}', 'Messenger\MessageController@show');         // Список сообщений определенного диалога

        Route::post('/send', 'Messenger\MessageController@create');

        Route::post('/new', 'Messenger\MessageController@create');

        // Upload files and photos
        Route::post('/upload', 'Messenger\UploadController@uploadFiles');
    })  ;

});

Route::get('sitemap', 'Frontend\SitemapController@index');
