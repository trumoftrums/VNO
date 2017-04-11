@extends('Layouts.frontend')
<style>
    .container-fluid{
        background: none !important;
    }
    .news-page .list-news-page{
        height:555px !important;
    }
    .arrow-before-title {
        width: 30px !important;
        float: left;
        margin-top: -9px;
        margin-right: 5px;
    }
    .ul-cover-tab {
        margin-top: 10px !important;
    }
    .cover-tab {
        border-top: none !important;
        margin-top: 10px !important;
    }
    .ul-cover-tab li a {
        padding: 9px 3vw !important;
    }
</style>
@section('content')
    <div class="news-page">
        <div class="header-detail-news">
            <h3><img class="arrow-before-title" src="{{ URL::asset('images/icon-title-salon.png')}}"/>
                <a href="{{ URL::to('do-xe-uy-tin/all') }}">Vip Showroom/ Salon Oto </a>
                > {{$detailVipSalon->title}}</h3>
        </div>
        <div class="list-news-page" id="style-4">
            <div class="detail-news" >
                <img class="thumb-item-news" src="{{ URL::asset($detailVipSalon->images)}}"/>
                <ul class="ul-cover-tab">
                    <li @if($activeTab == '')class="active" @endif><a data-toggle="tab" href="#info">GIỚI THIỆU</a></li>
                    <li @if($activeTab != '') class="active" @endif><a data-toggle="tab" href="#post">BÀI ĐĂNG</a></li>
                </ul>
                <div class="cover-tab tab-content">
                    <div id="info" class="tab-pane fade @if($activeTab == '') in active @endif">
                        <?php echo $detailVipSalon->description ?>
                    </div>
                    <div id="post" class="tab-pane fade @if($activeTab != '') in active @endif">
                        <div class="list-items">
                            @foreach($listPost as $item)
                                <div class="col-md-4 item">
                                    <div class="inner-item">
                                        <div class="hover-item">
                                            <div class="cover-zoom">
                                                <a href="{{ URL::to('/bai-dang/'.$item->id.'/'.str_slug($item->tieu_de, '-')) }}"><img src="{{ URL::asset('images/icon-zoom.png')}}"/></a>
                                                <a class="detail" href="{{ URL::to('/bai-dang/'.$item->id.'/'.str_slug($item->tieu_de, '-')) }}">Xem Chi Tiết</a>
                                            </div>
                                        </div>
                                        <div class="left-item">
                                            <img src="{{ URL::asset('uploads/baiviet/'.$item->photo1)}}"/>
                                            <span class="price">{{$item->thongso['thongso_65']}} VND</span>
                                        </div>
                                        <div class="right-item">
                                            <h4>{{$item->tieu_de}}</h4>
                                            <p>- Tình trạng: {{$item->thongso['thongso_24']}}</p>
                                            <p>- Dòng xe: {{$item->thongso['thongso_25']}}</p>
                                            <p>- Năm SX: {{$item->thongso['thongso_22']}}</p>
                                            <p>- Nhiên liệu: <?php if(!empty($item->thongso['thongso_32'])) echo $item->thongso['thongso_32']; ?></p>
                                            <p class="phone-address-item">- {{$item->thongso['thongso_62']}} - {{$item->thongso['thongso_63']}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="paging-div">
                                {{ $listPost->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
