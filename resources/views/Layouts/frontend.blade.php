<html>
<html lang="en">
<head>
    <title>Vietnam Oto</title>
    <meta charset="utf-8">
    <link href="{{ URL::asset('images/logo.png') }}" rel="shortcut icon" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/jquery.simplyscroll.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/style_vno.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.css') }}">
    <script src="{{ URL::asset('js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/jquery.simplyscroll.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/angular.min.js') }}"></script>
</head>
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
                                <li><a href="{{ URL::to('vip-salon/all') }}">Showroom toàn quốc</a></li>
                                <li><a href="{{ URL::to('do-xe-uy-tin/all') }}">Sửa xe toàn quốc</a></li>
                                <li><a href="{{ URL::to('thong-tin-cuu-ho/all') }}">Cứu hộ toàn quốc</a></li>
                                <li><a href="{{ URL::to('bai-giu-xe/all') }}">Bãi giữ xe toàn quốc</a></li>
                                <li><a href="{{ URL::to('/tin-tuc') }}">Tin tức về xe</a></li>
                                <li><a href="{{ URL::to('dich-vu-huong-dan') }}">Dịch vụ & Hướng dẫn</a></li>
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
            <div class="filter">
                <form action="/" method="post" name="searchform" >
                    <div class="form-filter">
                        <input type="text" <?php if(isset($searchform['keyword'])){ echo ' value="'.$searchform['keyword'].'"';} ?> class="form-control" name="searchform[keyword]" placeholder="Từ khóa..."/>
                        <select class="form-control inp-filter" name="searchform[thongso_20]">
                            <option value="">Hãng Xe</option>
                            <?php
                            if(!empty($hangxes)){
                                foreach ($hangxes as $k=>$v){
                                    echo '<option value="'.$k.'">'.$v.'</option>';
                                }
                            }
                            ?>
                        </select>
                        <select class="form-control inp-filter">
                            <option>Dòng xe</option>

                        </select>
                        {{--<select class="form-control inp-filter" name="searchform[thongso_25]">--}}
                            {{--<option>Dáng xe</option>--}}
                            <?php
                            if(!empty($list_thongso) && !empty($list_thongso['thongso_25'])){
                                echo \App\Helpers\Helper::search_field($list_thongso['thongso_25'],"Dáng xe",null);
                            }
                            ?>
                        {{--</select>--}}
                    </div>
                    <div class="form-filter form-filter-2">
                        <?php
                        if(!empty($list_thongso) && !empty($list_thongso['thongso_24'])){
                            echo \App\Helpers\Helper::search_field($list_thongso['thongso_24'],"Tình trạng",null);
                        }
                        ?>
                        <?php
                        if(!empty($list_thongso) && !empty($list_thongso['thongso_22'])){
                            echo \App\Helpers\Helper::search_field($list_thongso['thongso_22'],"Năm SX",null);
                        }
                        ?>
                        <select class="form-control inp-filter inp-filter-2">
                            <option>Giá tiền</option>
                        </select>
                            <?php
                            if(!empty($list_thongso) && !empty($list_thongso['thongso_62'])){
                                echo \App\Helpers\Helper::search_field($list_thongso['thongso_62'],"Tỉnh thành",null);
                            }
                            ?>
                    </div>
                    <input class="bt-submit-filter" type="submit" value=" ">
                </form>
            </div>
            @yield('content')
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
                    <a href="{{ URL::to('vip-salon/all') }}">
                        <img class="icon-service" src="{{ URL::asset('images/icon-ser01.png')}}"/>
                        <p>SHOWROOM<br> TOÀN QUỐC <img class="icon-arrow-right" src="{{ URL::asset('images/icon-arrow-right.png')}}"/></p>
                    </a>
                </div>
                <div class="item-service">
                    <a href="{{ URL::to('do-xe-uy-tin/all') }}">
                        <img class="icon-service" src="{{ URL::asset('images/icon-ser02.png')}}"/>
                        <p>SỬA XE<br> TOÀN QUỐC <img class="icon-arrow-right" src="{{ URL::asset('images/icon-arrow-right.png')}}"/></p>
                    </a>
                </div>
                <div class="item-service">
                    <a href="{{ URL::to('thong-tin-cuu-ho/all') }}">
                        <img class="icon-service" src="{{ URL::asset('images/icon-ser03.png')}}"/>
                        <p>CỨU HỘ<br> TOÀN QUỐC <img class="icon-arrow-right" src="{{ URL::asset('images/icon-arrow-right.png')}}"/></p>
                    </a>
                </div>
                <div class="item-service">
                    <a href="{{ URL::to('bai-giu-xe/all') }}">
                        <img class="icon-service" src="{{ URL::asset('images/icon-ser05.png')}}"/>
                        <p>BÃI GIỮ XE<br> TOÀN QUỐC <img class="icon-arrow-right" src="{{ URL::asset('images/icon-arrow-right.png')}}"/></p>
                    </a>
                </div>
            </div>
            <div class="list-news">
                <h3 class="title-list-news"><img src="{{ URL::asset('images/icon-news.png')}}" />TIN TỨC MỚI CẬP NHẬT</h3>
                <ul id="scroller">
                    @for($i=0;$i<2;$i++)
                    @foreach($listNewsHome as $val)
                    <li class="item-news">
                        <a href="{{ URL::to('tin-tuc/'.$val->id.'/'.str_slug($val->title, '-')) }}"><img src="{{ URL::asset($val->image)}}"/></a>
                        <span>{{date_format(date_create($val->created_date), 'd/m/Y H:i a')}}</span>
                        <a class="title-item-news" href="{{ URL::to('tin-tuc/'.$val->id.'/'.str_slug($val->title, '-')) }}">{{$val->title}}</a>
                        <a class="bt-detail-news" href="{{ URL::to('tin-tuc/'.$val->id.'/'.str_slug($val->title, '-')) }}">Chi tiết<small> >> </small></a>
                    </li>
                    @endforeach
                    @endfor
                </ul>
            </div>
        </div>
    </div>
    <div class="footer">
            <div class="info">
                <p>Vietnamoto.net - Bản quyền @ 2017 Goldlands.vn</p>
                <span>Địa chỉ: 02, Phạm Văn Đồng, P. Linh Đông, Q. Thủ Đức, Tp.HCM</span>
                <span>Hotline: 0970 7777 929 - Email: batdongsangoldlands@gmail.com</span>
            </div>
            <div class="menu-bottom">
                <ul>
                    <li><a class="a-one-line" href="{{ URL::to('') }}">Trang chủ</a> </li>
                    <li><a href="{{ URL::to('vip-salon/all') }}">Showroom<br>toàn quốc</a> </li>
                    <li><a href="{{ URL::to('do-xe-uy-tin/all') }}">Sửa xe<br>toàn quốc</a> </li>
                    <li><a href="{{ URL::to('thong-tin-cuu-ho/all') }}">Cứu hộ<br>toàn quốc</a> </li>
                    <li><a href="{{ URL::to('bai-giu-xe/all') }}">Bãi giữ xe<br>toàn quốc</a> </li>
                    <li><a href="{{ URL::to('tin-tuc') }}">Tin tức<br>về xe</a> </li>
                    <li><a href="{{ URL::to('dich-vu-huong-dan') }}">Dịch vụ &<br>Hướng dẫn</a> </li>
                </ul>
            </div>
            <div class="social-bottom">
                <p>Truy cập: <span>300400</span></p><br>
                <p>User: <span>3000</span></p>
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
                    <a class="a-forgot" href="#"><img src="{{ URL::asset('images/icon-question.png')}}"/> Bạn quên mật khẩu của mình?</a>
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
<script type="text/javascript">
    var app = angular.module('myApp', []);
    app.controller('registerCtrl', function ($scope, $http) {
        $scope.clickOpenModal = function(){
            $scope.showAfter = false;
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
        $scope.clickToLogPopup = function(){
            $("#myModalLog").modal('show');
            $("#myModalReg").modal('hide');
            $scope.logForm.$setPristine();
            $scope.logForm.$setUntouched();
            $scope.notexistphone = false;
            $scope.wrongpass = false;
        };
        $scope.clickToRegPopup = function(){
            $("#myModalLog").modal('hide');
            $("#myModalReg").modal('show');
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
            phone: parseInt('{{$user->phone}}'),
            email: '{{$user->email}}',
            address: '{{$user->address}}',
            major: '{{$user->major}}',
            hobby: '{{$user->hobby}}'
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
    $(window).on("load", function() {
        $("#scroller").simplyScroll({
            customClass: 'vert',
            orientation: 'vertical',
            auto: true,
            autoMode: 'loop',
            manualMode: 'loop',
            frameRate: 20,
            speed: 1
        });
        $('#filter-city-support').on('change', function() {
            window.location = '/thong-tin-cuu-ho/'+this.value;
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

        var h = ($(".center-content-col").height());
        var h_first_col = ($(".first-col").height());
        var h_standard = h;
        if (h_first_col > h) {
            h_standard = h_first_col;
        }
        var h2 = ($(".list-services").height());
        var h3 = ($(".avatar").height());
        var h4 = ($(".title-list-news").height());

        $(".vert").css({'height': (h_standard - h2 - h3 - h4 - 70) + 'px'});
        $(".list-news .simply-scroll-clip").css({'height': (h_standard - h2 - h3 - h4 - 50) + 'px'});
        $(".first-col ,.header , .last-col").css({'height': (h_standard + 10) + 'px'});
    });
</script>
</body>
</html>