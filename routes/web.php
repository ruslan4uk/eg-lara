<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::prefix('/mails')->group(function () {
//
//    Route::get('/confirm', function () {
//        return view('mails.confirm', ['name' => 'Ruslan']);
//    });
//
//    Route::get('/password-recover', function () {
//        return view('mails.password-recover', ['name' => 'Ruslan']);
//    });
//
//    Route::get('/moderate-success', function () {
//        return view('mails.moderate-success', ['name' => 'Ruslan']);
//    });
//
//    Route::get('/moderate-tour-success', function () {
//        return view('mails.moderate-tour-success', ['name' => 'Ruslan']);
//    });
//
//    Route::get('/moderate-tour', function () {
//        return view('mails.moderate-tour', ['name' => 'Ruslan']);
//    });
//
//});
