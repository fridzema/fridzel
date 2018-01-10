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

/*
 web middleware seems to be standard load with al the session an cookie stuff, i move this out of web if there happen strange things when you are developing ;)
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'FrontendController@index')->name('index');
    Route::get('photo/{id}', 'FrontendController@show')->name('photo.show');
});

Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
    Auth::routes();

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/', 'PhotosController@index');
        Route::post('photos/reorder', 'PhotosController@reorder');
        Route::resource('photos', 'PhotosController');
    });
});
