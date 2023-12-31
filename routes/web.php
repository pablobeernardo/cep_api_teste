<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/home', 'HomeController@index')->name('home');
Route::put('/user/{id}', 'HomeController@updateUser')->name('user.update');
Route::get('/data-user', 'HomeController@getDataUser')->name('data.user');
Route::get('/user/image/{filename}', 'HomeController@getImage')->name('user.image');