<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});
// route auth
Auth::routes();
// route home
Route::get('home', 'HomeController@index')->name('home');
// route user
Route::resource('user','UserController');
Route::get('get-user-datatable', 'UserController@getUserDatatable')->name('user.get.datatable');
// route role
Route::resource('role','RoleController');
Route::get('get-role-json', 'RoleController@getRoleJson')->name('role.get.json');
Route::get('get-role-datatable', 'RoleController@getRoleDatatable')->name('role.get.datatable');
Route::post('update-permission-role', 'RoleController@updatePermissionRole')->name('role.update.permission');
Route::GET('get-permission-role/{id}', 'RoleController@getRolePermission')->name('role.get.permission');
// route permission
Route::resource('permission','PermissionController');
Route::get('get-permission-datatable', 'PermissionController@getPermissionDatatable')->name('permission.get.datatable');
Route::get('get-permission-json', 'PermissionController@getPermissionJson')->name('permission.get.json');
// route profile
Route::resource('profile','ProfileController');
Route::post('update-password-profile','ProfileController@updatePassword')->name('profile.update.password');
Route::post('send-email-profile','ProfileController@sendEmail')->name('profile.send.email');
// email

