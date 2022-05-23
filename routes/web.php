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


// home
Route::get('/get-mess','App\Http\Controllers\HomeController@getMess');

//login
Route::get('/login','App\Http\Controllers\AuthController@login')->name('login');
Route::get('/post-login','App\Http\Controllers\AuthController@postLogin');
Route::get('/logout','App\Http\Controllers\AuthController@logout')->name('logout');



Route::middleware('AuthMiddleware')->group(function () {

    // health
    Route::get('/', function () {
        return view('ex_health.ex_health');
    })->name('Health');;
    Route::get('/list-health','App\Http\Controllers\HealthController@getHealth')->name('getHealth');
    Route::get('/refer-health','App\Http\Controllers\HealthController@referHealth');
    Route::get('/save-health','App\Http\Controllers\HealthController@saveHealth');

    Route::get('/health-pdf','App\Http\Controllers\HealthController@healthPDF')->name('healthPDF');

    //history
    Route::get('/list-history','App\Http\Controllers\HistoryController@getHistory')->name('getHistory');
    Route::get('/paginate-history','App\Http\Controllers\HistoryController@paginateHistory');
    Route::get('/search-history','App\Http\Controllers\HistoryController@searchHistory');
    Route::get('/history-deatal','App\Http\Controllers\HistoryController@detailHistory');
    
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

    // doctor
    Route::get('/list-doctor','App\Http\Controllers\DoctorController@getDoctor')->name('getDoctor');
    Route::get('/add-doctor','App\Http\Controllers\DoctorController@postDoctor');
    Route::get('/put-doctor','App\Http\Controllers\DoctorController@putDoctor');
    Route::get('/get-edit-doctor','App\Http\Controllers\DoctorController@geditDoctor');
    Route::get('/patch-doctor','App\Http\Controllers\DoctorController@patchDoctor');
    Route::get('/paginate-doctor','App\Http\Controllers\DoctorController@paginateDoctor');

    // patient
    Route::get('/list-patient','App\Http\Controllers\PatientController@getPatient')->name('getPatient');
    Route::get('/add-patient','App\Http\Controllers\PatientController@postPatient');
    Route::get('/put-patient','App\Http\Controllers\PatientController@putPatient');
    Route::get('/get-edit-patient','App\Http\Controllers\PatientController@geditPatient');
    Route::get('/patch-patient','App\Http\Controllers\PatientController@patchPatient');
    Route::get('/paginate-patient','App\Http\Controllers\PatientController@paginatePatient');
    

    // user
    Route::post('/add-user','App\Http\Controllers\UserController@addUser')->name('addUser');
    Route::get('/list-user','App\Http\Controllers\UserController@listUser')->name('listUser');
    Route::get('/refer-user','App\Http\Controllers\UserController@referUser');
    Route::post('/edit-user','App\Http\Controllers\UserController@editUser');
    Route::get('/delete-user','App\Http\Controllers\UserController@deletetUser');

    //send mail
    Route::get('/send-mail','App\Http\Controllers\MailController@sendMail')->name('sendMail');
    Route::get('/list-mail','App\Http\Controllers\MailController@listMail')->name('listMail');
});