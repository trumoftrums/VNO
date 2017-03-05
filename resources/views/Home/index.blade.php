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
        <p style="text-transform: uppercase;">{{$branch}} <small style="text-transform: lowercase;"> - Tổng số trang: {{$totalPage}} - {{$currentPage}}/{{$totalPage}} trang</small></p>
        <span class="click-menu-branch" data-toggle="dropdown">Chọn theo hãng xe <img class="icon-arrow-down" src="./images/icon-arrow-down.png"/></span>
        <ul class="dropdown-menu menu-branch">
            <div>
                <a class="all-branch" href="{{ URL::to('?branch=all') }}">TẤT CẢ</a>
            </div>
            <div>
                <a href="{{ URL::to('?branch=Acura') }}"><img src="./images/logo_brands/acura.png"/></a>
            </div>
            <div>
                <a href="{{ URL::to('?branch=Audi') }}"><img src="./images/logo_brands/audi.png"/></a>
            </div>
            <div>
                <a href="{{ URL::to('?branch=BMW') }}"><img src="./images/logo_brands/BMW.png"/></a>
            </div>
            <div>
                <a href="{{ URL::to('?branch=Chevrolet') }}"><img src="./images/logo_brands/chevrolet.png"/></a>
            </div>
            <div>
                <a href="{{ URL::to('?branch=Daewoo') }}"><img src="./images/logo_brands/daewoo.png"/></a>
            </div>
            <div>
                <a href="{{ URL::to('?branch=Daihatshu') }}"><img src="./images/logo_brands/daihatshu.png"/></a>
            </div>
            <div>
                <a href="{{ URL::to('?branch=Fiat') }}"><img src="./images/logo_brands/fiat.png"/></a>
            </div>
            <div>
                <a href="{{ URL::to('?branch=FORD') }}"><img src="./images/logo_brands/ford.png"/></a>
            </div>
            <div>
                <a href="{{ URL::to('?branch=Honda') }}"><img src="./images/logo_brands/honda.png"/></a>
            </div>
            <div>
                <a href="{{ URL::to('?branch=Hyundai') }}"><img src="./images/logo_brands/hyundai.png"/></a>
            </div>
            <div>
                <a href="{{ URL::to('?branch=Isuzu') }}"><img src="./images/logo_brands/isuzu.png"/></a>
            </div>
            <div>
                <a href="{{ URL::to('?branch=Kia') }}"><img src="./images/logo_brands/kia-motors.png"/></a>
            </div>
            <div>
                <a href="{{ URL::to('?branch=Land Rover') }}"><img src="./images/logo_brands/landrover.png"/></a>
            </div>
            <div>
                <a href="{{ URL::to('?branch=Lexus') }}"><img src="./images/logo_brands/lexus.png"/></a>
            </div>
            <div>
                <a href="{{ URL::to('?branch=Mazda') }}"><img src="./images/logo_brands/mazda.png"/></a>
            </div>
            <div>
                <a href="{{ URL::to('?branch=Mercedes-Benz') }}"><img src="./images/logo_brands/mercedes-benz.png"/></a>
            </div>
            <div>
                <a href="{{ URL::to('?branch=Mitsubishi') }}"><img src="./images/logo_brands/mitsubishi.png"/></a>
            </div>
            <div>
                <a href="{{ URL::to('?branch=Nissan') }}"><img src="./images/logo_brands/nissan.png"/></a>
            </div>
            <div>
                <a href="{{ URL::to('?branch=Peugeot') }}"><img src="./images/logo_brands/peugote.png"/></a>
            </div>
            <div>
                <a href="{{ URL::to('?branch=Porsche') }}"><img src="./images/logo_brands/porsche.png"/></a>
            </div>
            <div>
                <a href="{{ URL::to('?branch=Renault') }}"><img src="./images/logo_brands/renault.png"/></a>
            </div>
            <div>
                <a href="{{ URL::to('?branch=SsangYong') }}"><img src="./images/logo_brands/ssangyong.png"/></a>
            </div>
            <div>
                <a href="{{ URL::to('?branch=Suzuki') }}"><img src="./images/logo_brands/suzuki.png"/></a>
            </div>
            <div>
                <a href="{{ URL::to('?branch=Toyota') }}"><img src="./images/logo_brands/toyota.png"/></a>
            </div>
            <div>
                <a href="{{ URL::to('?branch=Volkswagen') }}"><img src="./images/logo_brands/volkswagen.png"/></a>
            </div>
        </ul>
    </div>
    <div class="list-items" id="list-items1">
        @if(count($listPost)>0)
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
@stop