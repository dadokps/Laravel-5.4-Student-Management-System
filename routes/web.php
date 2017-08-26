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
    Route::get('/manage/course/classInfo', ['as' => 'showClassInfo', 'uses' => 'CourseController@showClassInfo']);
    Route::post('/manage/course/class-delete', ['as' => 'deleteClass', 'uses' => 'CourseController@deleteClass']);
    Route::get('/manage/course/class-edit', ['as' => 'editClass', 'uses' => 'CourseController@editClass']);
    Route::post('/manage/course/class-update', ['as' => 'updateClassInfo', 'uses' => 'CourseController@updateClassInfo']);

    // Student Controller
    Route::get('/student/register', ['as' => 'getStudentRegister', 'uses' => 'StudentController@getStudentRegister']);
    Route::post('/student/postRegister', ['as' => 'postStudentRegister', 'uses' => 'StudentController@postStudentRegister']);

    // Fee Controller
    Route::get('/student/show/payment', ['as' => 'getPayment', 'uses' => 'FeeController@getPayment']);
    Route::get('/student/payment', ['as' => 'showStudentPayment', 'uses' => 'FeeController@showStudentPayment']);
    Route::get('/student/go/to/payment/{student_id}', ['as' => 'goPayment', 'uses' => 'FeeController@goPayment']);
    Route::post('/student/payment/save', ['as' => 'savePayment', 'uses' => 'FeeController@savePayment']);
    Route::post('/fee/create', ['as' => 'createFee', 'uses' => 'FeeController@createFee']);
    Route::get('/fee/student/pay', ['as' => 'pay', 'uses' => 'FeeController@pay']);
    Route::post('/fee/student/extraPay', ['as' => 'extraPay', 'uses' => 'FeeController@extraPay']);
    Route::get('/fee/student/print/invoice/{receipt_id}', ['as' => 'printInvoice', 'uses' => 'FeeController@printInvoice']);
    Route::get('/fee/student/transaction/delete/{transact_id}', ['as' => 'deleteTransaction', 'uses' => 'FeeController@deleteTransaction']);
    Route::get('/fee/student/show/level', ['as' => 'showStudentLevel', 'uses' => 'FeeController@showStudentLevel']);

    //for testing only
    Route::get('/create/student/level', ['as' => 'createStudentLevel', 'uses' => 'FeeController@createStudentLevel']);

    // Student Report
    Route::get('/report/student-list', ['as' => 'getStudentList', 'uses' => 'ReportController@getStudentList']);
    Route::get('/report/student-info', ['as' => 'showStudentInfo', 'uses' => 'ReportController@showStudentInfo']);



});