@extends('Layouts.frontend')
<style>
    .container-fluid{
        background: none !important;
    }
    .img-header-news-page{
        width: 290px;
    }
    @media (max-width: 980px){
        .img-header-news-page {
            width: 60% !important;
        }
    }
</style>
@section('content')
    <div class="news-page">
        <div class="header-news">
            <img class="img-header-news-page" src="{{ URL::asset('images/icon-contact.png')}}"/>
            <img class="line-header" src="{{ URL::asset('images/line-news-page.png')}}"/>
        </div>
        <div class="contact-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2731.2846498090685!2d106.71564028673612!3d10.826395127634676!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa03758367749c2e4!2sVietnamoto.net!5e0!3m2!1sen!2s!4v1490591460107" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
        <div class="contact-form">
            <ul>
                <form action="#" method="post">
                    <li><img src="{{ URL::asset('images/icon-email-contact.png')}}"/><span> Email của bạn</span></li>
                    <li><input class="inp" type="text" name="email"/></li>
                    <li><img src="{{ URL::asset('images/icon-content-contact.png')}}"/><span> Nhập nội dung</span></li>
                    <li>
                        <textarea class="text-area" name="content"></textarea>
                    </li>
                    <li>
                        <input type="submit" value="GỬI TIN" class="bt-send"/>
                    </li>
                </form>
            </ul>
        </div>
        <div class="contact-info">
            <ul>
                <li><img src="{{ URL::asset('images/icon-line-contact.png')}}"/></li>
                <li><span>Nếu bạn có khó khăn trong việc đăng tin, xóa  tin đăng, quên mật khẩu truy cập, hay có ý kiến đóng xây dựng website.</span></li>
                <li><span>Liên hệ : <b>http://vietnamoto.net</b> - Hotline : <b>089 815 4544</b></span></li>
                <li><span>Địa chỉ: 02 Phạm Văn Đồng, Phường Linh Đông, Quận Thủ Đức, TPHCM</span></li>
                <li><span>Email: customerservice@vietnamoto.net</span></li>
            </ul>
        </div>
    </div>
@stop