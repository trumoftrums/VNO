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

Route::get('/', 'HomeController@index');
Route::get('/user', 'HomeController@users');
Route::post('/register', 'HomeController@register');
Route::post('/login-frontend', 'Auth\LoginController@loginFrontend');

Route::get('/about', 'AboutController@index');

Route::group(['prefix' => 'admin'], function()
{
    // Controllers Within The "App\Http\Controllers\Admin" Namespace
    Route::get('/dashboard', 'Admin\DashboardController@index');
    Route::get('/', 'Admin\DashboardController@index');
    Route::get('/login', 'Auth\LoginController@login');
    Route::post('/login', 'Auth\LoginController@login');
    Route::get('/getbaiviet', 'Admin\BaivietController@get_bai_viet');
    Route::post('/getbaiviet', 'Admin\BaivietController@get_bai_viet');
    Route::post('/save_bai_viet', 'Admin\BaivietController@save_bai_viet');
});

