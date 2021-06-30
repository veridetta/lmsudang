<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/tes', [App\Http\Controllers\HomeController::class, 'tes']);
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	 Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);


	Route::resource('admin_teacher', 'App\Http\Controllers\TeacherController');
	Route::get('admin/teacher/all', 'App\Http\Controllers\TeacherController@getAll')->name('admin_teacher.getAll');
	//IMPORT TEACHER
	Route::get('admin/teacher/import', 'App\Http\Controllers\TeacherController@import')->name('admin_teacher.import');
	Route::post('admin/teacher/import/store', 'App\Http\Controllers\TeacherController@importStore')->name('admin_teacher.importStore');
	Route::post('admin/teacher/import/json', 'App\Http\Controllers\TeacherController@importJson')->name('admin_teacher.importJson');
	//Contoh IMPORT
	Route::get('admin/teacher/import_sample', 'App\Http\Controllers\TeacherController@ExampleExcel')->name('admin_teacher.ExampleExcel');
	Route::get('admin/teacher/change/{id}', 'App\Http\Controllers\TeacherController@edit')->name('admin_teacher.change');
	

	Route::resource('admin_student', 'App\Http\Controllers\StudentController');
	Route::get('admin/student/all', 'App\Http\Controllers\StudentController@getAll')->name('admin_student.getAll');
	//IMPORT Student
	Route::get('admin/student/import', 'App\Http\Controllers\StudentController@import')->name('admin_student.import');
	Route::post('admin/student/import/store', 'App\Http\Controllers\StudentController@importStore')->name('admin_student.importStore');
	Route::post('admin/student/import/json', 'App\Http\Controllers\StudentController@importJson')->name('admin_student.importJson');
	//Contoh IMPORT
	Route::get('admin/student/import_sample', 'App\Http\Controllers\StudentController@ExampleExcel')->name('admin_student.ExampleExcel');
	Route::get('admin/student/change/{id}', 'App\Http\Controllers\StudentController@edit')->name('admin_student.change');

	Route::resource('admin_grade', 'App\Http\Controllers\GradeController');
	Route::get('admin/grade/all', 'App\Http\Controllers\GradeController@getAll')->name('admin_grade.getAll');
	//IMPORT Grade
	Route::get('admin/grade/import', 'App\Http\Controllers\GradeController@import')->name('admin_grade.import');
	Route::post('admin/grade/import/store', 'App\Http\Controllers\GradeController@importStore')->name('admin_grade.importStore');
	Route::post('admin/grade/import/json', 'App\Http\Controllers\GradeController@importJson')->name('admin_grade.importJson');
	//Contoh IMPORT
	Route::get('admin/grade/import_sample', 'App\Http\Controllers\GradeController@ExampleExcel')->name('admin_grade.ExampleExcel');
	Route::get('admin/grade/change/{id}', 'App\Http\Controllers\GradeController@edit')->name('admin_grade.change');

	Route::resource('admin_academic', 'App\Http\Controllers\AcademicController');
	Route::get('admin/academic/all', 'App\Http\Controllers\AcademicController@getAll')->name('admin_academic.getAll');
	//IMPORT Academic
	Route::get('admin/academic/import', 'App\Http\Controllers\AcademicController@import')->name('admin_academic.import');
	Route::post('admin/academic/import/store', 'App\Http\Controllers\AcademicController@importStore')->name('admin_academic.importStore');
	Route::post('admin/academic/import/json', 'App\Http\Controllers\AcademicController@importJson')->name('admin_academic.importJson');
	//Contoh IMPORT
	Route::get('admin/academic/import_sample', 'App\Http\Controllers\AcademicController@ExampleExcel')->name('admin_academic.ExampleExcel');
	Route::get('admin/academic/change/{id}', 'App\Http\Controllers\AcademicController@edit')->name('admin_academic.change');

	Route::resource('admin_academic', 'App\Http\Controllers\AcademicController');
	Route::get('admin/academic/all', 'App\Http\Controllers\AcademicController@getAll')->name('admin_academic.getAll');
	//IMPORT Academic
	Route::get('admin/academic/import', 'App\Http\Controllers\AcademicController@import')->name('admin_academic.import');
	Route::post('admin/academic/import/store', 'App\Http\Controllers\AcademicController@importStore')->name('admin_academic.importStore');
	Route::post('admin/academic/import/json', 'App\Http\Controllers\AcademicController@importJson')->name('admin_academic.importJson');
	//Contoh IMPORT
	Route::get('admin/academic/import_sample', 'App\Http\Controllers\AcademicController@ExampleExcel')->name('admin_academic.ExampleExcel');
	Route::get('admin/academic/change/{id}', 'App\Http\Controllers\AcademicController@edit')->name('admin_academic.change');

	Route::resource('admin_staff', 'App\Http\Controllers\StaffController');
	Route::get('admin/staff/all', 'App\Http\Controllers\StaffController@getAll')->name('admin_staff.getAll');
	//IMPORT Staff
	Route::get('admin/staff/import', 'App\Http\Controllers\StaffController@import')->name('admin_staff.import');
	Route::post('admin/staff/import/store', 'App\Http\Controllers\StaffController@importStore')->name('admin_staff.importStore');
	Route::post('admin/staff/import/json', 'App\Http\Controllers\StaffController@importJson')->name('admin_staff.importJson');
	//Contoh IMPORT
	Route::get('admin/staff/import_sample', 'App\Http\Controllers\StaffController@ExampleExcel')->name('admin_staff.ExampleExcel');
	Route::get('admin/staff/change/{id}', 'App\Http\Controllers\StaffController@edit')->name('admin_staff.change');
	

	Route::resource('admin_schedule', 'App\Http\Controllers\ScheduleController');
	Route::get('admin/schedule/all', 'App\Http\Controllers\ScheduleController@getAll')->name('admin_schedule.getAll');
	Route::get('admin/schedule/todayD', 'App\Http\Controllers\ScheduleController@getToday')->name('admin_schedule.getToday');
	//IMPORT Staff
	Route::get('admin/schedule/import', 'App\Http\Controllers\ScheduleController@import')->name('admin_schedule.import');
	Route::post('admin/schedule/import/store', 'App\Http\Controllers\ScheduleController@importStore')->name('admin_schedule.importStore');
	Route::post('admin/schedule/import/json', 'App\Http\Controllers\ScheduleController@importJson')->name('admin_schedule.importJson');
	//Contoh IMPORT
	Route::get('admin/schedule/import_sample', 'App\Http\Controllers\ScheduleController@ExampleExcel')->name('admin_schedule.ExampleExcel');
	Route::get('admin/schedule/change/{id}', 'App\Http\Controllers\ScheduleController@edit')->name('admin_schedule.change');
	Route::get('admin/schedule/today', 'App\Http\Controllers\ScheduleController@today')->name('admin_schedule.today');
	Route::post('admin/schedule/start', 'App\Http\Controllers\ScheduleController@start')->name('admin_schedule.start');
	Route::get('admin/schedule/getDetail/{id}', 'App\Http\Controllers\ScheduleController@getDetail')->name('admin_schedule.getDetail');
	Route::get('admin/schedule/attDetail/{id}', 'App\Http\Controllers\ScheduleController@attDetail')->name('admin_schedule.attDetail');
});

