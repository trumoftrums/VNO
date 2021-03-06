<html>
<html lang="en">
<head>
    <title>Vietnam Oto</title>
    <meta charset="utf-8">
    <link href="{{ URL::asset('images/logo.png') }}" rel="shortcut icon" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="{{$key_des}}"/>
    <meta name="description" content="{{$key_des}}"/>
    <meta name="robots" content="INDEX,FOLLOW"/>
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="{{$key_des}}" />
    <meta property="og:description"   content="{{$key_des}}" />
    <meta property="og:image"         content="{{ URL::asset($img_share_social) }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
    {{--<link rel="stylesheet" href="{{ URL::asset('css/jquery.simplyscroll.css') }}">--}}
    <link rel="stylesheet" href="{{ URL::asset('css/style_vno.css') }}?ver=1.1">
    <link rel="stylesheet" href="{{ URL::asset('css/media_screen.css') }}?ver=1.1">
    <link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.css') }}">
    <script src="{{ URL::asset('js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
    {{--<script src="{{ URL::asset('js/jquery.simplyscroll.min.js') }}" type="text/javascript"></script>--}}
    <script src="{{ URL::asset('js/angular.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.scrollbox.js') }}"></script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-93543131-1', 'auto');
        ga('send', 'pageview');

    </script>
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    @yield('headScript')
</head>
<?php $captchaURL =Captcha::src(); ?>
<body ng-app="myApp" ng-controller="registerCtrl">
<div class="container-fluid">
    <div class="header">
        <div class="first-col">
            <div class="cover-logo">
                <div class="menu-log-reg">
                    <div class="menu">
                        <div class="dropdown">
                            <span class="icon-menu" data-toggle="dropdown">
                                <img src="{{ URL::asset('images/menu-icon.png') }}"/>
                            </span>
                            <ul class="dropdown-menu">
                                <span class="close-menu"> <img src="{{ URL::asset('images/icon-close-menu.png') }}"/> </span>
                                <li><a href="{{ URL::to('') }}">Trang Chủ</a></li>
                                <li><a href="{{ URL::to('vip-salon-map/index') }}">Showroom toàn quốc</a></li>
                                <li><a href="{{ URL::to('do-xe-uy-tin-map/index') }}">Sửa xe toàn quốc</a></li>
                                <li><a href="{{ URL::to('thong-tin-cuu-ho-map/index') }}">Cứu hộ toàn quốc</a></li>
                                <li><a href="{{ URL::to('bai-giu-xe-map/index') }}">Bãi giữ xe toàn quốc</a></li>
                                <li><a href="{{ URL::to('/tin-tuc') }}">Tin tức về xe</a></li>
                                <li><a href="{{ URL::to('dich-vu-huong-dan') }}">Dịch vụ & Hướng dẫn</a></li>
                                <li><a href="{{ URL::to('videos-xe-oto') }}">Videos</a> </li>
                                <li><a href="{{ URL::to('lien-he') }}">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="log-reg">
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <p class="welcome-user">Chào <strong>{{$user->username}}</strong></p>
                        @else
                            <span class="login-signup" data-toggle="modal" ng-click="clickOpenModalLog()" data-target="#myModalLog"><img src="{{ URL::asset('images/icon-login.png')}}"/> Đăng nhập</span>
                            <span class="login-signup" data-toggle="modal" ng-click="clickOpenModal()" id="openModalReg" data-target="#myModalReg"><img src="{{ URL::asset('images/icon-reg.png')}}"/> Đăng kí</span>
                        @endif
                        <div class="dropdown" style="float:left;">
                            <img class="icon-avatar img-circle" id="ava-img-small"
                                 @if(\Illuminate\Support\Facades\Auth::check())
                                    @if($user->avatar != null)
                                    src="{{ URL::asset($user->avatar)}}"
                                    @else
                                    src="{{ URL::asset('images/icon-avatar.png')}}"
                                    @endif
                                 @else
                                    src="{{ URL::asset('images/icon-avatar.png')}}"
                                 @endif
                                 data-toggle="dropdown"/>
                            @if(\Illuminate\Support\Facades\Auth::check())
                            <div class="dropdown-menu cover-logout">
                                <div class="cover-avatar-logout">
                                    <img class="img-circle" id="ava-img-dropdown"
                                         @if($user->avatar != null)
                                         src="{{ URL::asset($user->avatar)}}"
                                         @else
                                         src="{{ URL::asset('images/icon-avatar.png')}}"
                                         @endif
                                    />
                                    <div class="info-user">
                                        <p>User: <span>{{$user->username}}</span></p>
                                        <p>Bài đăng: <span>{{$totalPost}}</span></p>
                                    </div>
                                </div>
                                <a class="bt-logout-homepage bt-logout" href="{{ URL::to('/thong-tin-user') }}">Trang cá nhân</a>
                                <a class="bt-homepage bt-logout-homepage" href="/logout">Đăng xuất</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="logo">
                    <div class="social">
                        <ul>
                            <li><a href="#"><img src="{{ URL::asset('images/icon-fb.png')}}" /></a> </li>
                            <li><a href="#"><img src="{{ URL::asset('images/icon-twitter.png')}}" /></a> </li>
                            <li><a href="#"><img src="{{ URL::asset('images/icon-yb.png')}}" /></a> </li>
                        </ul>
                    </div>
                    <a href="{{ URL::to('') }}"><img class="logo-vno" src="{{ URL::asset('images/logo.png')}}"/></a>
                </div>
                <div class="slogan">
                    <a href="{{ URL::to('') }}"><img src="{{ URL::asset('images/slogan.png')}}"/></a>
                </div>
            </div>
            <div class="slide-show">
                <div class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <a target="_blank" href="http://www.bmw.vn/vi/all-models/3-series/gran_turismo/2013/start.html">
                                <img class="img-slide" src="{{ URL::asset('images/slides/BMW-Series-3-sedan.png')}}"/>
                            </a>
                        </div>
                        <div class="item">
                            <a target="_blank" href="https://hondaoto.com.vn/hondaaccord">
                                <img class="img-slide" src="{{ URL::asset('images/slides/Accord.png')}}"/>
                            </a>
                        </div>
                        <div class="item">
                            <a target="_blank" href="http://mazdamotors.vn/san-pham/3/Mazda6.aspx">
                                <img class="img-slide" src="{{ URL::asset('images/slides/Mazda-6.png')}}"/>
                            </a>
                        </div>
                        <div class="item">
                            <a target="_blank" href="http://www.chevrolet.com.vn/cars/trax/model-overview.html">
                                <img class="img-slide" src="{{ URL::asset('images/slides/Chevrolet-Trax-2017.png')}}"/>
                            </a>
                        </div>
                        <div class="item">
                            <a target="_blank" href="http://www.mitsubishi-motors.com.vn/all-new-pajero-sport">
                                <img class="img-slide" src="{{ URL::asset('images/slides/Pajero-Sport.png')}}"/>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="scroll-ads">
                <div class="item-ads">
                    <a target="_blank" href="http://www.peugeotvietnam.vn/showroom/508/sedan/">
                        <img class="img-ads" src="{{ URL::asset('images/slides/slides-left/peugeot-474x80.png')}}"/>
                    </a>
                </div>
                <div class="item-ads">
                    <a target="_blank" href="http://porsche-vietnam.vn/model/718-cayman-s/">
                        <img class="img-ads" src="{{ URL::asset('images/slides/slides-left/porsche-474x80.png')}}"/>
                    </a>
                </div>
                <div class="item-ads">
                    <a target="_blank" href="http://www.ssangyong.com.vn/chairman_w/exterior.html">
                        <img class="img-ads" src="{{ URL::asset('images/slides/slides-left/ssangyong-474x80.png')}}"/>
                    </a>
                </div>
                <div class="item-ads">
                    <a target="_blank" href="https://www.lexus.com.vn/vn/models/rc.html">
                        <img class="img-ads" src="{{ URL::asset('images/slides/slides-left/lexus-474x80.png')}}"/>
                    </a>
                </div>
            </div>
        </div>
        <div class="center-content-col">
            <div class="header-mobile">
                <div class="menu-header-mobile">
                    <div class="dropdown">
                            <span class="icon-menu" data-toggle="dropdown">
                                <img src="{{ URL::asset('images/icon-menu-mobile.png') }}"/>
                            </span>
                        <ul class="dropdown-menu">
                            <span class="close-menu"> <img src="{{ URL::asset('images/icon-close-menu.png') }}"/> </span>
                            <li><a href="{{ URL::to('') }}">Trang Chủ</a></li>
                            <li><a href="{{ URL::to('vip-salon-map/index') }}">Showroom toàn quốc</a></li>
                            <li><a href="{{ URL::to('do-xe-uy-tin-map/index') }}">Sửa xe toàn quốc</a></li>
                            <li><a href="{{ URL::to('thong-tin-cuu-ho-map/index') }}">Cứu hộ toàn quốc</a></li>
                            <li><a href="{{ URL::to('bai-giu-xe-map/index') }}">Bãi giữ xe toàn quốc</a></li>
                            <li><a href="{{ URL::to('/tin-tuc') }}">Tin tức về xe</a></li>
                            <li><a href="{{ URL::to('dich-vu-huong-dan') }}">Dịch vụ & Hướng dẫn</a></li>
                            <li><a href="{{ URL::to('videos-xe-oto') }}">Videos Xe</a> </li>
                            <li><a href="{{ URL::to('lien-he') }}">Liên hệ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="logo-mobile">
                    <a href="{{ URL::to('') }}"><img class="logo-vno" src="{{ URL::asset('images/logo.png')}}"/></a>
                    <img class="toggle-form-search" src="{{ URL::asset('images/icon-search-mobile.png')}}"/>
                </div>
            </div>
            <div class="filter">
                <form action="/" method="post" name="searchform" id="searchform" >
                    <div class="form-filter">
                        <input type="text" <?php if(isset($searchform['keyword'])){ echo ' value="'.$searchform['keyword'].'"';} ?> class="form-control" name="keyword" placeholder="Từ khóa..."/>
                        <select class="form-control inp-filter" id="filter_hang_xe" name="hangxe">
                            <option value="">Hãng Xe</option>
                            <?php
                            if(!empty($hangxes)){
                                foreach ($hangxes as $k=>$v){
                                    $selected="";
//                                    var_dump($searchform);exit();
                                    if(isset($searchform['thongso_20']) && $searchform['thongso_20']==$k){
                                        $selected =' selected="selected"';
                                    }
                                    echo '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
                                }
                            }
                            ?>
                        </select>
                        <select  id="filter_dong_xe" name="dongxe" class="form-control inp-filter">
                            <option value="">Dòng xe</option>

                        </select>
                        {{--<select class="form-control inp-filter" name="searchform[thongso_25]">--}}
                            {{--<option>Dáng xe</option>--}}
                            <?php
                            if(!empty($list_thongso) && !empty($list_thongso['thongso_25'])){
                                $thongso_25 =null;
                                if(isset($searchform['thongso_25']) && $searchform['thongso_25']){
                                    $thongso_25 =$searchform['thongso_25'];
                                }
                                echo \App\Helpers\Helper::search_field($list_thongso['thongso_25'],"Dáng xe",$thongso_25,"dangxe");
                            }
                            ?>
                        {{--</select>--}}
                    </div>
                    <div class="form-filter form-filter-2">
                        <?php
                        if(!empty($list_thongso) && !empty($list_thongso['thongso_24'])){
                            $thongso_24 =null;
                            if(isset($searchform['thongso_24']) && $searchform['thongso_24']){
                                $thongso_24 =$searchform['thongso_24'];
                            }
                            echo \App\Helpers\Helper::search_field($list_thongso['thongso_24'],"Tình trạng",$thongso_24,"tinhtrang");
                        }
                        ?>
                        <?php
                        if(!empty($list_thongso) && !empty($list_thongso['thongso_22'])){
                            $thongso_22 =null;
                            if(isset($searchform['thongso_22']) && $searchform['thongso_22']){
                                $thongso_22 =$searchform['thongso_22'];
                            }
                            echo \App\Helpers\Helper::search_field($list_thongso['thongso_22'],"Năm SX",$thongso_22,"namsx");
                        }
                        ?>
                        <select  name="gia" id="ft_thongso_65" class="form-control inp-filter inp-filter-2">
                            <option value="">Giá tiền</option>
                            <option value="0-200">0 triệu - 200 triệu</option>
                            <option value="201-400">201 triệu - 400 triệu</option>
                            <option value="401-600">401 triệu - 600 triệu</option>
                            <option value="601-800">601 triệu - 800 triệu</option>
                            <option value="801-1000">801 triệu - 1 tỷ</option>
                            <option value="1001-1500">1 tỷ - 1.5 tỷ</option>
                            <option value="1501-2000">1.5 tỷ - 2 tỷ</option>
                            <option value="2000-1000000">trên 2 tỷ</option>
                        </select>
                        <?php
//                        if(!empty($list_thongso) && !empty($list_thongso['thongso_62'])){
//                            $thongso_62 =null;
//                            if(isset($searchform['thongso_62']) && $searchform['thongso_62']){
//                                $thongso_62 =$searchform['thongso_62'];
//                            }
//                            echo \App\Helpers\Helper::search_field($list_thongso['thongso_62'],"Tỉnh thành",$thongso_62,"tinh");
//                        }
                        ?>
                            <select  name="tinh" id="ft_thongso_62" class="form-control inp-filter inp-filter-2">
                                <option value="">Tỉnh thành</option>
                            <?php
                            if(!empty($listCity)){
                                foreach ($listCity as $v){
                                    $selected="";
                                    if(isset($searchform['thongso_62']) && $searchform['thongso_62']==$k){
                                        $selected =' selected="selected"';
                                    }
                                    echo '<option value="'.$v['city_name'].'" '.$selected.'>'.$v['city_name'].'</option>';
                                }
                            }
                            ?>
                            </select>
                    </div>
                    <input class="bt-submit-filter" type="submit" value=" ">
                </form>
            </div>
            <div class="slide-show-mobile">
                <div class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <a target="_blank" href="http://www.bmw.vn/vi/all-models/3-series/gran_turismo/2013/start.html">
                                <img class="img-slide" src="{{ URL::asset('images/slides/ipad/BMW-Series-3-sedan.jpg')}}"/>
                            </a>
                        </div>
                        <div class="item">
                            <a target="_blank" href="https://hondaoto.com.vn/hondaaccord">
                                <img class="img-slide" src="{{ URL::asset('images/slides/ipad/Accord.jpg')}}"/>
                            </a>
                        </div>
                        <div class="item">
                            <a target="_blank" href="http://mazdamotors.vn/san-pham/3/Mazda6.aspx">
                                <img class="img-slide" src="{{ URL::asset('images/slides/ipad/Mazda-6.jpg')}}"/>
                            </a>
                        </div>
                        <div class="item">
                            <a target="_blank" href="http://www.chevrolet.com.vn/cars/trax/model-overview.html">
                                <img class="img-slide" src="{{ URL::asset('images/slides/ipad/Chevrolet-Trax-2017.jpg')}}"/>
                            </a>
                        </div>
                        <div class="item">
                            <a target="_blank" href="http://www.mitsubishi-motors.com.vn/all-new-pajero-sport">
                                <img class="img-slide" src="{{ URL::asset('images/slides/ipad/Pajero-Sport.jpg')}}"/>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="post-free-mobile">
                <a class="bt-reg-free"
                   @if(\Illuminate\Support\Facades\Auth::check())
                   href="{{ URL::to('/dang-tin-free') }}"
                   @else
                   data-toggle="modal" ng-click="clickOpenModalLog()" data-target="#myModalLog"
                        @endif
                >Đăng tin miễn phí</a>
                <div class="list-services-mobile">
                    <div class="item-service">
                        <a href="{{ URL::to('vip-salon-map/index') }}">
                            <img class="icon-service" src="{{ URL::asset('images/icon-ser01-mobile.png')}}"/>
                        </a>
                    </div>
                    <div class="item-service">
                        <a href="{{ URL::to('do-xe-uy-tin-map/index') }}">
                            <img class="icon-service" src="{{ URL::asset('images/icon-ser02-mobile.png')}}"/>
                        </a>
                    </div>
                    <div class="item-service">
                        <a href="{{ URL::to('thong-tin-cuu-ho-map/index') }}">
                            <img class="icon-service" src="{{ URL::asset('images/icon-ser03-mobile.png')}}"/>
                        </a>
                    </div>
                    <div class="item-service">
                        <a href="{{ URL::to('bai-giu-xe-map/index') }}">
                            <img class="icon-service" src="{{ URL::asset('images/icon-ser05-mobile.png')}}"/>
                        </a>
                    </div>
                    <div class="item-service">
                        <a href="{{ URL::to('thue-xe-toan-quoc-map/index') }}">
                            <img class="icon-service" src="{{ URL::asset('images/icon-ser06-mobile.png')}}"/>
                        </a>
                    </div>
                    <div class="item-service">
                        <a href="{{ URL::to('phu-tung-xe-toan-quoc/all') }}">
                            <img class="icon-service" src="{{ URL::asset('images/icon-ser07-mobile.png')}}"/>
                        </a>
                    </div>
                </div>
            </div>
            <div class="cal-height" style="float: left;">
                @yield('content')
            </div>
        </div>
        <div class="last-col">
            <div class="avatar">
                <a class="bt-reg-free"
                   @if(\Illuminate\Support\Facades\Auth::check())
                        href="{{ URL::to('/dang-tin-free') }}"
                   @else
                        data-toggle="modal" ng-click="clickOpenModalLog()" data-target="#myModalLog"
                   @endif
                >Đăng tin miễn phí</a>
            </div>
            <div class="list-services">
                <div class="item-service">
                    <a href="{{ URL::to('vip-salon-map/index') }}">
                        <img class="icon-service" src="{{ URL::asset('images/icon-ser01.png')}}"/>
                        <p>SHOWROOM<br> TOÀN QUỐC <img class="icon-arrow-right" src="{{ URL::asset('images/icon-arrow-right.png')}}"/></p>
                    </a>
                </div>
                <div class="item-service">
                    <a href="{{ URL::to('do-xe-uy-tin-map/index') }}">
                        <img class="icon-service" src="{{ URL::asset('images/icon-ser02.png')}}"/>
                        <p>SỬA XE<br> TOÀN QUỐC <img class="icon-arrow-right" src="{{ URL::asset('images/icon-arrow-right.png')}}"/></p>
                    </a>
                </div>
                <div class="item-service">
                    <a href="{{ URL::to('thong-tin-cuu-ho-map/index') }}">
                        <img class="icon-service" src="{{ URL::asset('images/icon-ser03.png')}}"/>
                        <p>CỨU HỘ<br> TOÀN QUỐC <img class="icon-arrow-right" src="{{ URL::asset('images/icon-arrow-right.png')}}"/></p>
                    </a>
                </div>
                <div class="item-service">
                    <a href="{{ URL::to('bai-giu-xe-map/index') }}">
                        <img class="icon-service" src="{{ URL::asset('images/icon-ser05.png')}}"/>
                        <p>BÃI GIỮ XE<br> TOÀN QUỐC <img class="icon-arrow-right" src="{{ URL::asset('images/icon-arrow-right.png')}}"/></p>
                    </a>
                </div>
                <div class="item-service">
                    <a href="{{ URL::to('thue-xe-toan-quoc-map/index') }}">
                        <img class="icon-service" src="{{ URL::asset('images/icon-ser06.png')}}"/>
                        <p>CHO THUÊ XE<br> TOÀN QUỐC <img class="icon-arrow-right" src="{{ URL::asset('images/icon-arrow-right.png')}}"/></p>
                    </a>
                </div>
                <div class="item-service">
                    <a href="{{ URL::to('phu-tung-xe-toan-quoc-map/index') }}">
                        <img class="icon-service" src="{{ URL::asset('images/icon-ser07.png')}}"/>
                        <p>PHỤ TÙNG XE<br> TOÀN QUỐC <img class="icon-arrow-right" src="{{ URL::asset('images/icon-arrow-right.png')}}"/></p>
                    </a>
                </div>
            </div>
            <div class="list-news">
                <h3 class="title-list-news"><img src="{{ URL::asset('images/icon-news.png')}}" />TIN TỨC MỚI CẬP NHẬT</h3>
                <div id="scroller">
                    <ul>
                        @for($i=0;$i<2;$i++)
                            @foreach($listNewsHome as $val)
                                <li class="item-news">
                                    <a href="{{ URL::to('tin-tuc/'.$val->id.'/'.str_slug($val->title, '-')) }}"><img
                                                src="{{ URL::asset($val->image)}}"/></a>
                                    <span>{{date_format(date_create($val->created_date), 'd/m/Y H:i a')}}</span>
                                    <a class="title-item-news"
                                       href="{{ URL::to('tin-tuc/'.$val->id.'/'.str_slug($val->title, '-')) }}">{{$val->title}}</a>
                                    <a class="bt-detail-news"
                                       href="{{ URL::to('tin-tuc/'.$val->id.'/'.str_slug($val->title, '-')) }}">Chi tiết
                                        <small> >></small>
                                    </a>
                                </li>
                            @endforeach
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-mobile">
        <a class="top-page" href="#top">TOP PAGE <img src="{{ URL::asset('images/icon-top-page.png')}}"/></a>
        <ul>
            <li><a href="{{ URL::to('') }}">Trang chủ</a> </li>
            <li><a href="{{ URL::to('vip-salon-map/index') }}">Showroom toàn quốc</a> </li>
            <li><a href="{{ URL::to('do-xe-uy-tin-map/index') }}">Sửa xe toàn quốc</a> </li>
            <li><a href="{{ URL::to('thong-tin-cuu-ho-map/index') }}">Cứu hộ toàn quốc</a> </li>
            <li><a href="{{ URL::to('bai-giu-xe-map/index') }}">Bãi giữ xe toàn quốc</a> </li>
            <li><a href="{{ URL::to('tin-tuc') }}">Tin tức về xe</a> </li>
            <li><a href="{{ URL::to('dich-vu-huong-dan') }}">Dịch vụ & Hướng dẫn</a> </li>
            <li><a href="{{ URL::to('videos-xe-oto') }}">Videos</a> </li>
            <li><a href="{{ URL::to('lien-he') }}">Liên hệ</a> </li>
        </ul>
        <div class="info">
            <p>Vietnamoto.net - Bản quyền @ 2013 HoangSangGroup</p>
            <span>02 Phạm Văn Đồng, P. Linh Đông, Q. Thủ Đức, Tp.HCM</span>
            <span>Hotline: 089 815 4544</span>
            <span>Email: cskh@vietnamoto.net</span>
        </div>
    </div>
    <div class="footer">
            <div class="info">
                <p>Vietnamoto.net - Bản quyền @ 2013 HoangSangGroup</p>
                <span>Địa chỉ: 02, Phạm Văn Đồng, P. Linh Đông, Q. Thủ Đức, Tp.HCM</span>
                <span>Hotline: 089 815 4544 - Email: cskh@vietnamoto.net</span>
            </div>
            <div class="menu-bottom">
                <ul>
                    <li><a class="a-one-line" href="{{ URL::to('') }}">Trang chủ</a> </li>
                    <li><a href="{{ URL::to('vip-salon-map/index') }}">Showroom<br>toàn quốc</a> </li>
                    <li><a href="{{ URL::to('do-xe-uy-tin-map/index') }}">Sửa xe<br>toàn quốc</a> </li>
                    <li><a href="{{ URL::to('thong-tin-cuu-ho-map/index') }}">Cứu hộ<br>toàn quốc</a> </li>
                    <li><a href="{{ URL::to('bai-giu-xe-map/index') }}">Bãi giữ xe<br>toàn quốc</a> </li>
                    <li><a href="{{ URL::to('tin-tuc') }}">Tin tức<br>về xe</a> </li>
                    <li><a href="{{ URL::to('dich-vu-huong-dan') }}">Dịch vụ &<br>Hướng dẫn</a> </li>
                    <li><a class="a-one-line" href="{{ URL::to('videos-xe-oto') }}">Videos</a> </li>
                    <li><a class="a-one-line" href="{{ URL::to('lien-he') }}">Liên hệ</a> </li>
                </ul>
            </div>
            <div class="social-bottom">
                {{--<p>Truy cập: <span>{{$countView}}</span></p><br>--}}
                {{--<p>User: <span>{{$countUser}}</span></p>--}}
            </div>
        </div>
</div>
<!-- Modal Register-->
<div id="myModalReg" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <img src="{{ URL::asset('images/icon-close-popup.png')}}"/>
                </button>
                <img class="img-logo-popup" src="{{ URL::asset('images/logo.png')}}"/>
                <img class="img-slogan-popup" src="{{ URL::asset('images/slogan-reg.png')}}"/>
            </div>
            <img class="img-line" src="{{ URL::asset('images/line.png')}}"/>
            <div class="modal-body">
                <div ng-show="showBefore">
                    <p class="p-in-pop">HÃY ĐĂNG KÝ ĐỂ NHẬN THÔNG TIN VÀ TÍCH ĐIỂM NHẬN GIẢI THƯỞNG KHI LÀ THÀNH VIÊN CỦA VIETNAMOTO.NET</p>
                    <form class="form-reg" id="form-reg" name="regForm" ng-submit="clickRegister()" novalidate>
                        <ul>
                            <li>
                                <span>Số điện thoại:</span>
                                <input ng-model="formData.phone" class="inp form-control number-only" name="phone" required type="text"/>
                                <p ng-show="regForm.phone.$invalid && regForm.$submitted" class="error-valid">Bạn chưa nhập số điện thoại.</p>
                            </li>
                            <li>
                                <span>Mật khẩu:</span>
                                <input ng-model="formData.password" type="password" class="inp form-control" name="pass" required/>
                                <p ng-show="regForm.pass.$invalid && regForm.$submitted" class="error-valid">Bạn chưa nhập mật khẩu.</p>
                            </li>
                            <li>
                                <span>Nhập lại mật khẩu:</span>
                                <input ng-model="formData.repassword" class="inp form-control" type="password" name="repass" required/>
                                <p ng-show="regForm.repass.$invalid && regForm.$submitted" class="error-valid">Bạn chưa nhập lại mật khẩu.</p>
                                <p ng-show="matchpassword" class="error-valid">Mật khẩu nhập lại chưa đúng.</p>
                                <p ng-show="existphone" class="error-valid">Số điện thoại này đã đăng ký. Xin vui lòng nhập số điện thoại khác!</p>
                            </li>
                            <li>
                                <input class="bt-in-pop" type="submit" value="Đăng ký"/>
                            </li>
                        </ul>
                    </form>
                    <p class="p-in-pop">KHI ĐĂNG KÝ TỨC LÀ BẠN ĐÃ CHẤP NHẬN MỌI ĐIỀU KHOẢN TỪ VIETNAMOTO.NET</p>
                </div>
                <div ng-show="showAfter" class="after-reg">
                    <h3>ĐĂNG KÝ THÀNH CÔNG</h3>
                    <H4>CHÀO MỪNG BẠN ĐẾN VỚI VIETNAMOTO.NET</H4>
                    <span ng-click="clickToLogPopup()" id="click-to-log-popup">CLICK ĐỂ ĐĂNG NHẬP VIETNAMOTO.NET</span>
                    <p class="p-in-pop-reg" style="padding: 0px 60px;">HÃY ĐĂNG BÀI VÀ CHIA SẼ ĐỂ TÍCH ĐIỂM ĐỂ NHẬN GIẢI THƯỞNG TỪ VIETNAMOTO.NET</p>
                    <div class="social-popup">
                        <a href="#"><img src="{{ URL::asset('images/icon-fb.png')}}"/></a>
                        <a href="#"><img src="{{ URL::asset('images/icon-twitter.png')}}"/></a>
                        <a href="#"><img src="{{ URL::asset('images/icon-yb.png')}}"/></a>
                        <a href="#"><img src="{{ URL::asset('images/icon-google.png')}}"/></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Modal Login-->
<div id="myModalLog" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <img src="{{ URL::asset('images/icon-close-popup.png')}}"/>
                </button>
                <img class="img-logo-popup" src="{{ URL::asset('images/logo.png')}}"/>
                <img class="img-slogan-popup" src="{{ URL::asset('images/slogan-reg.png')}}"/>
            </div>
            <img class="img-line" src="{{ URL::asset('images/line.png')}}"/>
            <div class="modal-body">
                <form class="form-reg" name="logForm" ng-submit="clickLogin()" novalidate>
                    <ul>
                        <li>
                            <span>Số điện thoại:</span>
                            <input ng-model="formDataLog.phone" ng-model="phone" class="inp form-control number-only" type="text" name="phone" required/>
                            <p ng-show="logForm.phone.$invalid && logForm.$submitted" class="error-valid">Bạn chưa nhập số điện thoại.</p>
                            <p ng-show="notexistphone" class="error-valid">Số điện thoại này chưa được đăng ký</p>
                        </li>
                        <li>
                            <span>Mật khẩu:</span>
                            <input id="phone-reg" ng-model="formDataLog.password" type="password" class="inp form-control" name="pass" required/>
                            <p ng-show="logForm.pass.$invalid && logForm.$submitted" class="error-valid">Bạn chưa nhập mật khẩu.</p>
                            <p ng-show="wrongpass" class="error-valid">Mật khẩu chưa đúng</p>
                        </li>
                        <li>
                            <input class="bt-in-pop" type="submit" value="Đăng nhập"/>
                        </li>
                    </ul>
                    <a class="a-forgot" href="#" ng-click="clickToForgotPopup()" ><img src="{{ URL::asset('images/icon-question.png')}}"/> Bạn quên mật khẩu của mình?</a>
                    <span class="spa-reg"><img src="{{ URL::asset('images/icon-reg.png')}}"/> Bạn chưa có tài khoản. Hãy <a ng-click="clickToRegPopup()" class="a-regs" href="#">đăng ký</a> cùng chúng tôi</span>
                </form>
            </div>
            <img class="img-line" src="{{ URL::asset('images/line.png')}}"/>
            <div class="modal-footer">
                <p class="p-in-pop" style="padding: 0px 60px;">HÃY ĐĂNG BÀI VÀ CHIA SẼ ĐỂ TÍCH ĐIỂM ĐỂ NHẬN GIẢI THƯỞNG TỪ VIETNAMOTO.NET</p>
                <div class="social-popup">
                    <a href="#"><img src="{{ URL::asset('images/icon-fb.png')}}"/></a>
                    <a href="#"><img src="{{ URL::asset('images/icon-twitter.png')}}"/></a>
                    <a href="#"><img src="{{ URL::asset('images/icon-yb.png')}}"/></a>
                    <a href="#"><img src="{{ URL::asset('images/icon-google.png')}}"/></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal forgot-->
<div id="myModalForgot" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <img src="{{ URL::asset('images/icon-close-popup.png')}}"/>
                </button>
                <img class="img-logo-popup" src="{{ URL::asset('images/logo.png')}}"/>
                <img class="img-slogan-popup" src="{{ URL::asset('images/slogan-reg.png')}}"/>
            </div>
            <img class="img-line" src="{{ URL::asset('images/line.png')}}"/>
            <div class="modal-body">
                <div ng-show="showBefore">
                    <p class="p-in-pop">BẠN QUÊN MẬT KHẨU?<BR> HÃY NHẬP SỐ ĐIỆN THOẠI ĐÃ ĐĂNG KÝ VỚI VIETNAMOTO.NET</p>
                    <form class="form-reg" id="form-reg" name="forgotForm" ng-submit="clickForgot()" novalidate>
                        <ul>
                            <li>
                                <span>Số điện thoại:</span>
                                <input ng-model="formData.phone" class="inp form-control number-only" placeholder="Nhập số điện thoại" name="phone" id ="forgot-phone" required type="text"/>
                                <p ng-show="forgotForm.phone.$invalid && forgotForm.$submitted" class="error-valid">Bạn chưa nhập số điện thoại.</p>
                            </li>

                            <li>
                                <span>Mã xác nhận</span>
                                <input type="text" ng-model="formData.code" style="width:30%;" class="inp form-control" placeholder="Nhập mã" value="" name="code" id="captcha">
                                <img  style="width:30%;"  class="img-cap" src="{{$captchaURL}}"/>
                                <p ng-show="forgotForm.code.$invalid && forgotForm.$submitted" class="error-valid">Bạn chưa nhập mã xác thực.</p>
                            </li>

                            <li>
                                <input class="bt-in-pop" type="submit" value="Gởi mật khẩu mới"/>
                            </li>
                        </ul>
                    </form>
                    <p class="p-in-pop">VIETNAMOTO.NET SẼ GỞI MẬT KHẨU MỚI QUA ĐIỆN THOẠI CỦA BẠN</p>
                </div>
                <div ng-show="showAfter" class="after-reg">
                    <p>GỞI MẬT KHẨU MỚI THÀNH CÔNG</p>
                    <p>VUI LÒNG KIỂM TRA TIN NHẮN SMS ĐỂ BIẾT ĐƯỢC MẬT KHẨU MỚI!</p>
                    <span ng-click="clickToLogPopup()" id="click-to-log-popup">CLICK ĐỂ ĐĂNG NHẬP VIETNAMOTO.NET</span>
                </div>
                <div ng-show="showError" style="color: red;" id ="forgot-mess" class="after-reg">

                </div>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    var captchaURL = '{{$captchaURL}}';
    var app = angular.module('myApp', []);
    app.controller('registerCtrl', function ($scope, $http) {
        $scope.clickOpenModal = function(){
            $scope.showAfter = false;
            $scope.showError = false;
            $scope.showBefore = true;
            $scope.regForm.$setPristine();
            $scope.regForm.$setUntouched();
            $scope.formData = {};
            $scope.existphone = false;
        };
        $scope.$watch('formData.phone', function () {
            if ($scope.existphone == true) {
                $scope.existphone = false;
            }
        });
        $scope.$watch('formData.repassword', function () {
            var pass = $scope.formData.password;
            var repass = $scope.formData.repassword;
            if (typeof repass !== 'undefined') {
                if (typeof pass !== 'undefined') {
                    if (repass != pass) {
                        $scope.matchpassword = true;
                    } else {
                        $scope.matchpassword = false;
                    }
                } else {
                    $scope.matchpassword = false;
                }
            } else {
                $scope.matchpassword = false;
            }
        });
        $scope.$watch('formData.password', function () {
            var repass = $scope.formData.repassword;
            var pass = $scope.formData.password;
            if (typeof pass !== 'undefined') {
                if (typeof repass !== 'undefined') {
                    if (repass != pass) {
                        $scope.matchpassword = true;
                    } else {
                        $scope.matchpassword = false;
                    }
                } else {
                    $scope.matchpassword = false;
                }
            } else {
                $scope.matchpassword = false;
            }
        });
        function resetValidateForm(){
            $scope.showAfter = false;
            $scope.showBefore = true;
            $scope.existphone = false;
            $scope.notexistphone = false;
            $scope.wrongpass = false;
            $scope.showError = false;
        };
        resetValidateForm();
        $scope.clickRegister = function () {
            if ($scope.regForm.$valid) {
                $http({
                    method: 'POST',
                    url: '/register',
                    data: $.param($scope.formData),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                })
                .success(function (data) {
                    if (data.status == true) {
                        $scope.showAfter = true;
                        $scope.showBefore = false;
                    } else {
                        $scope.existphone = true;
                    }
                });
            }
        };
        $scope.$watch('formDataLog.phone', function () {
            if ($scope.notexistphone == true) {
                $scope.notexistphone = false;
            }
        });
        $scope.$watch('formDataLog.password', function () {
            if ($scope.wrongpass == true) {
                $scope.wrongpass = false;
            }
        });
        $scope.clickOpenModalLog = function(){
            $scope.logForm.$setPristine();
            $scope.logForm.$setUntouched();
            $scope.notexistphone = false;
            $scope.wrongpass = false;
        };
        $scope.clickLogin = function () {
            if ($scope.logForm.$valid) {
                $http({
                    method: 'POST',
                    url: '/login-frontend',
                    data: $.param($scope.formDataLog),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                })
                .success(function (data) {
                    if (data.status == true) {
                        location.reload();
                    } else {
                        if (data.message == 'phone_not_exit') {
                            $scope.notexistphone = true;
                        } else {
                            $scope.wrongpass = true;
                        }
                    }
                });
            }
        }
        $scope.clickForgot = function () {
            if ($scope.forgotForm.$valid) {
                $http({
                    method: 'POST',
                    url: '/forgot-password',
                    data: $.param($scope.formData),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                })
                    .success(function (data) {
                        if (data.result) {
                            $scope.formData.phone = '';
                            $scope.formData.code ='';
                            changeCaptcha();
                            $scope.showError = false;
                            $scope.showBefore = false;
                            $scope.showAfter = true;

                        } else {
                            document.getElementById('forgot-mess').innerHTML = data.mess;
                            $scope.showError = true;
                        }
                    });
            }
        }
        $scope.clickToLogPopup = function(){
            $("#myModalLog").modal('show');
            $("#myModalReg").modal('hide');
            $("#myModalForgot").modal('hide');
            $scope.logForm.$setPristine();
            $scope.logForm.$setUntouched();
            $scope.notexistphone = false;
            $scope.wrongpass = false;
        };
        $scope.clickToRegPopup = function(){
            $("#myModalLog").modal('hide');
            $("#myModalReg").modal('show');
            $("#myModalForgot").modal('hide');
            $scope.showAfter = false;
            $scope.showBefore = true;
            $scope.regForm.$setPristine();
            $scope.regForm.$setUntouched();
            $scope.formData = {};
            $scope.existphone = false;
        };
        $scope.clickToForgotPopup = function(){
            changeCaptcha();
            $("#myModalLog").modal('hide');
            $("#myModalReg").modal('hide');
            $("#myModalForgot").modal('show');

            $scope.showAfter = false;
            $scope.showBefore = true;
            $scope.regForm.$setPristine();
            $scope.regForm.$setUntouched();
            $scope.formData = {};
            $scope.existphone = false;
        };
        //update info user
        $scope.formDataInfo = {};
        @if(\Illuminate\Support\Facades\Auth::check())
        $scope.formDataInfo = {
            username: '{{$user->username}}',
            phone: '{{$user->phone}}',
            email: '{{$user->email}}',
            address: '{{$user->address}}',
            major: '{{$user->major}}',
            hobby: '{{$user->hobby}}'
        };
        $scope.formDataChangePass = {
            phone: '{{$user->phone}}',
            password: '',
            newpassword: '',
        };
        @endif
        $scope.clickUpdateInfo = function () {
            $http({
                method: 'POST',
                url: '/update-info-user',
                data: $.param($scope.formDataInfo),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .success(function (data) {
                if (data.status == true) {
                    $("#success-alert-update").fadeTo(2000, 500).slideUp(500, function(){
                        $("#success-alert-update").slideUp(500);
                    });
                }
            });
        };

        //change password
        $scope.clickChangePassword = function(){
            if ($scope.changePasswordForm.$valid) {
                $http({
                    method: 'POST',
                    url: '/change-password',
                    data: $.param($scope.formDataChangePass),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                })
                .success(function (data) {
                    if (data.status == true) {
                        $("#success-alert-change").fadeTo(2000, 500).slideUp(500, function () {
                            $("#success-alert-change").slideUp(500);
                        });
                    } else {
                        if (data.message == 'wrong_phone') {
                            $("#wrong-phone-alert-change").fadeTo(2000, 500).slideUp(500, function () {
                                $("#wrong-pass-alert-change").slideUp(500);
                            });
                        } else {
                            $("#wrong-pass-alert-change").fadeTo(2000, 500).slideUp(500, function () {
                                $("#wrong-pass-alert-change").slideUp(500);
                            });
                        }
                    }
                });
            }
        }
    });
    $(".number-only").keydown(function(e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    $('#scroller').scrollbox({
        linear: true,
        step: 1,
        delay: 0,
        speed:50,
        infiniteLoop: true,
    });
    $(window).on('resize', function(){
        setHeightDiv();
    });
    setHeightDiv();
    function setHeightDiv(){
        var h = ($(".cal-height").height());
        var h2 = ($(".list-services").height());
        var h4 = ($(".title-list-news").height());
        $(".list-news #scroller").css({'height': (h - h2 - h4 - 10) + 'px'});
    }
    $(window).on("load", function() {
        $(".toggle-form-search").click(function(){
            $(".filter").toggle('slow');
        });
        $("a[href='#top']").click(function() {
            $("html, body").animate({ scrollTop: 0 }, "slow");
            return false;
        });
        $('#filter-city-support').on('change', function() {
            window.location = '/thong-tin-cuu-ho/'+this.value;
        });
        $('#filter-city-lend').on('change', function() {
            window.location = '/thue-xe-toan-quoc/'+this.value;
        });
        $('#filter-city-accessary').on('change', function() {
            window.location = '/phu-tung-xe-toan-quoc/'+this.value;
        });
        $('#filter-city-design').on('change', function() {
            window.location = '/do-xe-uy-tin/'+this.value;
        });
        $('#filter-city-salon').on('change', function() {
            window.location = '/vip-salon/'+this.value;
        });
        $('#filter-city-bai-xe').on('change', function() {
            window.location = '/bai-giu-xe/'+this.value;
        });
        $( ".inner-item" ).hover(function() {
            $( this ).children(":first").fadeIn('fast');
        }, function(){
            $(this).children(":first").fadeOut('fast');
        });
        $("#userfile").change(function () {
            $('#upload_file').submit();
        });
        $('#upload_file').submit(function () {
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '/upload-avatar',
                type: 'POST',
                enctype: 'multipart/form-data',
                data: formData,
                async: false,
                success: function (result) {
                    if(result != 'NO_CHANGE'){
                        $("#ava-img").attr('src', result);
                        $("#ava-img-small").attr('src', result);
                        $("#ava-img-dropdown").attr('src', result);
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
            return false;
        });
    });
    $("#filter_hang_xe").change(function() {
        var vl = $("#filter_hang_xe").val();
        if(vl!=''){
            filter_getDongXe(vl);
        }

    });
    function filter_getDongXe(vl){
        $.ajax({
            url: '/getdongxe',
            type: 'POST',
            dataType: "json",
            cache: false,
            enctype: 'multipart/form-data',
            data : {id:vl},
            success : function(data) {
                if(data.result){
                    filter_generate_dongxe(data.data);

                }else{
                    filter_generate_dongxe(null);
                }
            }
        });
    }
    function filter_generate_dongxe(data){
        var sl = $("#filter_dong_xe");
        sl.html('<option value="">Dòng xe</option>');
        var dx = 0;
        <?php
            if(isset($searchform['thongso_75']) && !empty($searchform['thongso_75'])){
                echo 'dx = '.$searchform['thongso_75'].';';
            }

        ?>
        if(data != null){
            $.each(data, function(key,value) {

                if(key==dx){
                    sl.append('<option  selected="selected" value="'+key+'">'+value+'</option>');
                }else{
                    sl.append('<option value="'+key+'">'+value+'</option>');
                }
//                sl.append('<option value="'+key+'">'+value+'</option>');


            });
        }

    }
    $(document).ready(function() {
        <?php
            if(isset($searchform['thongso_20']) && !empty($searchform['thongso_20'])){
                echo 'filter_getDongXe('.$searchform['thongso_20'].');';
            }
            //ft_thongso_65
            if(isset($searchform['thongso_65']) && !empty($searchform['thongso_65'])){
                echo '$("#ft_thongso_65").val("'.$searchform['thongso_65'].'");';
            }
        ?>


    });
    $('#searchform').submit(function (e) {
        var ac = $('#searchform').attr("action");
        if(ac.length <9){
            e.preventDefault();
            var urlPath = "/?search=1";
            var formDT = $('#searchform').serializeArray();
            var l = formDT.length;
            for (var i = 0; i < l; i++) {
//            console.log(formDT[i]);
                var obj = formDT[i];
                urlPath +="&"+obj.name+"="+obj.value;
            }
            $('#searchform').attr("action",urlPath);
//            console.log(urlPath);
            $('#searchform').submit();
        }

    });
    $(".img-cap").click(function () {
        changeCaptcha();
    });
    function changeCaptcha(){

        $.ajax({
            url: '/changecaptcha',
            type: 'POST',
            dataType: "html",
            cache: false,
            enctype: 'multipart/form-data',
            data : {},
            success : function(data) {
                $(".img-cap").attr("src",data);
            }
        });
    }
</script>
</body>
</html>