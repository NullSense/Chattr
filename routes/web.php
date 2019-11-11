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

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', 'AdminController@renderAdminView')->name('admin');
        Route::post('/addUniversity', 'AdminController@addNewUniversity');
        Route::post('/addFaculty', 'AdminController@addNewFaculty');
        Route::post('/addStudies', 'AdminController@addNewStudies');
        Route::post('/addCurriculum', 'AdminController@addNewCurriculum');
    });

    Route::get('/moderator', 'ModeratorController@rendeModeratorView')->name('moderator');
    Route::get('/user/{id}', 'AdminController@renderUserView');
    Route::get('/upload', 'UploadController@renderUploadView')->name('upload');
    Route::post('/upload', 'UploadController@uploadDocument');

    Route::group(['prefix' => 'document'], function () {
        Route::get('/{id}', 'DocumentController@downloadDocument');
        Route::get('/delete/{id}', 'DocumentController@deleteDocument');
    });
});
