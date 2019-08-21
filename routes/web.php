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
    return view('twitter.index');
});

Route::get('/twitter/twitter', 'Auth\LoginController@twitter');
Route::get('/login/callback', 'Auth\LoginController@callback'); 
Route::get('/index.php', 'Auth\LoginController@index');
Route::get('/login', 'Auth\LoginController@twitter')->name('login');

Route::get('/photos/', 'PhotoController@index');
Route::post('/photos/show', 'PhotoController@show');
Route::post('/photos/download', 'PhotoController@download');

Route::get('/posts/', 'PostController@index');
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/error/', 'PhotoController@error');
Route::get('/index/', function() {
        return view('index');
});
