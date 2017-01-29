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
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/thong-tin-user', 'HomeController@userInfo');

Route::group(['prefix' => 'admin'], function()
{
    // Controllers Within The "App\Http\Controllers\Admin" Namespace
    Route::get('/dashboard', 'Admin\DashboardController@index');
    Route::get('/', 'Admin\DashboardController@index');
    Route::get('/login', 'Auth\LoginController@login');
    Route::post('/login', 'Auth\LoginController@login');
    Route::get('/getbaiviet', 'Admin\BaivietController@get_bai_viet');
    Route::post('/getbaiviet', 'Admin\BaivietController@get_bai_viet');
    Route::post('/getbaivietedit', 'Admin\BaivietController@get_bai_viet_edit');
    Route::post('/delbaiviet', 'Admin\BaivietController@del_bai_viet');
    Route::post('/save_bai_viet', 'Admin\BaivietController@save_bai_viet');
    Route::post('/tool/dhtmlxform_image', 'Admin\ToolController@dhtmlxform_image');
    Route::get('/tool/dhtmlxform_image', 'Admin\ToolController@dhtmlxform_image');
//    Route::get('/tool/dhtmlxform_image/{id}', function ($id) {
//
//    })->where('id', '[0-9]+');
});

