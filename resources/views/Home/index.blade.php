@extends('Layouts.frontend')

@section('content')
    <div class="slide-top">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <a target="_blank" href="http://kiamotorsvietnam.com.vn/Tin-tuc---su-kien-22/THACO-RA-MAT-KIA-OPTIMA-2016-VOI-GIA-BAN-CONG-BO-TU-915-TRIEU-DONG-851.html">
                        <img class="img-slide" src="./images/slide-top/bn01.png"/>
                    </a>
                </div>
                <div class="item">
                    <a target="_blank" href="http://www.rolls-roycemotorcars-hanoi.vn/ghost">
                        <img class="img-slide" src="./images/slide-top/bn02.png"/>
                    </a>
                </div>
                <div class="item">
                    <a target="_blank" href="http://toyotaphumyhung.com.vn/xe-toyota-landcruiser/">
                        <img class="img-slide" src="./images/slide-top/bn03.png"/>
                    </a>
                </div>
                <div class="item">
                    <a target="_blank" href="http://www.nissan.com.vn/news/thong-cao-bao-chi-nissan-ra-mat-phien-ban-np300-navara-mot-cau-so-tu-dong-moi/">
                        <img class="img-slide" src="./images/slide-top/bn04.png"/>
                    </a>
                </div>
                <div class="item">
                    <a target="_blank" href="https://www.ford.com.vn/suvs/explorer/?intcmp=bb-fvn-hp-fvn-vhp-ford%20explorer-return">
                        <img class="img-slide" src="./images/slide-top/bn05.png"/>
                    </a>
                </div>
            </div>
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"></a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"></a>
        </div>
    </div>
    <div class="paging">
        <p>TẤT CẢ CÁC HÃNG XE <small> - Tổng số trang: 150 - 1/150 trang</small></p>
        <span class="click-menu-branch" data-toggle="dropdown">Chọn theo hãng xe <img class="icon-arrow-down" src="./images/icon-arrow-down.png"/></span>
        <ul class="dropdown-menu menu-branch">
            <a class="all-branch" href="#">TẤT CẢ</a>
            <a href="#"><img src="./images/logo_brands/acura.png"/></a>
            <a href="#"><img src="./images/logo_brands/audi.png"/></a>
            <a href="#"><img src="./images/logo_brands/BMW.png"/></a>
            <a href="#"><img src="./images/logo_brands/chevrolet.png"/></a>
            <a href="#"><img src="./images/logo_brands/daewoo.png"/></a>
            <a href="#"><img src="./images/logo_brands/daihatshu.png"/></a>
            <a href="#"><img src="./images/logo_brands/fiat.png"/></a>
            <a href="#"><img src="./images/logo_brands/ford.png"/></a>
            <a href="#"><img src="./images/logo_brands/honda.png"/></a>
            <a href="#"><img src="./images/logo_brands/hyundai.png"/></a>
            <a href="#"><img src="./images/logo_brands/isuzu.png"/></a>
            <a href="#"><img src="./images/logo_brands/kia-motors.png"/></a>
            <a href="#"><img src="./images/logo_brands/landrover.png"/></a>
            <a href="#"><img src="./images/logo_brands/lexus.png"/></a>
            <a href="#"><img src="./images/logo_brands/mazda.png"/></a>
            <a href="#"><img src="./images/logo_brands/mercedes-benz.png"/></a>
            <a href="#"><img src="./images/logo_brands/mitsubishi.png"/></a>
            <a href="#"><img src="./images/logo_brands/nissan.png"/></a>
            <a href="#"><img src="./images/logo_brands/peugote.png"/></a>
            <a href="#"><img src="./images/logo_brands/porsche.png"/></a>
            <a href="#"><img src="./images/logo_brands/renault.png"/></a>
            <a href="#"><img src="./images/logo_brands/ssangyong.png"/></a>
            <a href="#"><img src="./images/logo_brands/suzuki.png"/></a>
            <a href="#"><img src="./images/logo_brands/toyota.png"/></a>
            <a href="#"><img src="./images/logo_brands/volkswagen.png"/></a>
        </ul>
    </div>
    <div class="list-items" id="list-items1">
        @foreach($listPost as $item)
        <div class="col-lg-4 col-md-6 col-sm-6 item">
            <div class="inner-item">
                <div class="hover-item">
                    <div class="cover-zoom">
                        <a href="{{ URL::to('/bai-dang/'.$item->id.'/'.str_slug($item->tieu_de, '-')) }}"><img src="./images/icon-zoom.png"/></a>
                        <a class="detail" href="{{ URL::to('/bai-dang/'.$item->id.'/'.str_slug($item->tieu_de, '-')) }}">Xem Chi Tiết</a>
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
                    <p>- Nhiên liệu: {{$item->thongso['thongso_31']}}</p>
                    <p class="phone-address-item">- {{$item->thongso['thongso_62']}} - {{$item->thongso['thongso_63']}}</p>
                </div>
            </div>
        </div>
        @endforeach
        <div class="paging-div">
        <?php if(!empty($listPost)) echo $listPost->links() ?>
        </div>
    </div>
    {{--<div class="list-salon">
        <ul id="scrollerSalon">
            @foreach($listVipSalon as $salon)
            <li class="item">
                <a href="#"><img src="{{ URL::asset($salon->thumb)}}"></a>
                <div class="caption">
                    <a href="#"><h3>{{$salon->title}}</h3></a>
                    <p>{{$salon->address}}</p>
                </div>
            </li>
            @endforeach
        </ul>
    </div>--}}
@stop