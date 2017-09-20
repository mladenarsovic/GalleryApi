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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register','Auth\RegisterController@create');
Route::post('login','Auth\LoginController@authenticate');
Route::get('galleries','GalleryController@index');
Route::middleware('jwt.auth')->resource('gallery','GalleryController');
Route::middleware('jwt.auth')->resource('my-gallery','GalleryController@index');
Route::get('search/{term}', 'GalleryController@search');
Route::middleware('jwt.auth')->get('users/{user}/galleries','GalleryController@userGalleries');
Route::middleware('jwt.auth')->resource('users','UsersController');
Route::middleware('jwt.auth')->resource('images','ImagesController');
Route::resource('comments','CommentsController');


Route::middleware('jwt.auth')->get('galleries/{id}', 'GalleriesController@show');
// Route::middleware('jwt.auth')->get('gallery/{id}', 'GalleriesController@show');

// Route::get('/galleries', 'GalleryController@index');

// Route::middleware('jwt')->post('/galleries', 'GalleryController@store');

// Route::middleware('jwt')->get('/galleries/{id}', 'GalleryController@show');

// Route::middleware('jwt')->put('/galleries/{id}', 'GalleryController@update');

// Route::middleware('jwt')->delete('/galleries/{id}', 'GalleryController@destroy') ;

// middleware('jwt.auth')->

// Route::middleware('jwt')->resource('galleries', 'GalleryController');