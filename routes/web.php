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

Route::get('/', 'Auth\LoginController@showLoginForm');
 
Auth::routes();

/* my routes */
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/index', 'ReportsController@index');

Route::get('/verifyEmailFirst', 'Auth\RegisterController@verifyEmailFirst')->name('verifyEmailFirst');
Route::get('verify/{email}/{verifyToken}', 'Auth\RegisterController@sendEmailDone')->name('sendEmailDone');

// Route::get('/admin/home', 'AdminController@index');

// Route::get('/admin/editor', 'EditorController@index');
// Route::get('/admin/test', 'EditorController@test');

// Route::get('admin', 'Admin\LoginController@showLoginForm');
// Route::get('admin/login', 'Admin\LoginController@showLoginForm');
// Route::post('admin/login', 'Admin\LoginController@login')->name('admin.login');
// Route::post('admin/logout', 'Admin\LoginController@logout')->name('admin.logout');

// Registration Routes...
Route::get('admin/register', 'Admin\RegisterController@showRegistrationForm')->name('admin.register');
Route::post('admin/register', 'Admin\RegisterController@register');

// Password Reset Routes...
Route::get('admin/password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin/password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin/password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('admin/password/reset', 'Admin\ResetPasswordController@reset');

Route::get('/departments', 'DepartmentsController@index');
Route::get('/departments/print', 'DepartmentsController@print');
Route::post('/departments', 'DepartmentsController@store');
Route::get('departments/{department}', 'DepartmentsController@view');
Route::put('departments/{department}', 'DepartmentsController@update');
Route::post('/subDepartments', 'DepartmentsController@store');
Route::delete('departments/{department}', 'DepartmentsController@destroy');

Route::get('/files', 'FilesController@index');
Route::get('/files/me', 'FilesController@index');
Route::get('/files/all', 'FilesController@all');
Route::get('/files/print', 'FilesController@print');
Route::get('/files/print/all', 'FilesController@printAll');
Route::post('/files', 'FilesController@store');
//Route::get('/files/modify/{files}', 'FilesController@modify');
Route::post('/files/newFolder', 'FilesController@newFolder');
Route::post('/files/openFolder', 'FilesController@openFolder');
Route::post('/files/paste', 'FilesController@copyPaste');
Route::get('/download/{file_name}', 'FilesController@download');
Route::post('/files/rename', 'FilesController@rename');
Route::post('/files/send', 'FilesController@send');
Route::get('/files/cat/{type}', 'FilesController@fileType');
Route::delete('/files', 'FilesController@destroy');

Route::get('/projects', 'ProjectsController@index');
Route::get('/projects/print', 'ProjectsController@print');
Route::get('/projects/print/all', 'ProjectsController@printAll');
Route::post('/projects', 'ProjectsController@store')->name('projects');
Route::get('/projects/{project}', 'ProjectsController@view');
Route::delete('/projects/', 'ProjectsController@destroy');

Route::get('/employees', 'EmployeesController@index');
Route::get('/employees/print', 'EmployeesController@print');
Route::POST('/employees', 'EmployeesController@store');
Route::get('/employees/{employee}', 'EmployeesController@view');
Route::get('/employees/edit/{employee}', 'EmployeesController@view');
Route::put('/employees/{id}', 'EmployeesController@update');
Route::delete('/employee/{employee}', 'EmployeesController@delete');

Route::get('/reports', 'ReportsController@index');


Route::get('/tasks', 'TasksController@index');
Route::get('/tasks/print', 'TasksController@print');
Route::get('/tasks/dropdown', 'TasksController@dropdown');
Route::get('/tasks/read/{id}', 'TasksController@taskIsRead');
Route::post('/tasks', 'TasksController@store');
Route::put('/tasks/complete/{id}', 'TasksController@complete');
Route::delete('/tasks', 'TasksController@destroy');
Route::get('/tasks/getUsers/{id}', 'TasksController@getUsers');

Route::get('/messages', 'MessagesController@index');
Route::get('/messages/print', 'MessagesController@print');
Route::get('/messages/read/{id}', 'MessagesController@messageIsRead');
Route::post('/messages', 'MessagesController@store');
Route::delete('/messages', 'MessagesController@destroy');
// Route::get('/messages', function () {
// 	$nexmo = app('Nexmo\Client');

// 	$nexmo->message()->send([
// 	    'to'   => '254703249349',
// 	    'from' => 'Idcs',
// 	    'text' => 'Check your status for change.'
// 	]);
// });