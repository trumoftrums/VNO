@extends('Layouts.frontend')

@section('content')
    <div class="banner-profile">
        <div class="cover-avatar-profile">
            <form method="post" action="" id="upload_file" enctype="multipart/form-data">
                <span class="change-ava">Thay đổi</span>
                <input type="file" name="userfile" id="userfile" size="20" class="upload-avatar" alt="Thay đổi avatar"/>
            </form>
            <img class="img-circle" id="ava-img"
                 @if($user->avatar != null)
                 src="{{ URL::asset($user->avatar)}}"
                 @else
                 src="{{ URL::asset('images/icon-avatar.png')}}"
                    @endif
            />
            <p>{{$user->username}}</p>
        </div>
        <img class="img-banner-profile"
             @if($user->image_profile != null)
             src="{{ URL::asset($user->image_profile)}}"
             @else
             src="{{ URL::asset('images/img-profile-user.png')}}"
            @endif
             />
    </div>
    <ul class="ul-cover-tab">
        <li @if($activeTab == '')class="active" @endif><a data-toggle="tab" href="#info">CẬP NHẬT THÔNG TIN</a></li>
        <li @if($activeTab != '') class="active" @endif><a data-toggle="tab" href="#post">TỒNG BÀI ĐĂNG ({{$totalPost}})</a></li>
    </ul>

    <div class="cover-tab tab-content">
        <div id="info" class="tab-pane fade @if($activeTab == '') in active @endif">
            <div class="div-info-user">
                <h3>BỔ SUNG THÔNG TIN ĐỂ CHÚNG TA HIỂU NHAU HƠN BẠN NHÉ!</h3>
                <form name="infoForm" ng-submit="clickUpdateInfo()" novalidate>
                    <ul>
                        <li><span>Nickname: </span><input ng-model="formDataInfo.username" class="text-inp" type="text" name="nickname"/></li>
                        <li><span>Email của bạn: </span><input ng-model="formDataInfo.email" class="text-inp" name="email"/></li>
                        <li><span>Số điện thoại: </span><input style="opacity: 0.5;" type="text" ng-model="formDataInfo.phone" class="text-inp number-only" name="phone" readonly/></li>
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
                            <input ng-model="formDataChangePass.phone" required type="text" class="text-inp number-only" name="phone"/>
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
        <div id="post" class="tab-pane fade @if($activeTab != '') in active @endif">
            <div class="list-items">
                @if(count($listPost)>0)
                    @foreach($listPost as $item)
                        <div class="col-lg-4 col-md-6 col-sm-6 item">
                            <div class="inner-item">
                                <div class="hover-item">
                                    <div class="cover-zoom">
                                        <a href="{{ URL::to('/dang-tin-free/'.$item->id.'-'.str_slug($item->tieu_de, '-')) }}"><img src="./images/icon-edit.png"/></a>
                                        <a rel="nofollow" class="detail" href="{{ URL::to('/dang-tin-free/'.$item->id.'-'.str_slug($item->tieu_de, '-')) }}">Chỉnh sửa</a>
                                    </div>
                                </div>
                                <div class="left-item">
                                    <img src="./uploads/baiviet/{{$item->photo1}}"/>
                                    <span class="price">{{$item->thongso['thongso_65']}} VND</span>
                                </div>
                                <div class="right-item">
                                    <h4>{{$item->tieu_de}}</h4>
                                    <p>- Tình trạng: {{$item->thongso['thongso_24']}}</p>
                                    <p>- Dáng xe: {{$item->thongso['thongso_25']}}</p>
                                    <p>- Năm SX: {{$item->thongso['thongso_22']}}</p>
                                    <p>- Nhiên liệu: {{$item->thongso['thongso_32']}}</p>
                                    <p class="phone-address-item">- {{$item->thongso['thongso_62']}} - {{$item->thongso['thongso_63']}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Chưa có dữ liệu. Vui lòng thử lại sau.</p>
                @endif
                <div class="paging-div">
                    <?php if(!empty($listPost)) echo $listPost->links() ?>
                </div>
            </div>
        </div>
    </div>
@stop