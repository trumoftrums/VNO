@extends('Layouts.frontend')

@section('content')
    <div class="banner-profile">
        <div class="cover-avatar-profile">
            <img class="img-circle" src="./images/nghiem_bao_pic.png"/>
            <p>Nghiem Bao</p>
        </div>
        <img class="img-banner-profile" src="./images/img-profile-user.png"/>
    </div>
    <ul class="ul-cover-tab">
        <li class="active"><a data-toggle="tab" href="#info">CẬP NHẬT THÔNG TIN</a></li>
        <li><a data-toggle="tab" href="#post">TỒNG BÀI ĐĂNG (100)</a></li>
    </ul>

    <div class="cover-tab">
        <div id="info" class="tab-pane fade in active">
            <div class="div-info-user">
                <h3>BỔ SUNG THÔNG TIN ĐỂ CHÚNG TA HIỂU NHAU HƠN BẠN NHÉ!</h3>
                <form>
                    <ul>
                        <li><span>Nickname: </span><input class="text-inp" name="nickname"/></li>
                    </ul>
                </form>
            </div>
            <div class="div-info-user div-user-info-last">
                <h3>THAY ĐỔI PASSWORD</h3>
                <form>
                    <ul>
                        <li><span>Nickname: </span><input class="text-inp" name="nickname"/></li>
                    </ul>
                </form>
            </div>
        </div>
        <div id="post" class="tab-pane fade">
            <h3>Menu 1</h3>
            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
    </div>
@stop