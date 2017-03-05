@extends('Layouts.frontend')
<style>
    .container-fluid{
        background: none !important;
    }
    .img-header-news-page {
        width: 360px !important;
    }
</style>
@section('content')
    <div class="news-page">
        <div class="header-news">
            <img class="img-header-news-page" src="{{ URL::asset('images/icon-dich-vu-huong-dan.png')}}"/>
            <img class="line-header" src="{{ URL::asset('images/line-news-page.png')}}"/>
        </div>
        <div class="list-news-page" id="style-4">
            <div class="cover-ul-guide">
                <ul class="ul-guide-tab">
                    <li class="active"><a data-toggle="tab" href="#guide-tb1">BẢNG GIÁ <br> BANNER</a></li>
                    <img class="point-green" src="{{ URL::asset('images/point-green.png')}}"/>
                    <li><a data-toggle="tab" href="#guide-tb2">BẢNG GIÁ<br> ĐĂNG TIN </a></li>
                    <img class="point-green" src="{{ URL::asset('images/point-green.png')}}"/>
                    <li><a data-toggle="tab" href="#guide-tb3">BẢNG GIÁ<br> BÀI PR </a></li>
                    <img class="point-green" src="{{ URL::asset('images/point-green.png')}}"/>
                    <li><a data-toggle="tab" href="#guide-tb4">PHƯƠNG THỨC<br> THANH TOÁN </a></li>
                </ul>
            </div>
            <div class="cover-guide-tab tab-content">
                <div id="guide-tb1" class="tab-pane fade in active">
                    <img src="{{ URL::asset('images/guide/bang-gia-banner.png')}}"/>
                    <div style="height: 80px;float:left;"></div>
                </div>
                <div id="guide-tb2" class="tab-pane fade in">
                    <img src="{{ URL::asset('images/guide/bang-gia-dang-tin.png')}}"/>
                </div>
                <div id="guide-tb3" class="tab-pane fade in">
                    <img src="{{ URL::asset('images/guide/bang-gia-pr.png')}}"/>
                </div>
                <div id="guide-tb4" class="tab-pane fade in">
                    <img src="{{ URL::asset('images/guide/phuong-thuc-thanh-toan.png')}}"/>
                </div>
            </div>
        </div>
    </div>
@stop