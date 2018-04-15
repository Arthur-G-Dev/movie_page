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

Route::get('/', 'AllMoviesController@getAllMovies')->name('all_movies');
Route::get('addMoviePage', 'AddMovieController@AddMoviePage')->name('add_movie_page')->middleware('auth');
Route::get('loginPage', function(){
   return view('login');
})->name('login_page');


Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');
Route::get('logout', 'UserController@logout')->name('logout');

Route::post('addNewMovie', 'AddMovieController@addMovie')->name('add_new_movie');
Route::get('movieInfo/{movie_id}', 'SingleMovieController@getMovie');