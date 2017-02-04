@extends('Layouts.frontend')

@section('content')
    <div class="banner-profile">
        <div class="cover-avatar-profile">
            <img class="img-circle"
                 @if($user->avatar != null)
                 src="{{ URL::asset($user->avatar)}}"
                 @else
                 src="{{ URL::asset('images/icon-avatar.png')}}"
            @endif
            />
            <p>{{$user->username}}</p>
        </div>
        <img class="img-banner-profile" src="{{ URL::asset('images/img-profile-user.png')}}"/>
    </div>
    <ul class="ul-cover-tab">
        <li class="active"><a data-toggle="tab" href="#info">CẬP NHẬT THÔNG TIN</a></li>
        <li><a data-toggle="tab" href="#post">TỒNG BÀI ĐĂNG ({{$totalPost}})</a></li>
    </ul>

    <div class="cover-tab tab-content">
        <div id="info" class="tab-pane fade in active">
            <div class="div-info-user">
                <h3>BỔ SUNG THÔNG TIN ĐỂ CHÚNG TA HIỂU NHAU HƠN BẠN NHÉ!</h3>
                <form name="infoForm" ng-submit="clickUpdateInfo()" novalidate>
                    <ul>
                        <li><span>Nickname: </span><input ng-model="formDataInfo.username" class="text-inp" type="text" name="nickname"/></li>
                        <li><span>Email của bạn: </span><input ng-model="formDataInfo.email" class="text-inp" name="email"/></li>
                        <li><span>Số điện thoại: </span><input ng-model="formDataInfo.phone" class="text-inp" name="phone"/></li>
                        <li><span>Địa chỉ: </span><input ng-model="formDataInfo.address" class="text-inp" name="address"/></li>
                        <li><span>Lĩnh vực kinh doanh: </span><input ng-model="formDataInfo.major" class="text-inp" name="career"/></li>
                        <li><span>Sở thích: </span><input class="text-inp" ng-model="formDataInfo.hobby" name="hobby"/></li>
                    </ul>
                    <input class="bt-complete" type="submit" value="Hoàn thành"/>
                </form>
            </div>
            <div class="div-info-user div-user-info-last">
                <h3>THAY ĐỔI PASSWORD</h3>
                <form  name="changePasswordForm" ng-submit="clickChangePassword()" novalidate>
                    <ul>
                        <li><span>*Số điện thoại: </span><input ng-model="formDataChangePass.phone" required type="number" class="text-inp" name="phone"/></li>
                        <li><span>*Mật khẩu cũ: </span><input ng-model="formDataChangePass.password" required class="text-inp" name="phone"/></li>
                        <li><span>*Mật khẩu mới: </span><input ng-model="formDataChangePass.newpassword" required class="text-inp" name="phone"/></li>
                    </ul>
                    <input class="bt-complete" type="submit" value="Thay đổi"/>
                </form>
            </div>
        </div>
        <div id="post" class="tab-pane fade">
            <div class="list-items">
                <div class="col-md-4 item">
                    <div class="inner-item">
                        <div class="hover-item">
                            <div class="cover-zoom">
                                <a href="#"><img src="./images/icon-zoom.png"/></a>
                                <a class="detail" href="#">Xem Chi Tiết</a>
                            </div>
                        </div>
                        <div class="left-item">
                            <img src="./images/item-car.png"/>
                            <span class="price">2.706.000.000 VND</span>
                        </div>
                        <div class="right-item">
                            <h4>LEXUS NX300H-2016</h4>
                            <p>- Tình trạng: Xe mới</p>
                            <p>- Dòng xe: SUV/ Crossover</p>
                            <p>- Năm SX: 2013</p>
                            <p>- Phun xăng điện tử</p>
                            <p class="phone-address-item">- TPHCM - 090 000 000</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 item">
                    <div class="inner-item">
                        <div class="hover-item">
                            <div class="cover-zoom">
                                <a href="#"><img src="./images/icon-zoom.png"/></a>
                                <a class="detail" href="#">Xem Chi Tiết</a>
                            </div>
                        </div>
                        <div class="left-item">
                            <img src="./images/item-car.png"/>
                            <span class="price">2.706.000.000 VND</span>
                        </div>
                        <div class="right-item">
                            <h4>LEXUS NX300H-2016</h4>
                            <p>- Tình trạng: Xe mới</p>
                            <p>- Dòng xe: SUV/ Crossover</p>
                            <p>- Năm SX: 2013</p>
                            <p>- Phun xăng điện tử</p>
                            <p class="phone-address-item">- TPHCM - 090 000 000</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 item">
                    <div class="inner-item">
                        <div class="hover-item">
                            <div class="cover-zoom">
                                <a href="#"><img src="./images/icon-zoom.png"/></a>
                                <a class="detail" href="#">Xem Chi Tiết</a>
                            </div>
                        </div>
                        <div class="left-item">
                            <img src="./images/item-car.png"/>
                            <span class="price">2.706.000.000 VND</span>
                        </div>
                        <div class="right-item">
                            <h4>LEXUS NX300H-2016</h4>
                            <p>- Tình trạng: Xe mới</p>
                            <p>- Dòng xe: SUV/ Crossover</p>
                            <p>- Năm SX: 2013</p>
                            <p>- Phun xăng điện tử</p>
                            <p class="phone-address-item">- TPHCM - 090 000 000</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 item">
                    <div class="inner-item">
                        <div class="hover-item">
                            <div class="cover-zoom">
                                <a href="#"><img src="./images/icon-zoom.png"/></a>
                                <a class="detail" href="#">Xem Chi Tiết</a>
                            </div>
                        </div>
                        <div class="left-item">
                            <img src="./images/item-car.png"/>
                            <span class="price">2.706.000.000 VND</span>
                        </div>
                        <div class="right-item">
                            <h4>LEXUS NX300H-2016</h4>
                            <p>- Tình trạng: Xe mới</p>
                            <p>- Dòng xe: SUV/ Crossover</p>
                            <p>- Năm SX: 2013</p>
                            <p>- Phun xăng điện tử</p>
                            <p class="phone-address-item">- TPHCM - 090 000 000</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 item">
                    <div class="inner-item">
                        <div class="hover-item">
                            <div class="cover-zoom">
                                <a href="#"><img src="./images/icon-zoom.png"/></a>
                                <a class="detail" href="#">Xem Chi Tiết</a>
                            </div>
                        </div>
                        <div class="left-item">
                            <img src="./images/item-car.png"/>
                            <span class="price">2.706.000.000 VND</span>
                        </div>
                        <div class="right-item">
                            <h4>LEXUS NX300H-2016</h4>
                            <p>- Tình trạng: Xe mới</p>
                            <p>- Dòng xe: SUV/ Crossover</p>
                            <p>- Năm SX: 2013</p>
                            <p>- Phun xăng điện tử</p>
                            <p class="phone-address-item">- TPHCM - 090 000 000</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 item">
                    <div class="inner-item">
                        <div class="hover-item">
                            <div class="cover-zoom">
                                <a href="#"><img src="./images/icon-zoom.png"/></a>
                                <a class="detail" href="#">Xem Chi Tiết</a>
                            </div>
                        </div>
                        <div class="left-item">
                            <img src="./images/item-car.png"/>
                            <span class="price">2.706.000.000 VND</span>
                        </div>
                        <div class="right-item">
                            <h4>LEXUS NX300H-2016</h4>
                            <p>- Tình trạng: Xe mới</p>
                            <p>- Dòng xe: SUV/ Crossover</p>
                            <p>- Năm SX: 2013</p>
                            <p>- Phun xăng điện tử</p>
                            <p class="phone-address-item">- TPHCM - 090 000 000</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 item">
                    <div class="inner-item">
                        <div class="hover-item">
                            <div class="cover-zoom">
                                <a href="#"><img src="./images/icon-zoom.png"/></a>
                                <a class="detail" href="#">Xem Chi Tiết</a>
                            </div>
                        </div>
                        <div class="left-item">
                            <img src="./images/item-car.png"/>
                            <span class="price">2.706.000.000 VND</span>
                        </div>
                        <div class="right-item">
                            <h4>LEXUS NX300H-2016</h4>
                            <p>- Tình trạng: Xe mới</p>
                            <p>- Dòng xe: SUV/ Crossover</p>
                            <p>- Năm SX: 2013</p>
                            <p>- Phun xăng điện tử</p>
                            <p class="phone-address-item">- TPHCM - 090 000 000</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 item">
                    <div class="inner-item">
                        <div class="hover-item">
                            <div class="cover-zoom">
                                <a href="#"><img src="./images/icon-zoom.png"/></a>
                                <a class="detail" href="#">Xem Chi Tiết</a>
                            </div>
                        </div>
                        <div class="left-item">
                            <img src="./images/item-car.png"/>
                            <span class="price">2.706.000.000 VND</span>
                        </div>
                        <div class="right-item">
                            <h4>LEXUS NX300H-2016</h4>
                            <p>- Tình trạng: Xe mới</p>
                            <p>- Dòng xe: SUV/ Crossover</p>
                            <p>- Năm SX: 2013</p>
                            <p>- Phun xăng điện tử</p>
                            <p class="phone-address-item">- TPHCM - 090 000 000</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 item">
                    <div class="inner-item">
                        <div class="hover-item">
                            <div class="cover-zoom">
                                <a href="#"><img src="./images/icon-zoom.png"/></a>
                                <a class="detail" href="#">Xem Chi Tiết</a>
                            </div>
                        </div>
                        <div class="left-item">
                            <img src="./images/item-car.png"/>
                            <span class="price">2.706.000.000 VND</span>
                        </div>
                        <div class="right-item">
                            <h4>LEXUS NX300H-2016</h4>
                            <p>- Tình trạng: Xe mới</p>
                            <p>- Dòng xe: SUV/ Crossover</p>
                            <p>- Năm SX: 2013</p>
                            <p>- Phun xăng điện tử</p>
                            <p class="phone-address-item">- TPHCM - 090 000 000</p>
                        </div>
                    </div>
                </div>
                <div class="paging-div">
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-sm">
                            <li>
                                <a href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li>
                                <a href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@stop