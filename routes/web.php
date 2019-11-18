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

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/contacts', 'ContactController@index');

    Route::get('/messages/{id}', 'MessageController@show');
    Route::post('/messages', 'MessageController@store');

    Route::patch('/profile',  'ProfileController@update')->name('profile.update');
    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
});
