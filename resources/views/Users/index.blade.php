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
                        <li><span>Số điện thoại: </span><input type="number" ng-model="formDataInfo.phone" class="text-inp" name="phone"/></li>
                        <li><span>Địa chỉ: </span><input ng-model="formDataInfo.address" class="text-inp" name="address"/></li>
                        <li><span>Lĩnh vực kinh doanh: </span><input ng-model="formDataInfo.major" class="text-inp" name="career"/></li>
                        <li><span>Sở thích: </span><input class="text-inp" ng-model="formDataInfo.hobby" name="hobby"/>
                            <div class="alert alert-success alert-update-success" id="success-alert-update">
                                <button type="button" class="close" data-dismiss="alert"> x</button>
                                <strong>Chúc mừng! Thông tin của bạn đã được lưu thành công. </strong>
                            </div>
                        </li>
                    </ul>
                    <input class="bt-complete" type="submit" value="Hoàn thành"/>
                </form>
            </div>
            <div class="div-info-user div-user-info-last">
                <h3>THAY ĐỔI PASSWORD</h3>
                <form  name="changePasswordForm" ng-submit="clickChangePassword()" novalidate>
                    <ul>
                        <li><span>*Số điện thoại: </span>
                            <input ng-model="formDataChangePass.phone" required type="number" class="text-inp" name="phone"/>
                            <p ng-show="changePasswordForm.phone.$invalid && changePasswordForm.$submitted" class="error-valid">Bạn chưa nhập số điện thoại.</p>
                        </li>
                        <li><span>*Mật khẩu cũ: </span>
                            <input ng-model="formDataChangePass.password" type="password" required class="text-inp" name="password"/>
                            <p ng-show="changePasswordForm.password.$invalid && changePasswordForm.$submitted" class="error-valid">Bạn chưa nhập mật khẩu cũ.</p>
                        </li>
                        <li><span>*Mật khẩu mới: </span>
                            <input ng-model="formDataChangePass.newpassword" type="password" required class="text-inp" name="newpassword"/>
                            <p ng-show="changePasswordForm.newpassword.$invalid && changePasswordForm.$submitted" class="error-valid">Bạn chưa nhập mật khẩu mới.</p>
                            <div class="alert alert-success alert-update-success" id="success-alert-change">
                                <button type="button" class="close" data-dismiss="alert"> x</button>
                                <strong>Chúc mừng! Mật khẩu đã thay đổi thành công. </strong>
                            </div>
                            <div class="alert alert-danger alert-update-success" id="wrong-phone-alert-change">
                                <button type="button" class="close" data-dismiss="alert"> x</button>
                                <strong>Nhập số điện thoại chưa đúng. </strong>
                            </div>
                            <div class="alert alert-danger alert-update-success" id="wrong-pass-alert-change">
                                <button type="button" class="close" data-dismiss="alert"> x</button>
                                <strong>Nhập mật khẩu cũ chưa đúng.</strong>
                            </div>
                        </li>
                    </ul>
                    <input class="bt-complete" type="submit" value="Thay đổi"/>
                </form>
            </div>
        </div>
        <div id="post" class="tab-pane fade">
            <div class="list-items">
                @foreach($listPost as $item)
                <div class="col-md-4 item">
                    <div class="inner-item">
                        <div class="hover-item">
                            <div class="cover-zoom">
                                <a href="{{ URL::to('/bai-dang/'.$item->id.'/'.str_slug($item->tieu_de, '-')) }}"><img src="./images/icon-zoom.png"/></a>
                                <a class="detail" href="{{ URL::to('/bai-dang/'.$item->id.'/'.str_slug($item->tieu_de, '-')) }}">Xem Chi Tiết</a>
                            </div>
                        </div>
                        <div class="left-item">
                            <img src="./images/item-car.png"/>
                            <span class="price">{{$item->thongso['thongso_65']}} VND</span>
                        </div>
                        <div class="right-item">
                            <h4>{{$item->tieu_de}}</h4>
                            <p>- Tình trạng: {{$item->thongso['thongso_24']}}</p>
                            <p>- Dòng xe: {{$item->thongso['thongso_25']}}</p>
                            <p>- Năm SX: {{$item->thongso['thongso_22']}}</p>
                            <p>- {{$item->thongso['thongso_31']}}</p>
                            <p class="phone-address-item">- {{$item->thongso['thongso_62']}} - {{$item->thongso['thongso_63']}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
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