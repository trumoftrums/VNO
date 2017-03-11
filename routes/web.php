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
Route::get('/home', 'Frontend\HomeController@index');
Route::post('/', 'Frontend\HomeController@index');
Route::get('/user', 'Frontend\HomeController@users');
Route::post('/register', 'Frontend\HomeController@register');
Route::post('/login-frontend', 'Auth\LoginController@loginFrontend');
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/thong-tin-user', 'Frontend\HomeController@userInfo');
Route::post('/update-info-user', 'Frontend\HomeController@updateUserInfo');
Route::post('/change-password', 'Frontend\HomeController@changePassword');
Route::get('/tin-tuc', 'Frontend\HomeController@news');
Route::get('/tin-tuc/{id}/{name}', 'Frontend\HomeController@newsDetail');

Route::get('/thong-tin-cuu-ho/{city}', 'Frontend\ServiceController@supportCar');
Route::get('/bai-giu-xe/{city}', 'Frontend\ServiceController@baiGiuXe');

Route::get('/do-xe-uy-tin/{city}', 'Frontend\ServiceController@designCar');
Route::get('/do-xe-uy-tin/{id}/{name}', 'Frontend\ServiceController@designCarDetail');

Route::get('/vip-salon/{city}', 'Frontend\ServiceController@vipSalon');
Route::get('/vip-salon/{id}/{name}', 'Frontend\ServiceController@vipSalonDetail');

Route::get('/dich-vu-huong-dan', 'Frontend\ServiceController@serviceGuide');
Route::get('/bai-dang/{id}/{name}', 'Frontend\HomeController@postDetail');
Route::get('/dang-tin-free', 'Frontend\HomeController@freePost');
Route::post('/dang-tin-free', 'Frontend\HomeController@freePost');
Route::get('/dang-tin-free/{id_slug}', 'Frontend\HomeController@freePost');
Route::post('/dang-tin-free/{id_slug}', 'Frontend\HomeController@freePost');
Route::post('/upload-avatar', 'Frontend\HomeController@uploadAvatar');

Route::post('/baiviet/save_bai_viet', 'Frontend\HomeController@save_bai_viet');
Route::post('/getdongxe', 'Frontend\HomeController@getdongxe');
Route::post('/getloaibaiviet', 'Frontend\HomeController@getLoaiBaiViet');
Route::post('/changecaptcha', 'Frontend\HomeController@changecaptcha');
//Route::get('/eidt-baiviet/{id}', 'Frontend\HomeController@edit_freePost');

Route::post('/baiviet/uploadimg', 'Admin\BaivietController@uploadimg');
//Route::get('/get_thongso_init', 'Frontend\HomeController@get_thongso_init');
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
    Route::post('/getnewsedit', 'Admin\NewsController@getnewsedit');
    Route::get('/getnews', 'Admin\NewsController@get_news');
    Route::post('/delnews', 'Admin\NewsController@del_news');
    Route::post('/save_news', 'Admin\NewsController@save_news');
    Route::get('/baiviet/get_total_news', 'Admin\BaivietController@get_total_news');


    Route::get('/users', 'Admin\UsersController@index');
    Route::get('/getusers', 'Admin\UsersController@get_news');
    Route::post('/getuserinfo', 'Admin\UsersController@get_user_info');
    Route::post('/tool/dhtmlxform_photo_user', 'Admin\ToolController@dhtmlxform_photo_user');
    Route::get('/tool/dhtmlxform_photo_user', 'Admin\ToolController@dhtmlxform_photo_user');



//    Route::get('/tool/dhtmlxform_image/{id}', function ($id) {
//
//    })->where('id', '[0-9]+');
});

