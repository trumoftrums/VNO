@extends('Layouts.frontend')
<style>
    .container-fluid{
        background: none !important;
    }
</style>
@section('content')
    <div class="news-page">
        <div class="header-news">
            <img class="img-header-news-page" src="./images/icon-news-page.png"/>
            <img src="./images/line-news-page.png"/>
        </div>
        <div class="list-news-page" id="style-4">
            <div class="inner-list-news-page" >
                <div class="item-news-page">
                    <a href="{{ URL::to('tin-tuc/1/abc') }}"><img class="img-thumb-item-news" src="./images/img-item-news.png"/></a>
                    <div class="cover-info-item-news">
                        <a href="#" class="title-item-news"><img src="./images/icon-title-news.png"/> Thăm quan: Showroom Vinh auto Tp.Hồ Chí Minh</a>
                        <p class="p-post-by">Đăng bởi <span>Vietnamoto.net</span> - 01/07/2017</p>
                        <p class="summary-news-page">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante...</p>
                        <a class="bt-chi-tiet-news" href="#">Chi tiết <small> >> </small></a>
                    </div>
                </div>
                <div class="item-news-page">
                    <a href="#"><img class="img-thumb-item-news" src="./images/img-item-news.png"/></a>
                    <div class="cover-info-item-news">
                        <a href="#" class="title-item-news"><img src="./images/icon-title-news.png"/> Thăm quan: Showroom Vinh auto Tp.Hồ Chí Minh</a>
                        <p class="p-post-by">Đăng bởi <span>Vietnamoto.net</span> - 01/07/2017</p>
                        <p class="summary-news-page">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante...</p>
                        <a class="bt-chi-tiet-news" href="#">Chi tiết <small> >> </small></a>
                    </div>
                </div>
                <div class="item-news-page">
                    <a href="#"><img class="img-thumb-item-news" src="./images/img-item-news.png"/></a>
                    <div class="cover-info-item-news">
                        <a href="#" class="title-item-news"><img src="./images/icon-title-news.png"/> Thăm quan: Showroom Vinh auto Tp.Hồ Chí Minh</a>
                        <p class="p-post-by">Đăng bởi <span>Vietnamoto.net</span> - 01/07/2017</p>
                        <p class="summary-news-page">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante...</p>
                        <a class="bt-chi-tiet-news" href="#">Chi tiết <small> >> </small></a>
                    </div>
                </div>
                <div class="item-news-page">
                    <a href="#"><img class="img-thumb-item-news" src="./images/img-item-news.png"/></a>
                    <div class="cover-info-item-news">
                        <a href="#" class="title-item-news"><img src="./images/icon-title-news.png"/> Thăm quan: Showroom Vinh auto Tp.Hồ Chí Minh</a>
                        <p class="p-post-by">Đăng bởi <span>Vietnamoto.net</span> - 01/07/2017</p>
                        <p class="summary-news-page">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante...</p>
                        <a class="bt-chi-tiet-news" href="#">Chi tiết <small> >> </small></a>
                    </div>
                </div>
                <div class="item-news-page">
                    <a href="#"><img class="img-thumb-item-news" src="./images/img-item-news.png"/></a>
                    <div class="cover-info-item-news">
                        <a href="#" class="title-item-news"><img src="./images/icon-title-news.png"/> Thăm quan: Showroom Vinh auto Tp.Hồ Chí Minh</a>
                        <p class="p-post-by">Đăng bởi <span>Vietnamoto.net</span> - 01/07/2017</p>
                        <p class="summary-news-page">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante...</p>
                        <a class="bt-chi-tiet-news" href="#">Chi tiết <small> >> </small></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop