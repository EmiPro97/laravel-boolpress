<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Homepage route
Route::get('/', 'PageController@index')->name('guest.home');


// Authentications routes
Auth::routes();


// Admin routes
Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function () {
        // Index
        Route::get('/', 'HomeController@index')->name('home');

        // CRUD
        Route::resource('posts', 'PostController');
    });
