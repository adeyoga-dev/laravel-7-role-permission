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
// route permission
Route::resource('permission','PermissionController');
Route::get('/get_permission_datatable', 'PermissionController@getPermissionDatatable')->name('permission.get.datatable');
