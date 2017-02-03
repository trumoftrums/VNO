@extends('Layouts.frontend')
<style>
    .container-fluid{
        background: none !important;
    }
</style>
@section('content')
    <div class="news-page">
        <div class="header-detail-news">
            <h3><img src="{{ URL::asset('images/icon-title-news.png')}}"/> {{$detailNews->title}}</h3>
            <p>Đăng bởi <span>{{$detailNews->username}}</span> - 01/07/2017</p>
        </div>
        <div class="list-news-page" id="style-4">
            <div class="detail-news" >
                <img class="thumb-item-news" src="{{ URL::asset($detailNews->image)}}"/>
                {{$detailNews->description}}
            </div>
            <div class="related-news">
                <h3><img src="{{ URL::asset('images/icon-title-news.png')}}"/> TIN TỨC KHÁC</h3>
                <ul>
                    <li>
                        <a class="bt-detail" href="#"><img src="./images/img-item-news.png"/></a>
                        <div class="cover-related-item-news">
                            <a class="title" href="#">Route Parameters – Sử dụng tham số trong bộ định tuyến</a>
                            <p>01/07/2017</p>
                            <a class="bt-detail" href="#">Chi tiết <small> >> </small></a>
                        </div>
                    </li>
                    <li>
                        <a class="bt-detail" href="#"><img src="./images/img-item-news.png"/></a>
                        <div class="cover-related-item-news">
                            <a class="title" href="#">Thăm quan: Showroom Auto Vinh Tp. Hồ Chí Minh</a>
                            <p>01/07/2017</p>
                            <a class="bt-detail" href="#">Chi tiết <small> >> </small></a>
                        </div>
                    </li>
                    <li>
                        <a class="bt-detail" href="#"><img src="./images/img-item-news.png"/></a>
                        <div class="cover-related-item-news">
                            <a class="title" href="#">Route Prefixing – Tiền tố trước bộ định tuyến</a>
                            <p>01/07/2017</p>
                            <a class="bt-detail" href="#">Chi tiết <small> >> </small></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@stop
