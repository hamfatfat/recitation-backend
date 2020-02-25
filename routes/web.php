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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/api/recitationstep/byrevId/{revId}', 'RecitationStepController@findByRevisionId');
Route::get('/api/step/findByTemplateId/{recId}', 'StepsController@findByTemplateId');
Route::get('/api/step/getAllSteps', 'StepsController@getAllSteps');
Route::get('/api/teachers/findTeacherByCenterId/{centerId}', 'UserController@findTeacherByCenterId');
Route::get('/api/teachers/findAllTeachers', 'UserController@findAllTeachers');
Route::get('/api/studentprogress/findByUserAndStepId/{userId}/{stepId}', 'StudentProgressController@findByUserAndStepId');
Route::prefix('api')->group(function() {
    
    Route::resource('recitationtemplate', 'RecitationTemplateController');
    Route::resource('step', 'StepsController');
    Route::resource('revisionstep', 'RevisionStepController');
    Route::resource('schedule', 'ScheduleController');
    Route::resource('recitationstep', 'RecitationStepController');
    Route::resource('center', 'CenterController');    
    Route::resource('users', 'UserController');
    Route::resource('studentprogress', 'StudentProgressController');
});
