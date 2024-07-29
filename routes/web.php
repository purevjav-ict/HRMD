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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

/*HRM Routes */
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);
// Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);
Route::get('/', function(){ return view('welcome');} );

//Home
Route::get('admin/theme', function(){ return view('theme');} );
Route::get('admin/dashboard', 'App\Http\Controllers\IndexController@index');
Route::get('admin/company/hierarchy', 'App\Http\Controllers\IndexController@tree');
Route::get('admin/settings/system-logs', 'App\Http\Controllers\IndexController@logs');
Route::POST('admin/logs/search', 'App\Http\Controllers\IndexController@logs_search');
Route::get('admin/settings/general', 'App\Http\Controllers\IndexController@settings');
Route::POST('admin/settings/update', 'App\Http\Controllers\IndexController@settingsupd');

/*
| Admin Profile Controller
*/
Route::get('admin/settings/profile', 'App\Http\Controllers\ProfileController@index');
Route::POST('admin/settings/profileUpdate', 'App\Http\Controllers\ProfileController@update');

//Employees
Route::get('admin/emp', 'App\Http\Controllers\admin\EmployeeController@index');
Route::get('admin/emp/create', 'App\Http\Controllers\admin\EmployeeController@create');
Route::post('admin/emp/docreate', 'App\Http\Controllers\admin\EmployeeController@docreate');
Route::get('admin/emp/edit/{param}', 'App\Http\Controllers\admin\EmployeeController@edit');
Route::post('admin/emp/update/', 'App\Http\Controllers\admin\EmployeeController@update');
Route::POST('admin/emp/search', 'App\Http\Controllers\admin\EmployeeController@search');

//Projects
Route::get('admin/projects', 'App\Http\Controllers\admin\ProjectController@index');
Route::get('admin/projects/create', function(){
    return view('Admin/Projects/create');
});
Route::POST('admin/projects/docreate', 'App\Http\Controllers\admin\ProjectController@docreate');
Route::get('admin/projects/edit/{param}', 'App\Http\Controllers\admin\ProjectController@edit');
Route::POST('admin/projects/update/', 'App\Http\Controllers\admin\ProjectController@update');
Route::get('admin/projects/delete/{param}', 'App\Http\Controllers\admin\ProjectController@delete');
Route::POST('admin/projects/search', 'App\Http\Controllers\admin\ProjectController@search');

//Leave
Route::get('admin/leave', 'App\Http\Controllers\admin\LeaveController@index');
Route::get('admin/leave/create', 'App\Http\Controllers\admin\LeaveController@create');
Route::POST('admin/leave/docreate', 'App\Http\Controllers\admin\LeaveController@docreate');
Route::get('admin/leave/edit/{param}', 'App\Http\Controllers\admin\LeaveController@edit');
Route::POST('admin/leave/update/', 'App\Http\Controllers\admin\LeaveController@update');
Route::get('admin/leave/delete/{param}', 'App\Http\Controllers\admin\LeaveController@delete');
Route::POST('admin/leave/search', 'App\Http\Controllers\admin\LeaveController@search');
Route::get('admin/leave/report', function(){
    return view('Admin/Leave/report')->with('data','0');
});
Route::POST('admin/leave/reportprocess', 'App\Http\Controllers\admin\LeaveController@date_report');

//Attendance
Route::get('admin/attendance', 'App\Http\Controllers\admin\AttendanceController@index');
Route::get('admin/attendance/create', 'App\Http\Controllers\admin\AttendanceController@create');
Route::POST('admin/attendance/docreate', 'App\Http\Controllers\admin\AttendanceController@docreate');
Route::get('admin/attendance/edit/{param}', 'App\Http\Controllers\admin\AttendanceController@edit');
Route::POST('admin/attendance/update/', 'App\Http\Controllers\admin\AttendanceController@update');
Route::get('admin/attendance/delete/{param}', 'App\Http\Controllers\admin\AttendanceController@delete');
Route::get('admin/attendance/calendar-view', 'App\Http\Controllers\admin\AttendanceController@full');
Route::POST('admin/attendance/search', 'App\Http\Controllers\admin\AttendanceController@search');
Route::get('admin/attendance/report', function(){
    return view('Admin/Attendance/report')->with('data','0');
});
Route::POST('admin/attendance/reportprocess', 'App\Http\Controllers\admin\AttendanceController@date_report');

//Guest Entry
Route::get('admin/attendance/guests', 'App\Http\Controllers\admin\AttendanceController@guests');
Route::get('admin/attendance/guest-entry', 'App\Http\Controllers\admin\AttendanceController@create');
Route::POST('admin/attendance/guest/docreate', 'App\Http\Controllers\admin\AttendanceController@docreate2');
Route::get('admin/attendance/guest/edit/{param}', 'App\Http\Controllers\admin\AttendanceController@edit2');
Route::POST('admin/attendance/guest/update/', 'App\Http\Controllers\admin\AttendanceController@update2');
Route::POST('admin/guest/search', 'App\Http\Controllers\admin\AttendanceController@guest_search');


//Department
Route::get('admin/company/dept', 'App\Http\Controllers\admin\DeptController@index');
Route::get('admin/company/dept/create', function(){
    return view('Admin/Department/create');
});
Route::POST('admin/dept/docreate', 'App\Http\Controllers\admin\DeptController@docreate');
Route::get('admin/company/dept/edit/{param}', 'App\Http\Controllers\admin\DeptController@edit');
Route::POST('admin/dept/update/', 'App\Http\Controllers\admin\DeptController@update');
Route::get('admin/dept/delete/{param}', 'App\Http\Controllers\admin\DeptController@delete');

//Posting
Route::get('admin/company/posting', 'App\Http\Controllers\admin\PostController@index');
Route::get('admin/posting/create', 'App\Http\Controllers\admin\PostController@create');
Route::POST('admin/posting/docreate', 'App\Http\Controllers\admin\PostController@docreate');
Route::get('admin/company/posting/edit/{param}', 'App\Http\Controllers\admin\PostController@edit');
Route::POST('admin/posting/update/', 'App\Http\Controllers\admin\PostController@update');
Route::get('admin/posting/delete/{param}', 'App\Http\Controllers\admin\PostController@delete');


//Time Sheet
Route::get('admin/timesheet', 'App\Http\Controllers\admin\TimeController@index');
Route::get('admin/timesheet/create', 'App\Http\Controllers\admin\TimeController@create');
Route::POST('admin/timesheet/docreate', 'App\Http\Controllers\admin\TimeController@docreate');
Route::get('admin/timesheet/edit/{param}', 'App\Http\Controllers\admin\TimeController@edit');
Route::POST('admin/timesheet/update/', 'App\Http\Controllers\admin\TimeController@update');
Route::get('admin/timesheet/delete/{param}', 'App\Http\Controllers\admin\TimeController@delete');
Route::POST('admin/timesheet/search', 'App\Http\Controllers\admin\TimeController@search');
Route::get('admin/timesheet/report', function(){
    return view('Admin/Timesheet/report')->with('data','0');
});
Route::POST('admin/timesheet/reportprocess', 'App\Http\Controllers\admin\TimeController@date_report');

//Payroll
Route::get('admin/payroll', 'App\Http\Controllers\admin\PayrollController@index');
Route::POST('admin/payroll/generate', 'App\Http\Controllers\admin\PayrollController@generate');
Route::POST('admin/payroll/savedata', 'App\Http\Controllers\admin\PayrollController@savedata');

/**
    *Payroll
*/
Route::get('admin/payroll/statements', 'App\Http\Controllers\admin\PayrollController@statement');
Route::POST('admin/payroll/statement-view', 'App\Http\Controllers\admin\PayrollController@statementview');
Route::POST('admin/payroll/statements/search', 'App\Http\Controllers\admin\PayrollController@statementsearch');
Route::POST('admin/payroll/statements/filter', 'App\Http\Controllers\admin\PayrollController@statementfilter');

Route::get('admin/payroll/edit/{param}', 'App\Http\Controllers\admin\PayrollController@edit');
Route::POST('admin/payroll/update/', 'App\Http\Controllers\admin\PayrollController@update');


//Employee Login
// Route::POST('employee/login', 'employee\UserController@authenticate');
Route::post('employee/login', 'App\Http\Controllers\employee\LoginController@authenticate');
Route::get('employee/dashboard', 'App\Http\Controllers\employee\UserController@index');
Route::get('employee/leave', 'App\Http\Controllers\employee\UserController@leave');
Route::post('employee/leave/docreate', 'App\Http\Controllers\employee\UserController@doleave');

//Timesheet
Route::get('employee/timesheet', 'App\Http\Controllers\employee\UserController@timesheet');
Route::post('employee/timesheetupd', 'App\Http\Controllers\employee\UserController@dotime');
// Route::post('employee/timesheetupd2', 'App\Http\Controllers\employee\UserController@dotime2');
Route::GET('employee/timesheetupd2', 'App\Http\Controllers\employee\UserController@dotime2');

//Attendance
Route::get('employee/attendance', 'App\Http\Controllers\employee\UserController@attendance');
 Route::GET('employee/attendanceupd', 'App\Http\Controllers\employee\UserController@doentry');
// Route::get('employee/attendanceupd2', 'App\Http\Controllers\employee\UserController@doentry2');
// Route::post('employee/attendanceupd', 'App\Http\Controllers\employee\UserController@doentry');
Route::GET('employee/attendanceupd2', 'App\Http\Controllers\employee\UserController@doentry2');

//Payroll
Route::get('employee/payroll', 'App\Http\Controllers\employee\UserController@payroll');
Route::post('employee/payroll/salaryslip', 'App\Http\Controllers\employee\UserController@statement');

//Appointment letter
Route::get('employee/appointment-letter', 'App\Http\Controllers\employee\UserController@appoint');

//Profile Tools
Route::get('employee/password', 'App\Http\Controllers\employee\UserController@password');
Route::post('employee/passupd', 'App\Http\Controllers\employee\UserController@passupd');
Route::get('employee/profile', 'App\Http\Controllers\employee\UserController@profile');
Route::post('employee/profileupd', 'App\Http\Controllers\employee\UserController@profileupd');
Route::get('employee/idcard', 'App\Http\Controllers\employee\UserController@idcard');
Route::get('employee/logout', 'App\Http\Controllers\employee\UserController@logout');



/* end */



require __DIR__.'/auth.php';
