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

Route::get('/', 'Frontend\HomeController@index');
Route::post('/', 'Frontend\HomeController@index_post');
Route::get('/user', 'Frontend\HomeController@users');
Route::post('/register', 'Frontend\HomeController@register');
Route::post('/login-frontend', 'Auth\LoginController@loginFrontend');
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/thong-tin-user', 'Frontend\HomeController@userInfo');
Route::post('/update-info-user', 'Frontend\HomeController@updateUserInfo');
Route::post('/change-password', 'Frontend\HomeController@changePassword');
Route::get('/tin-tuc', 'Frontend\HomeController@news');
Route::get('/tin-tuc/{id}/{name}', 'Frontend\HomeController@newsDetail');
Route::get('/bai-dang/{id}/{name}', 'Frontend\HomeController@postDetail');
Route::get('/dang-tin-free', 'Frontend\HomeController@freePost');

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
    Route::post('/pubbaiviet', 'Admin\BaivietController@pub_bai_viet');
    Route::post('/save_bai_viet', 'Admin\BaivietController@save_bai_viet');
    Route::post('/tool/dhtmlxform_image', 'Admin\ToolController@dhtmlxform_image');
    Route::get('/tool/dhtmlxform_image', 'Admin\ToolController@dhtmlxform_image');

    Route::get('/posts', 'Admin\BaivietController@index');
    Route::get('/news', 'Admin\NewsController@index');
    Route::get('/getnews', 'Admin\NewsController@get_news');
    Route::get('/save_news', 'Admin\NewsController@save_news');
//    Route::get('/tool/dhtmlxform_image/{id}', function ($id) {
//
//    })->where('id', '[0-9]+');
});

