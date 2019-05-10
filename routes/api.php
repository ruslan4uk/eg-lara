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
  Route::middleware('jwt')->group(function() {
    Route::resource('profile', 'ApiV1\User\HomeController')->only('index', 'store');
  });
});
