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

Route::get('/', ['as' => '/', 'uses' => 'LoginController@getLogin']);
Route::post('/login', ['as' => 'login', 'uses' => 'LoginController@postLogin']);

Route::get('/noPermission', function (){
    return view('permission.permission');
});

Route::group(['middleware' => ['authen']], function () {
    Route::get('/logout', ['as' => 'logout', 'uses' => 'LoginController@getLogout']);
    Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@dashboard']);
});

Route::group(['middleware' => ['authen', 'roles'], 'roles' => ['admin']], function () {
    Route::get('/manage/course', ['as' => 'manageCourse', 'uses' => 'CourseController@getManageCourse']);
    Route::post('/manage/course/insert-academic', ['as' => 'postInsertAcademic', 'uses' => 'CourseController@postInsertAcademic']);
    Route::post('/manage/course/insert-program', ['as' => 'postInsertProgram', 'uses' => 'CourseController@postInsertProgram']);
    Route::post('/manage/course/insert-level', ['as' => 'postInsertLevel', 'uses' => 'CourseController@postInsertLevel']);
    Route::get('/manage/course/showLevel', ['as' => 'showLevel', 'uses' => 'CourseController@showLevel']);
    Route::post('/manage/course/insert-shift', ['as' => 'postInsertShift', 'uses' => 'CourseController@postInsertShift']);
    Route::post('/manage/course/insert-time', ['as' => 'postInsertTime', 'uses' => 'CourseController@postInsertTime']);
    Route::post('/manage/course/insert-batch', ['as' => 'postInsertBatch', 'uses' => 'CourseController@postInsertBatch']);
    Route::post('/manage/course/insert-group', ['as' => 'postInsertGroup', 'uses' => 'CourseController@postInsertGroup']);
    Route::post('/manage/course/create-class', ['as' => 'postCreateClass', 'uses' => 'CourseController@postCreateClass']);

});