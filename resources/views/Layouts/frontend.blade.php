<html>
<html lang="en">
<head>
    <title>Vietnam Oto</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/jquery.simplyscroll.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/style_vno.css') }}">
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
                                <img src="{{ URL::asset('images/icon-menu.png') }}"/>
                            </span>
                            <ul class="dropdown-menu">
                                <span class="close-menu"> <img src="{{ URL::asset('images/icon-close-menu.png') }}"/> </span>
                                <li><a href="{{ URL::to('') }}">Trang Chủ</a></li>
                                <li><a href="#">Vip Showroom/ Salon Oto</a></li>
                                <li><a href="#">Địa Chỉ Sửa Xe/ Độ Xe Uy Tín</a></li>
                                <li><a href="#">Thông tin cứu hộ trên toàn quốc</a></li>
                                <li><a href="#">Góc giao lưu/ Chia sẻ</a></li>
                                <li><a href="{{ URL::to('/tin-tuc') }}">Tin tức về xe</a></li>
                                <li><a href="#">Quy định & Hướng dẫn</a></li>
                                <li><a class="last" href="#">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="log-reg">
                        <span class="login-signup" data-toggle="modal" ng-click="clickOpenModalLog()" data-target="#myModalLog"><img src="{{ URL::asset('images/icon-login.png')}}"/> Đăng nhập</span>
                        <span class="login-signup" data-toggle="modal" ng-click="clickOpenModal()" id="openModalReg" data-target="#myModalReg"><img src="{{ URL::asset('images/icon-reg.png')}}"/> Đăng kí</span>
                        <div class="dropdown" style="float:left;">
                            <img class="icon-avatar img-circle"
                                 @if(\Illuminate\Support\Facades\Auth::check())
                                    src="{{ URL::asset($user->avatar)}}"
                                 @else
                                    src="{{ URL::asset('images/icon-avatar.png')}}"
                                 @endif
                                 data-toggle="dropdown"/>
                            @if(\Illuminate\Support\Facades\Auth::check())
                            <div class="dropdown-menu cover-logout">
                                <div class="cover-avatar-logout">
                                    <img class="img-circle" src="{{ URL::asset($user->avatar)}}"/>
                                    <div class="info-user">
                                        <p>User: <span>{{$user->username}}</span></p>
                                        <p>Bài đăng: <span>100</span></p>
                                    </div>
                                </div>
                                <a class="bt-logout-homepage bt-logout" href="{{ URL::to('/thong-tin-user/'.$user->id) }}">Trang cá nhân</a>
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
                            <h3 class="name-slide">2013 Acura NSX</h3>
                            <img class="img-slide" src="{{ URL::asset('images/slides/slide 01.png')}}"/>
                            <div class="info-slide">
                                <ul>
                                    <li>
                                        <span class="first-col-info">Tình trạng: Xe mới</span>
                                        <span class="last-col-info">Dòng xe: SUV/ Crossover</span>
                                    </li>
                                    <li>
                                        <span class="first-col-info">Năm SX: 2013</span>
                                        <span class="last-col-info">Thông tin: Phun xăng điện tử</span>
                                    </li>
                                    <li>
                                        <p class="sdt-address">TPHCM - SDT: 0135 784 761</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="bt-detail-slide">
                                <span class="price">1.000.000.000 VND</br>
                                    <small>{bao gồm thuế}</small>
                                </span>
                                <a href="#">CHI TIẾT <img class="icon-arrow" src="{{ URL::asset('images/icon-arrow.png')}}"/></a>
                            </div>
                        </div>
                        <div class="item">
                            <h3 class="name-slide">2013 Acura NSX</h3>
                            <img class="img-slide" src="{{ URL::asset('images/slides/slide 01.png')}}"/>
                            <div class="info-slide">
                                <ul>
                                    <li>
                                        <span class="first-col-info">Tình trạng: Xe mới</span>
                                        <span class="last-col-info">Dòng xe: SUV/ Crossover</span>
                                    </li>
                                    <li>
                                        <span class="first-col-info">Năm SX: 2013</span>
                                        <span class="last-col-info">Thông tin: Phun xăng điện tử</span>
                                    </li>
                                    <li>
                                        <p class="sdt-address">TPHCM - SDT: 0135 784 761</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="bt-detail-slide">
                                <span class="price">2.000.000.000 VND</br>
                                    <small>{bao gồm thuế}</small>
                                </span>
                                <a href="#">CHI TIẾT <img class="icon-arrow" src="{{ URL::asset('images/icon-arrow.png')}}"/></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="center-content-col">
            <div class="filter">
                <form action="#" method="post">
                    <div class="form-filter">
                        <input type="text" class="form-control" name="keyword" placeholder="Từ khóa..."/>
                        <select class="form-control" name="branch">
                            <option>Hãng xe</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                        <select class="form-control" name="branch">
                            <option>Dòng xe</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                        <select class="form-control" name="branch">
                            <option>Giá tiền</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                        <select class="form-control last" name="branch">
                            <option>Tỉnh/Thành</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                    <input class="bt-submit-filter" type="submit" value=" ">
                </form>
            </div>
            @yield('content')
        </div>
        <div class="last-col">
            <div class="avatar">
                <a class="bt-reg-free" href="{{ URL::to('/dang-tin-free') }}">Đăng tin miễn phí</a>
            </div>
            <div class="list-services">
                <div class="item-service">
                    <img class="icon-service" src="{{ URL::asset('images/icon-ser01.png')}}"/>
                    <p>VIP SHOWROOM/ SALON OTO <img class="icon-arrow-right" src="{{ URL::asset('images/icon-arrow-right.png')}}"/></p>
                </div>
                <div class="item-service">
                    <img class="icon-service" src="{{ URL::asset('images/icon-ser02.png')}}"/>
                    <p>ĐỊA CHỈ ĐỘ XE/<br> SỬA XE UY TÍN <img class="icon-arrow-right" src="{{ URL::asset('images/icon-arrow-right.png')}}"/></p>
                </div>
                <div class="item-service">
                    <img class="icon-service" src="{{ URL::asset('images/icon-ser03.png')}}"/>
                    <p>THÔNG TIN CỨU HỘ TRÊN TOÀN QUỐC <img class="icon-arrow-right" src="{{ URL::asset('images/icon-arrow-right.png')}}"/></p>
                </div>
                <div class="item-service">
                    <img class="icon-service" src="{{ URL::asset('images/icon-ser04.png')}}"/>
                    <p>GÓC GIAO LƯU/<br> CHIA SẺ <img class="icon-arrow-right" src="{{ URL::asset('images/icon-arrow-right.png')}}"/></p>
                </div>
            </div>
            <div class="list-news">
                <h3 class="title-list-news"><img src="{{ URL::asset('images/icon-news.png')}}" />TIN TỨC MỚI CẬP NHẬT</h3>
                <ul id="scroller">
                    @foreach($listNewsHome as $val)
                    <li class="item-news">
                        <a href="{{ URL::to('tin-tuc/'.$val->id.'/'.str_slug($val->title, '-')) }}"><img src="{{ URL::asset($val->image)}}"/></a>
                        <span>{{date_format(date_create($val->created_date), 'd/m/Y H:i a')}}</span>
                        <a class="title-item-news" href="{{ URL::to('tin-tuc/'.$val->id.'/'.str_slug($val->title, '-')) }}">{{$val->title}}</a>
                        <a class="bt-detail-news" href="{{ URL::to('tin-tuc/'.$val->id.'/'.str_slug($val->title, '-')) }}">Chi tiết<small> >> </small></a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="footer">
            <div class="info">
                <p>Vietnamoto.net - Bản quyền @ 2017 Goldlands.vn</p>
                <span>Địa chỉ: 02, Phạm Văn Đồng, P. Linh Đông, Q. Thủ Đức, Tp.HCM - Điện thoại: 0970 7777 929</span>
                <span>Email: batdongsangoldlands@gmail.com</span>
                <span>Website: www.vietnamoto.net - www.goldlands.vn</span>
            </div>
            <div class="menu-bottom">
                <ul>
                    <li><a href="{{ URL::to('') }}">Trang chủ</a> </li>
                    <li><a href="#">Vip Showroom<br>Salon Oto</a> </li>
                    <li><a href="#">Địa chỉ sửa xe<br>độ xe uy tín</a> </li>
                    <li><a href="#">Thông tin cứu hộ<br>trên toàn quốc</a> </li>
                    <li><a href="#">Góc giao lưu<br>Chia sẻ</a> </li>
                    <li><a href="{{ URL::to('tin-tuc') }}">Tin tức về xe</a> </li>
                    <li><a href="#">Quy định &<br>Hướng dẫn</a> </li>
                </ul>
            </div>
            <div class="social-bottom">
                <!--<a href="#"><img src="./images/icon-fb-bottom.png"/></a>
                <a href="#"><img src="./images/icon-twitter-bottom.png"/></a>
                <a href="#"><img src="./images/icon-yb-bottom.png"/></a>-->
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
                                <input ng-model="formData.phone" class="inp form-control" name="phone" required type="number"/>
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
                    <span id="click-to-log-popup">CLICK ĐỂ ĐĂNG NHẬP VIETNAMOTO.NET</span>
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
                            <input ng-model="formDataLog.phone" ng-model="phone" class="inp form-control" type="number" name="phone" required/>
                            <p ng-show="logForm.phone.$invalid && logForm.$submitted" class="error-valid">Bạn chưa nhập số điện thoại.</p>
                            <p ng-show="notexistphone" class="error-valid">Số điện thoại này chưa được đăng ký</p>
                        </li>
                        <li>
                            <span>Mật khẩu:</span>
                            <input ng-model="formDataLog.password" type="password" class="inp form-control" name="pass" required/>
                            <p ng-show="logForm.pass.$invalid && logForm.$submitted" class="error-valid">Bạn chưa nhập mật khẩu.</p>
                            <p ng-show="wrongpass" class="error-valid">Mật khẩu chưa đúng</p>
                        </li>
                        <li>
                            <input class="bt-in-pop" type="submit" value="Đăng nhập"/>
                        </li>
                    </ul>
                    <a class="a-forgot" href="#"><img src="{{ URL::asset('images/icon-question.png')}}"/> Bạn quên mật khẩu của mình?</a>
                    <span class="spa-reg"><img src="{{ URL::asset('images/icon-reg.png')}}"/> Bạn chưa có tài khoản. Hãy <a class="a-regs" href="#">đăng ký</a> cùng chúng tôi</span>
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
        function resetForm(){
            $scope.regForm.$setPristine();
            $scope.regForm.$setUntouched();
        };
        $scope.clickOpenModal = function(){
            $scope.showAfter = false;
            $scope.showBefore = true;
            resetForm();
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
        }
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
            $http({
                method: 'POST',
                url: '/login-frontend',
                data: $.param($scope.formDataLog),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .success(function (data) {
                if (data.status == true) {
                    location.reload();
                }else{
                    if (data.message == 'phone_not_exit') {
                        $scope.notexistphone = true;
                    } else {
                        $scope.wrongpass = true;
                    }
                }
            });
        }
    });

    (function($) {
        $(function() { //on DOM ready
            $("#scroller").simplyScroll({
                customClass: 'vert',
                orientation: 'vertical',
                auto: true,
                manualMode: 'loop',
                frameRate: 20,
                speed: 1
            });
            $("#scrollerSalon").simplyScroll({
                customClass: 'hori',
                orientation: 'horizontal',
                auto: true,
                manualMode: 'loop',
                frameRate: 20,
                speed: 1
            });
            $( ".inner-item" ).hover(function() {
                $( this ).children(":first").fadeIn('fast');
            }, function(){
                $(this).children(":first").fadeOut('fast');
            });
            $("#click-to-log-popup").click(function(){
                $("#myModalLog").modal('show');
                $("#myModalReg").modal('hide');
            });

        });
    })(jQuery);
</script>
</body>
</html>