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

Route::middleware(['LoginSecurity'])->group(function () {

    Route::resource('home', 'HomeController');

    Route::resource('blog', 'BlogController');

    Route::get('/logout', function () {
        session()->flush();
        return redirect('/');
    });

    Route::get('delete/{id}', 'BlogController@destroy');

    // Route::resource('category', 'CategoryController');
    Route::get('category/delete/{id}', 'CategoryController@destroy');

    Route::resource('tags', 'TagsController');
    Route::get('tags/delete/{id}', 'TagsController@destroy');
});



Route::resource('category', 'CategoryController');
