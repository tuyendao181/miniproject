<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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
    return view('system.list_library');
});
// home
Route::get('/get-mess','App\Http\Controllers\HomeController@getMess');
// library
Route::get('/list-library','App\Http\Controllers\LibraryController@getLibrary')->name('getLibrary');
Route::get('/add-library','App\Http\Controllers\LibraryController@postLibrary');
Route::get('/put-library','App\Http\Controllers\LibraryController@putLibrary');
Route::get('/get-edit-library','App\Http\Controllers\LibraryController@geditLibrary');
Route::get('/patch-library','App\Http\Controllers\LibraryController@patchLibrary');

// user
Route::post('/add-user','App\Http\Controllers\UserController@addUser')->name('addUser');
Route::get('/list-user','App\Http\Controllers\UserController@listUser');


Route::get('/login','App\Http\Controllers\AuthController@login');
Route::get('/post-login','App\Http\Controllers\AuthController@postLogin');
Route::get('/logout','App\Http\Controllers\AuthController@logout');



