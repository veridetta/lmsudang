<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(['middleware' => 'teacher'], function () {
    Route::get('/', 'App\Http\Controllers\TeacherPageController@login')->name('teacher.login');
    Route::post('/', 'App\Http\Controllers\TeacherPageController@loginCheck')->name('loginCheck');
    Route::get('/dashboard', 'App\Http\Controllers\TeacherPageController@dashboard')->name('teacher.dashboard');
    Route::post('/startAttendance', 'App\Http\Controllers\TeacherPageController@startAttendance')->name('teacher.startAttendance');
    Route::get('/sc/all', 'App\Http\Controllers\TeacherPageControllerAjax@getScAll')->name('getScAll');
});
