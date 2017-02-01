@extends('Layouts.frontend')
<style>
    .container-fluid{
        background: none !important;
    }
</style>
@section('content')
    <div class="news-page">
        <div class="header-detail-news">
            <h3><img src="{{ URL::asset('images/icon-title-news.png')}}"/> Thăm quan: Showroom Auto Vinh Tp. Hồ Chí Minh</h3>
            <p>Đăng bởi <span>Vietnamoto.net</span> - 01/07/2017</p>
        </div>
        <div class="list-news-page" id="style-4">
            <div class="detail-news" >
                <img class="thumb-item-news" src="./images/img-detail-news.png"/>
                <p>Qua bài viết này mình đã giới thiệu cho các bạn những kiến thức cơ bản về Router trong Laravel,tuy trong 1 bài viết mình chưa thể nói lên hết được sức mạnh của Router nhưng phần nào đó cũng giúp cho các bạn áp dụng được cho những chức năng quan trong.Routing trong laravel sẽ để đề cập hầu như trong xuyên xuốt trong các bài viết về Laravel, lên khi xem các bài sau các bạn có thể đụng chàm nhiều hơn và hiểu sâu hơn.Sang bài tiếp theo mình sẽ đề cập tới</p>
                <p>Qua bài viết này mình đã giới thiệu cho các bạn những kiến thức cơ bản về Router trong Laravel,tuy trong 1 bài viết mình chưa thể nói lên hết được sức mạnh của Router nhưng phần nào đó cũng giúp cho các bạn áp dụng được cho những chức năng quan trong.Routing trong laravel sẽ để đề cập hầu như trong xuyên xuốt trong các bài viết về Laravel, lên khi xem các bài sau các bạn có thể đụng chàm nhiều hơn và hiểu sâu hơn.Sang bài tiếp theo mình sẽ đề cập tới</p>
                <p>Qua bài viết này mình đã giới thiệu cho các bạn những kiến thức cơ bản về Router trong Laravel,tuy trong 1 bài viết mình chưa thể nói lên hết được sức mạnh của Router nhưng phần nào đó cũng giúp cho các bạn áp dụng được cho những chức năng quan trong.Routing trong laravel sẽ để đề cập hầu như trong xuyên xuốt trong các bài viết về Laravel, lên khi xem các bài sau các bạn có thể đụng chàm nhiều hơn và hiểu sâu hơn.Sang bài tiếp theo mình sẽ đề cập tới</p>
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
