<html>
<html lang="en">
<head>
    <title>Vietnam Oto</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.simplyscroll.css">
    <link rel="stylesheet" href="css/style_vno.css">
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/jquery.simplyscroll.min.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
</head>
<body ng-app="myApp">
<div class="container-fluid">
    <div class="header">
        <div class="first-col">
            <div class="cover-logo">
                <div class="menu-log-reg">
                    <div class="menu">
                        <div class="dropdown">
                            <span class="icon-menu" data-toggle="dropdown">
                                <img src="./images/icon-menu.png"/>
                            </span>
                            <ul class="dropdown-menu">
                                <span class="close-menu"> <img src="./images/icon-close-menu.png"/> </span>
                                <li><a href="#">Trang Chủ</a></li>
                                <li><a href="#">Vip Showroom/ Salon Oto</a></li>
                                <li><a href="#">Địa Chỉ Sửa Xe/ Độ Xe Uy Tín</a></li>
                                <li><a href="#">Thông tin cứu hộ trên toàn quốc</a></li>
                                <li><a href="#">Góc giao lưu/ Chia sẻ</a></li>
                                <li><a href="#">Tin tức về xe</a></li>
                                <li><a href="#">Quy định & Hướng dẫn</a></li>
                                <li><a class="last" href="#">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="log-reg">
                        <span data-toggle="modal" data-target="#myModalLog"><img src="./images/icon-login.png"/> Đăng nhập</span>
                        <span data-toggle="modal" id="openModalReg" data-target="#myModalReg"><img src="./images/icon-reg.png"/> Đăng kí</span>
                        <img class="icon-avatar" src="./images/icon-avatar.png"/>
                    </div>
                </div>
                <div class="logo">
                    <div class="social">
                        <ul>
                            <li><a href="#"><img src="./images/icon-fb.png" /></a> </li>
                            <li><a href="#"><img src="./images/icon-twitter.png" /></a> </li>
                            <li><a href="#"><img src="./images/icon-yb.png" /></a> </li>
                        </ul>
                    </div>
                    <a href="#"><img class="logo-vno" src="./images/logo.png"/></a>
                </div>
                <div class="slogan">
                    <a href="#"><img src="./images/slogan.png"/></a>
                </div>
            </div>
            <div class="slide-show">
                <div class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <h3 class="name-slide">2013 Acura NSX</h3>
                            <img class="img-slide" src="./images/slides/slide 01.png"/>
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
                                <a href="#">CHI TIẾT <img class="icon-arrow" src="./images/icon-arrow.png"/></a>
                            </div>
                        </div>
                        <div class="item">
                            <h3 class="name-slide">2013 Acura NSX</h3>
                            <img class="img-slide" src="./images/slides/slide 01.png"/>
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
                                <a href="#">CHI TIẾT <img class="icon-arrow" src="./images/icon-arrow.png"/></a>
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
                <a class="bt-reg-free" href="#">Đăng tin miễn phí</a>
            </div>
            <div class="list-services">
                <div class="item-service">
                    <img class="icon-service" src="./images/icon-ser01.png"/>
                    <p>VIP SHOWROOM/ SALON OTO <img class="icon-arrow-right" src="./images/icon-arrow-right.png"/></p>
                </div>
                <div class="item-service">
                    <img class="icon-service" src="./images/icon-ser02.png"/>
                    <p>ĐỊA CHỈ ĐỘ XE/<br> SỬA XE UY TÍN <img class="icon-arrow-right" src="./images/icon-arrow-right.png"/></p>
                </div>
                <div class="item-service">
                    <img class="icon-service" src="./images/icon-ser03.png"/>
                    <p>THÔNG TIN CỨU HỘ TRÊN TOÀN QUỐC <img class="icon-arrow-right" src="./images/icon-arrow-right.png"/></p>
                </div>
                <div class="item-service">
                    <img class="icon-service" src="./images/icon-ser04.png"/>
                    <p>GÓC GIAO LƯU/<br> CHIA SẺ <img class="icon-arrow-right" src="./images/icon-arrow-right.png"/></p>
                </div>
            </div>
            <div class="list-news">
                <h3 class="title-list-news"><img src="./images/icon-news.png" />TIN TỨC MỚI CẬP NHẬT</h3>
                <ul id="scroller">
                    <li class="item-news">
                        <a href="#"><img src="./images/news01.png"/></a>
                        <span>01/01/2017 8:30 AM</span>
                        <a class="title-item-news" href="#">Các dòng xe dành cho quý ông việt</a>
                        <a class="bt-detail-news" href="#">Chi tiết<small> >> </small></a>
                    </li>
                    <li class="item-news">
                        <a href="#"><img src="./images/news02.png"/></a>
                        <span>01/01/2017 8:30 AM</span>
                        <a class="title-item-news" href="#">Chương trình giải thưởng từ VNO</a>
                        <a class="bt-detail-news" href="#">Chi tiết<small> >> </small></a>
                    </li>
                    <li class="item-news">
                        <a href="#"><img src="./images/news03.png"/></a>
                        <span>01/01/2017 8:30 AM</span>
                        <a class="title-item-news" href="#">Thăm showroom mới của MISHUBISHI</a>
                        <a class="bt-detail-news" href="#">Chi tiết<small> >> </small></a>
                    </li>
                    <li class="item-news">
                        <a href="#"><img src="./images/news01.png"/></a>
                        <span>01/01/2017 8:30 AM</span>
                        <a class="title-item-news" href="#">Các dòng xe dành cho quý ông việt</a>
                        <a class="bt-detail-news" href="#">Chi tiết<small> >> </small></a>
                    </li>
                    <li class="item-news">
                        <a href="#"><img src="./images/news02.png"/></a>
                        <span>01/01/2017 8:30 AM</span>
                        <a class="title-item-news" href="#">Chương trình giải thưởng từ VNO</a>
                        <a class="bt-detail-news" href="#">Chi tiết<small> >> </small></a>
                    </li>
                    <li class="item-news">
                        <a href="#"><img src="./images/news03.png"/></a>
                        <span>01/01/2017 8:30 AM</span>
                        <a class="title-item-news" href="#">Thăm showroom mới của MISHUBISHI</a>
                        <a class="bt-detail-news" href="#">Chi tiết<small> >> </small></a>
                    </li>
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
                    <li><a href="#">Trang chủ</a> </li>
                    <li><a href="#">Vip Showroom<br>Salon Oto</a> </li>
                    <li><a href="#">Địa chỉ sửa xe<br>độ xe uy tín</a> </li>
                    <li><a href="#">Thông tin cứu hộ<br>trên toàn quốc</a> </li>
                    <li><a href="#">Góc giao lưu<br>Chia sẻ</a> </li>
                    <li><a href="#">Tin tức về xe</a> </li>
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
<div ng-controller="registerCtrl" id="myModalReg" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <img src="./images/icon-close-popup.png"/>
                </button>
                <img class="img-logo-popup" src="./images/logo.png"/>
                <img class="img-slogan-popup" src="./images/slogan-reg.png"/>
            </div>
            <img class="img-line" src="./images/line.png"/>
            <div class="modal-body">
                <div  class="before-reg">
                    <p class="p-in-pop">HÃY ĐĂNG KÝ ĐỂ NHẬN THÔNG TIN VÀ TÍCH ĐIỂM NHẬN GIẢI THƯỞNG KHI LÀ THÀNH VIÊN CỦA VIETNAMOTO.NET</p>
                    <form class="form-reg" id="form-reg">
                        <ul>
                            <li>
                                <span>Số điện thoại:</span>
                                <input ng-model="formData.phone" class="inp form-control" name="phone"/>
                            </li>
                            <li>
                                <span>Mật khẩu:</span>
                                <input ng-model="formData.password" type="password" class="inp form-control" name="pass"/>
                            </li>
                            <li>
                                <span>Nhập lại mật khẩu:</span>
                                <input ng-model="formData.repassword" class="inp form-control" type="password" name="re-pass"/>
                            </li>
                            <li>
                                <input ng-click="clickRegister()" class="bt-in-pop" type="button" value="Đăng ký"/>
                            </li>
                        </ul>
                    </form>
                    <p class="p-in-pop">KHI ĐĂNG KÝ TỨC LÀ BẠN ĐÃ CHẤP NHẬN MỌI ĐIỀU KHOẢN TỪ VIETNAMOTO.NET</p>
                </div>
                <div class="after-reg" >
                    <h3>ĐĂNG KÝ THÀNH CÔNG</h3>
                    <H4>CHÀO MỪNG BẠN ĐẾN VỚI VIETNAMOTO.NET</H4>
                    <span id="click-to-log-popup">CLICK ĐỂ ĐĂNG NHẬP VIETNAMOTO.NET</span>
                    <p class="p-in-pop-reg" style="padding: 0px 60px;">HÃY ĐĂNG BÀI VÀ CHIA SẼ ĐỂ TÍCH ĐIỂM ĐỂ NHẬN GIẢI THƯỞNG TỪ VIETNAMOTO.NET</p>
                    <div class="social-popup">
                        <a href="#"><img src="./images/icon-fb.png"/></a>
                        <a href="#"><img src="./images/icon-twitter.png"/></a>
                        <a href="#"><img src="./images/icon-yb.png"/></a>
                        <a href="#"><img src="./images/icon-google.png"/></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Modal Login-->
<div ng-controller="loginCtrl" id="myModalLog" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <img src="./images/icon-close-popup.png"/>
                </button>
                <img class="img-logo-popup" src="./images/logo.png"/>
                <img class="img-slogan-popup" src="./images/slogan-reg.png"/>
            </div>
            <img class="img-line" src="./images/line.png"/>
            <div class="modal-body">
                <div class="before-log">
                    <form class="form-reg">
                        <ul>
                            <li>
                                <span>Số điện thoại:</span>
                                <input ng-model="formData.phone" ng-model="phone" class="inp form-control" name="phone"/>
                            </li>
                            <li>
                                <span>Mật khẩu:</span>
                                <input ng-model="formData.password" type="password" class="inp form-control" name="pass"/>
                            </li>
                            <li>
                                <input ng-click="clickLogin()" class="bt-in-pop" type="button" value="Đăng nhập"/>
                            </li>
                        </ul>
                        <a class="a-forgot" href="#"><img src="./images/icon-question.png"/> Bạn quân mật khẩu của mình?</a>
                        <span class="spa-reg"><img src="./images/icon-reg.png"/> Bạn chưa có tài khoản. Hãy <a class="a-regs" href="#">đăng ký</a> cùng chúng tôi</span>
                    </form>
                </div>
                <div class="after-log">
                    dang9 nhap thanh cong
                </div>
            </div>
            <img class="img-line" src="./images/line.png"/>
            <div class="modal-footer">
                <p class="p-in-pop" style="padding: 0px 60px;">HÃY ĐĂNG BÀI VÀ CHIA SẼ ĐỂ TÍCH ĐIỂM ĐỂ NHẬN GIẢI THƯỞNG TỪ VIETNAMOTO.NET</p>
                <div class="social-popup">
                    <a href="#"><img src="./images/icon-fb.png"/></a>
                    <a href="#"><img src="./images/icon-twitter.png"/></a>
                    <a href="#"><img src="./images/icon-yb.png"/></a>
                    <a href="#"><img src="./images/icon-google.png"/></a>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var app = angular.module('myApp', []);
    app.controller('registerCtrl', function ($scope, $http) {
        $('.after-reg').addClass('ng-hide');
        $('.before-reg').removeClass('ng-hide');
        $("#openModalReg").on('click', function () {
            $('.after-reg').addClass('ng-hide');
            $('.before-reg').removeClass('ng-hide');
            $("#form-reg").trigger('reset');
        });
        $scope.clickRegister = function () {
            $http({
                method: 'POST',
                url: '/register',
                data: $.param($scope.formData),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .success(function (data) {
                if (data.status) {
                    $('.before-reg').addClass('ng-hide');
                    $('.after-reg').removeClass('ng-hide');
                }
            });
        }
    });
    app.controller('loginCtrl', function ($scope, $http) {
        $('.after-log').addClass('ng-hide');
        $('.before-log').removeClass('ng-hide');
        $("#openModalLog").on('click', function () {
            $('.after-log').addClass('ng-hide');
            $('.before-log').removeClass('ng-hide');
            $("#form-log").trigger('reset');
        });
        $scope.clickLogin = function () {
            $http({
                method: 'POST',
                url: '/login-frontend',
                data: $.param($scope.formData),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .success(function (data) {
                console.log(data);
                if (data.status) {
                    $('.before-log').addClass('ng-hide');
                    $('.after-log').removeClass('ng-hide');
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