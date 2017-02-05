@extends('Layouts.frontend')

@section('content')
    <div class="slide-top">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img class="img-slide" src="./images/slide-top/slide01.png"/>
                </div>
                <div class="item">
                    <img class="img-slide" src="./images/slide-top/slide01.png"/>
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
    <div class="list-items">
        @foreach($listPost as $item)
        <div class="col-md-4 item">
            <div class="inner-item">
                <div class="hover-item">
                    <div class="cover-zoom">
                        <a href="{{ URL::to('/bai-dang/'.$item->id.'/'.str_slug($item->tieu_de, '-')) }}"><img src="./images/icon-zoom.png"/></a>
                        <a class="detail" href="{{ URL::to('/bai-dang/'.$item->id.'/'.str_slug($item->tieu_de, '-')) }}">Xem Chi Tiết</a>
                    </div>
                </div>
                <div class="left-item">
                    <img src="./images/item-car.png"/>
                    <span class="price">{{$item->thongso['thongso_65']}} VND</span>
                </div>
                <div class="right-item">
                    <h4>{{$item->tieu_de}}</h4>
                    <p>- Tình trạng: {{$item->thongso['thongso_24']}}</p>
                    <p>- Dòng xe: {{$item->thongso['thongso_25']}}</p>
                    <p>- Năm SX: {{$item->thongso['thongso_22']}}</p>
                    <p>- {{$item->thongso['thongso_31']}}</p>
                    <p class="phone-address-item">- {{$item->thongso['thongso_62']}} - {{$item->thongso['thongso_63']}}</p>
                </div>
            </div>
        </div>
        @endforeach
        <div class="paging-div">
            <nav aria-label="Page navigation">
                <ul class="pagination pagination-sm">
                    <li>
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li>
                        <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="list-salon">
        <ul id="scrollerSalon">
            <li class="item">
                <a href="#"><img src="./images/icon-salon.png"></a>
                <div class="caption">
                    <a href="#"><h3>CHEVROLET HỒ CHÍ MINH</h3></a>
                    <p>268 Kinh Dương Vương, Phường An Lạc, Quận Bình Tân</p>
                </div>
            </li>
            <li class="item">
                <a href="#"><img src="./images/icon-salon.png"></a>
                <div class="caption">
                    <a href="#"><h3>CHEVROLET HỒ CHÍ MINH</h3></a>
                    <p>268 Kinh Dương Vương, Phường An Lạc, Quận Bình Tân</p>
                </div>
            </li>
            <li class="item">
                <a href="#"><img src="./images/icon-salon.png"></a>
                <div class="caption">
                    <a href="#"><h3>CHEVROLET HỒ CHÍ MINH</h3></a>
                    <p>268 Kinh Dương Vương, Phường An Lạc, Quận Bình Tân</p>
                </div>
            </li>
        </ul>
    </div>
@stop