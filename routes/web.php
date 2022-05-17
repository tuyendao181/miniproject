<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\AuthMiddleware;

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

//login
Route::get('/login','App\Http\Controllers\AuthController@login')->name('login');
Route::get('/post-login','App\Http\Controllers\AuthController@postLogin');
Route::get('/logout','App\Http\Controllers\AuthController@logout');



Route::middleware('AuthMiddleware')->group(function () {
    // library
    Route::get('/list-library','App\Http\Controllers\LibraryController@getLibrary')->name('getLibrary');
    Route::get('/add-library','App\Http\Controllers\LibraryController@postLibrary');
    Route::get('/put-library','App\Http\Controllers\LibraryController@putLibrary');
    Route::get('/get-edit-library','App\Http\Controllers\LibraryController@geditLibrary');
    Route::get('/patch-library','App\Http\Controllers\LibraryController@patchLibrary');
    Route::get('/paginate-library','App\Http\Controllers\LibraryController@paginateLibrary');

    // medicines
    Route::get('/list-medicines','App\Http\Controllers\MedicinesController@getMedicines')->name('getMedicines');
    Route::get('/add-medicines','App\Http\Controllers\MedicinesController@postMedicines');
    Route::get('/put-medicines','App\Http\Controllers\MedicinesController@putMedicines');
    Route::get('/get-edit-medicines','App\Http\Controllers\MedicinesController@geditMedicines');
    Route::get('/patch-medicines','App\Http\Controllers\MedicinesController@patchMedicines');
    Route::get('/paginate-medicines','App\Http\Controllers\MedicinesController@paginateMedicines');

    // service
    Route::get('/list-service','App\Http\Controllers\ServiceController@getService')->name('getService');
    Route::get('/add-service','App\Http\Controllers\ServiceController@postService');
    Route::get('/put-service','App\Http\Controllers\ServiceController@putService');
    Route::get('/get-edit-service','App\Http\Controllers\ServiceController@geditService');
    Route::get('/patch-service','App\Http\Controllers\ServiceController@patchService');
    Route::get('/paginate-service','App\Http\Controllers\ServiceController@paginateService');

    // user
    Route::post('/add-user','App\Http\Controllers\UserController@addUser')->name('addUser');
    Route::get('/list-user','App\Http\Controllers\UserController@listUser');
});