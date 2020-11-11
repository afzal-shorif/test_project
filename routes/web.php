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

Route::get('/home', 'App\Http\Controllers\Home@index')->middleware('check_login');
Route::get('/download/{filename}','App\Http\Controllers\Home@download')->middleware('check_login');
Route::get('/add_to_cart/{page}/{file_id}','App\Http\Controllers\Home@add_to_cart')->middleware('check_login');
Route::get('/cart','App\Http\Controllers\Home@cart')->middleware('check_login');
Route::get('/remove_to_cart/{file_id}','App\Http\Controllers\Home@remove_to_cart')->middleware('check_login');
Route::get('/logout','App\Http\Controllers\Home@logout')->middleware('check_login');
Route::get('/cart_confirm','App\Http\Controllers\Home@cart_confirm')->middleware('check_login');

Route::get('/login', 'App\Http\Controllers\Authorization@index');
Route::post('/check_login', 'App\Http\Controllers\Authorization@check_login');
