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
    return view('main');
});
Route::get('/ajax/major', "ajaxController@majorList");
Route::get('/ajax/branch/{major_id}', "ajaxController@branchList");
Route::get('/ajax/course/{branch_id}', "ajaxController@courseList");
Route::post('/ajax/course/validation', "ajaxController@courseValidation");
Route::get('/test', "masterController@test");
