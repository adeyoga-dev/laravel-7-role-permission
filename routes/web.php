<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
//route home
Route::get('home', 'HomeController@index')->name('home');
// route user
Route::resource('user','UserController');
Route::get('/get_user_datatable', 'UserController@getUserDatatable')->name('user.get.datatable');
// route role
Route::resource('role','RoleController');
Route::get('/get_role_json', 'RoleController@getRoleJson')->name('role.get.json');
Route::get('/get_role_datatable', 'RoleController@getRoleDatatable')->name('role.get.datatable');
