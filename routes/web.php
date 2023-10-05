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
Route::get('/get_user_datatable', 'UserController@getUserDatatable')->name('user.get.datatable');
// route role
Route::resource('role','RoleController');
Route::get('/get_role_json', 'RoleController@getRoleJson')->name('role.get.json');
Route::get('/get_role_datatable', 'RoleController@getRoleDatatable')->name('role.get.datatable');
Route::post('/update_permission_role', 'RoleController@updatePermissionRole')->name('role.update.permission');
Route::GET('/get_permission_role/{id}', 'RoleController@getRolePermission')->name('role.get.permission');
// route permission
Route::resource('permission','PermissionController');
Route::get('/get_permission_datatable', 'PermissionController@getPermissionDatatable')->name('permission.get.datatable');
Route::get('/get_permission_json', 'PermissionController@getPermissionJson')->name('permission.get.json');
