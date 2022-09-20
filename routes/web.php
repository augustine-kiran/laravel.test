<?php

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

Route::get('/', 'HomeController@index');

Route::middleware(['auth'])->group(function () {
    Route::resource('tags', 'TagsController');
    Route::resource('blog', 'BlogController');
    Route::resource('user', 'UserController');
    Route::resource('category', 'CategoryController');
});

Route::resource('login', 'LoginController');
Route::get('login', 'LoginController@index')->name('login');
Route::get('logout', 'LoginController@logout');
