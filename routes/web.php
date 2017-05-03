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
Route::post('/forgot-password', 'Auth\ForgotPasswordController@index');

Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/thong-tin-user', 'Frontend\HomeController@userInfo');
Route::post('/update-info-user', 'Frontend\HomeController@updateUserInfo');
Route::post('/change-password', 'Frontend\HomeController@changePassword');
Route::get('/tin-tuc', 'Frontend\HomeController@news');
Route::get('/videos-xe-oto', 'Frontend\HomeController@videos');
Route::get('/videos-xe-oto/{catID}', 'Frontend\HomeController@videos');

Route::get('/tin-tuc/{id}/{name}', 'Frontend\HomeController@newsDetail');

Route::get('/lien-he', 'Frontend\HomeController@contact');
Route::post('/send-email-contact', 'Frontend\HomeController@sendEmailContact');

Route::get('/thong-tin-cuu-ho/{city}', 'Frontend\ServiceController@supportCar');
Route::get('/thue-xe-toan-quoc/{city}', 'Frontend\ServiceController@lendCar');
Route::get('/phu-tung-xe-toan-quoc/{city}', 'Frontend\ServiceController@accessaryCar');
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
Route::get('/forgotpass', 'Frontend\ServiceController@forgotPass');

Route::get('/resize-all-images', 'Frontend\HomeController@resizeAllImages');

Route::post('/baiviet/save_bai_viet', 'Frontend\HomeController@save_bai_viet');
Route::post('/getdongxe', 'Frontend\HomeController@getdongxe');
Route::post('/getloaibaiviet', 'Frontend\HomeController@getLoaiBaiViet');
Route::post('/changecaptcha', 'Frontend\HomeController@changecaptcha');
//Route::get('/eidt-baiviet/{id}', 'Frontend\HomeController@edit_freePost');

Route::post('/baiviet/uploadimg', 'Admin\BaivietController@uploadimg');
//Route::get('/get_thongso_init', 'Frontend\HomeController@get_thongso_init');
Route::get('/admin', 'Admin\DashboardController@index');
Route::get('/admin/login', 'Auth\LoginController@login');
Route::post('/admin/login', 'Auth\LoginController@login');
Route::group(['prefix' => 'admin','middleware'=>'\App\Http\Middleware\AdminPermission::class'], function()
{
    // Controllers Within The "App\Http\Controllers\Admin" Namespace
    Route::get('/dashboard', 'Admin\DashboardController@index');

    Route::get('/getbaiviet', 'Admin\BaivietController@get_bai_viet');
    Route::post('/getbaiviet', 'Admin\BaivietController@get_bai_viet');
    Route::post('/getbaivietedit', 'Admin\BaivietController@get_bai_viet_edit');
    Route::post('/delbaiviet', 'Admin\BaivietController@del_bai_viet');
    Route::post('/pubbaiviet', 'Admin\BaivietController@pub_bai_viet');
    Route::post('/save_bai_viet', 'Admin\BaivietController@save_bai_viet');
    Route::post('/tool/dhtmlxform_image', 'Admin\ToolController@dhtmlxform_image');
    Route::get('/tool/dhtmlxform_image', 'Admin\ToolController@dhtmlxform_image');
    Route::post('/tool/dhtmlxform_image_user', 'Admin\ToolController@dhtmlxform_image_user');
    Route::get('/tool/dhtmlxform_image_user', 'Admin\ToolController@dhtmlxform_image_user');

    Route::get('/posts', 'Admin\BaivietController@index');
    Route::get('/news', 'Admin\NewsController@index');
    Route::post('/getnewsedit', 'Admin\NewsController@getnewsedit');
    Route::get('/getnews', 'Admin\NewsController@get_news');
    Route::post('/delnews', 'Admin\NewsController@del_news');
    Route::post('/save_news', 'Admin\NewsController@save_news');
    Route::get('/posts/get_total_news', 'Admin\BaivietController@get_total_news');
    Route::get('/posts/add_bai_viet', 'Admin\BaivietController@add_bai_viet');
    Route::post('/posts/add_bai_viet', 'Admin\BaivietController@add_bai_viet');
    Route::get('/posts/add_bai_viet/{id_slug}', 'Admin\BaivietController@add_bai_viet');
    Route::post('/posts/add_bai_viet/{id_slug}', 'Admin\BaivietController@add_bai_viet');


    Route::get('/users', 'Admin\UsersController@index');
    Route::get('/getusers', 'Admin\UsersController@get_news');
    Route::post('/getuserinfo', 'Admin\UsersController@get_user_info');
    Route::post('/tool/dhtmlxform_photo_user', 'Admin\ToolController@dhtmlxform_photo_user');
    Route::get('/tool/dhtmlxform_photo_user', 'Admin\ToolController@dhtmlxform_photo_user');
    Route::get('/profile', 'Admin\UsersController@getProfile');

    Route::get('/getsalons', 'Admin\SalonController@get');
    Route::post('/save_salon', 'Admin\SalonController@save_salon');
    Route::post('/getsaloninfo', 'Admin\SalonController@getsaloninfo');
    Route::post('/delsalon', 'Admin\SalonController@delete');

    Route::get('/getsuaxes', 'Admin\SuaxeController@get');
    Route::post('/save_suaxe', 'Admin\SuaxeController@save');
    Route::post('/getsuaxeinfo', 'Admin\SuaxeController@getinfo');
    Route::post('/delsuaxe', 'Admin\SuaxeController@delete');


    Route::get('/getcuuhos', 'Admin\CuuhoController@get');
    Route::post('/save_cuuho', 'Admin\CuuhoController@save');
    Route::post('/getcuuhoinfo', 'Admin\CuuhoController@getinfo');
    Route::post('/delcuuho', 'Admin\CuuhoController@delete');

    Route::get('/getthuexe', 'Admin\ThuexeController@get');
    Route::post('/save_thuexe', 'Admin\ThuexeController@save');
    Route::post('/getthuexeinfo', 'Admin\ThuexeController@getinfo');
    Route::post('/delthuexe', 'Admin\ThuexeController@delete');

    Route::get('/getphutung', 'Admin\PhutungController@get');
    Route::post('/save_phutung', 'Admin\PhutungController@save');
    Route::post('/getphutunginfo', 'Admin\PhutungController@getinfo');
    Route::post('/delphutung', 'Admin\PhutungController@delete');

    Route::get('/getbaixes', 'Admin\BaixeController@get');
    Route::post('/save_baixe', 'Admin\BaixeController@save');
    Route::post('/getbaixeinfo', 'Admin\BaixeController@getinfo');
    Route::post('/delbaixe', 'Admin\BaixeController@delete');

    Route::get('/getvideos', 'Admin\VideoController@get');
    Route::post('/save_videos', 'Admin\VideoController@save');
    Route::post('/getvideosinfo', 'Admin\VideoController@getinfo');
    Route::post('/delvideos', 'Admin\VideoController@delete');

//    Route::get('/tool/dhtmlxform_image/{id}', function ($id) {
//
//    })->where('id', '[0-9]+');
});


