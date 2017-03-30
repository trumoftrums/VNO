@extends('Layouts.frontend')

@section('content')
    <style>
        .row > .column {
            padding: 0 8px;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .column {
            float: left;
            width: 25%;
        }

        /* The Modal (background) */
        .detail-po .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: black;
        }

        /* Modal Content */
        .detail-po .modal-content {
            position: relative;
            background-color: #fefefe;
            margin: auto;
            padding: 0;
            width: 90%;
            max-width: 1200px;
        }

        /* The Close Button */
        .detail-po .close {
            color: #058c04;
            position: absolute;
            top: -30px;
            right: -20px;
            font-size: 35px;
            font-weight: bold;
            opacity: 1;
        }

        .detail-po .close:hover,
        .detail-po .close:focus {
            color: #999;
            text-decoration: none;
            cursor: pointer;
        }

        .detail-po .mySlides {
            display: none;
        }

        /* Next & previous buttons */
        .detail-po .prev,
        .detail-po .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -50px;
            color: white;
            font-weight: bold;
            font-size: 20px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
            -webkit-user-select: none;
        }

        /* Position the "next button" to the right */
        .detail-po .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .detail-po .prev:hover,
        .detail-po .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Number text (1/3 etc) */
        .detail-po .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        .caption-container {
            text-align: center;
            background-color: black;
            padding: 2px 16px;
            color: white;
        }

        img.demo {
            opacity: 0.6;
        }

        .active,
        .demo:hover {
            opacity: 1;
        }

        img.hover-shadow {
            transition: 0.3s
        }

        .hover-shadow:hover {
            /*box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)*/
        }
    </style>
    <div class="detail-post">
        <div class="header-post">
            <div class="cover-title-date">
                <h3><img src="{{ URL::asset('images/icon-title-news.png')}}"/> {{$detailPost->tieu_de}}</h3>
                <p>Đăng bởi <span>{{$detailPost->username}}</span> - {{date_format(date_create($detailPost->created_at), 'd/m/Y H:i a')}}</p>
            </div>
            <div class="cover-img-post">
                <div class="item-img-detail">
                    <img onclick="openModal();currentSlide(1)" class="hover-shadow"
                         src="{{ URL::asset('uploads/baiviet/thumb/tablet/'.$detailPost->photo1)}}"/>

                </div>
                <div class="item-img-detail">
                    <img onclick="openModal();currentSlide(2)" class="hover-shadow"
                         src="{{ URL::asset('uploads/baiviet/thumb/tablet/'.$detailPost->photo2)}}"/>
                </div>
                <div class="item-img-detail">
                    <img onclick="openModal();currentSlide(3)" class="hover-shadow"
                         src="{{ URL::asset('uploads/baiviet/thumb/tablet/'.$detailPost->photo3)}}"/>
                </div>
                <div class="item-img-detail">
                    <img onclick="openModal();currentSlide(4)" class="hover-shadow"
                         src="{{ URL::asset('uploads/baiviet/thumb/tablet/'.$detailPost->photo4)}}"/>
                </div>
                <div class="item-img-detail">
                    <img onclick="openModal();currentSlide(5)" class="hover-shadow"
                         src="{{ URL::asset('uploads/baiviet/thumb/tablet/'.$detailPost->photo5)}}"/>
                </div>
            </div>
        </div>
        <div class="info-post">
            <div class="address-price-phone">
                <p class="price"><?php if( isset($detailPost->thongso['thongso_65'])) echo number_format(str_replace(".","",$detailPost->thongso['thongso_65']),0,",","."); ?> VND</p>
                <p class="address">@if(isset($detailPost->thongso['thongso_68'])) {{$detailPost->thongso['thongso_68']}} @endif</p>
                <p class="phone">@if(isset($detailPost->thongso['thongso_63'])) {{$detailPost->thongso['thongso_63']}} @endif</p>
            </div>
            <div class="info-post-detail">
                <div class="left guide-pc">
                    <p class="p-title-area">MÔ TẢ CƠ BẢN</p>
                    <ul>
                        <li>
                            <div>
                                <span><img src="{{ URL::asset('images/icon-detail-post/car.png')}}"/><b>Dáng xe:</b> @if(isset($detailPost->thongso['thongso_25'])) {{$detailPost->thongso['thongso_25']}} @endif</span>
                            </div>
                            <div>
                                <span><img src="{{ URL::asset('images/icon-detail-post/city.png')}}"/><b>Tỉnh thành:</b> @if(isset($detailPost->thongso['thongso_62'])) {{$detailPost->thongso['thongso_62']}} @endif</span>
                            </div>
                            <div>
                                <span><img src="{{ URL::asset('images/icon-detail-post/info.png')}}"/><b>Tình trạng:</b>
                                    @if(isset($detailPost->thongso['thongso_24']))
                                        @if($detailPost->thongso['thongso_24'] == 'Đã sử dụng')
                                            Đ.sử dụng
                                        @else
                                            {{$detailPost->thongso['thongso_24']}}
                                        @endif
                                    @endif
                                </span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <span><img src="{{ URL::asset('images/icon-detail-post/calendar.png')}}"/><b>Năm SX:</b> @if(isset($detailPost->thongso['thongso_22'])) {{$detailPost->thongso['thongso_22']}} @endif</span>
                            </div>
                            <div>
                                <span><img src="{{ URL::asset('images/icon-detail-post/location.png')}}"/><b>Xuất xứ:</b> @if(isset($detailPost->thongso['thongso_70'])) {{$detailPost->thongso['thongso_70']}} @endif</span>
                            </div>
                            <div>
                                <span><img src="{{ URL::asset('images/icon-detail-post/km.png')}}"/><b>KM đã đi:</b> @if(isset($detailPost->thongso['thongso_26'])) {{$detailPost->thongso['thongso_26']}} @endif km</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <span><img src="{{ URL::asset('images/icon-detail-post/gearbox.png')}}"/><b>Hộp số:</b> @if(isset($detailPost->thongso['thongso_34'])) {{$detailPost->thongso['thongso_34']}} @endif</span>
                            </div>
                            <div>
                                <span><img src="{{ URL::asset('images/icon-detail-post/oils.png')}}"/><b>Nhiên liệu:</b> @if(isset($detailPost->thongso['thongso_32'])) {{$detailPost->thongso['thongso_32']}} @endif</span>
                            </div>
                            <div>
                                <span><img src="{{ URL::asset('images/icon-detail-post/color.png')}}"/><b>Màu sắc:</b> @if(isset($detailPost->thongso['thongso_27'])) {{$detailPost->thongso['thongso_27']}} @endif</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <span><img src="{{ URL::asset('images/icon-detail-post/tieu-thu.png')}}"/><b>Tiêu thụ:</b> @if(isset($detailPost->thongso['thongso_35'])) {{$detailPost->thongso['thongso_35']}} @endif</span>
                            </div>
                            <div>
                                <span><img src="{{ URL::asset('images/icon-detail-post/so-ghe.png')}}"/><b>Số ghế:</b> @if(isset($detailPost->thongso['thongso_30'])) {{$detailPost->thongso['thongso_30']}} @endif</span>
                            </div>
                            <div>
                                <span><img src="{{ URL::asset('images/icon-detail-post/so-cua.png')}}"/><b>Số cửa:</b> @if(isset($detailPost->thongso['thongso_29'])) {{$detailPost->thongso['thongso_29']}} @endif</span>
                            </div>
                        </li>
                        <li>
                            <span><img src="{{ URL::asset('images/icon-detail-post/dan-dong.png')}}"/><b>Dẫn động:</b> @if(isset($detailPost->thongso['thongso_33'])) {{$detailPost->thongso['thongso_33']}} @endif</span>
                        </li>
                    </ul>
                </div>
                <div class="left guide-mobile">
                    <p class="p-title-area">MÔ TẢ CƠ BẢN</p>
                    <ul>
                        <li>
                            <div>
                                <span><img src="{{ URL::asset('images/icon-detail-post/car.png')}}"/><b>Dáng xe:</b> @if(isset($detailPost->thongso['thongso_25'])) {{$detailPost->thongso['thongso_25']}} @endif</span>
                            </div>
                            <div>
                                <span><img src="{{ URL::asset('images/icon-detail-post/city.png')}}"/><b>Tỉnh thành:</b> @if(isset($detailPost->thongso['thongso_62'])) {{$detailPost->thongso['thongso_62']}} @endif</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <span><img src="{{ URL::asset('images/icon-detail-post/info.png')}}"/><b>Tình trạng:</b>
                                    @if(isset($detailPost->thongso['thongso_24']))
                                        @if($detailPost->thongso['thongso_24'] == 'Đã sử dụng')
                                            Đ.sử dụng
                                        @else
                                            {{$detailPost->thongso['thongso_24']}}
                                        @endif
                                    @endif
                                </span>
                            </div>
                            <div>
                                <span><img src="{{ URL::asset('images/icon-detail-post/calendar.png')}}"/><b>Năm SX:</b> @if(isset($detailPost->thongso['thongso_22'])) {{$detailPost->thongso['thongso_22']}} @endif</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <span><img src="{{ URL::asset('images/icon-detail-post/location.png')}}"/><b>Xuất xứ:</b> @if(isset($detailPost->thongso['thongso_70'])) {{$detailPost->thongso['thongso_70']}} @endif</span>
                            </div>
                            <div>
                                <span><img src="{{ URL::asset('images/icon-detail-post/km.png')}}"/><b>KM đã đi:</b> @if(isset($detailPost->thongso['thongso_26'])) {{$detailPost->thongso['thongso_26']}} @endif km</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <span><img src="{{ URL::asset('images/icon-detail-post/gearbox.png')}}"/><b>Hộp số:</b> @if(isset($detailPost->thongso['thongso_34'])) {{$detailPost->thongso['thongso_34']}} @endif</span>
                            </div>
                            <div>
                                <span><img src="{{ URL::asset('images/icon-detail-post/oils.png')}}"/><b>Nhiên liệu:</b> @if(isset($detailPost->thongso['thongso_32'])) {{$detailPost->thongso['thongso_32']}} @endif</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <span><img src="{{ URL::asset('images/icon-detail-post/color.png')}}"/><b>Màu sắc:</b> @if(isset($detailPost->thongso['thongso_27'])) {{$detailPost->thongso['thongso_27']}} @endif</span>
                            </div>
                            <div>
                                <span><img src="{{ URL::asset('images/icon-detail-post/tieu-thu.png')}}"/><b>Tiêu thụ:</b> @if(isset($detailPost->thongso['thongso_35'])) {{$detailPost->thongso['thongso_35']}} @endif</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <span><img src="{{ URL::asset('images/icon-detail-post/so-ghe.png')}}"/><b>Số ghế:</b> @if(isset($detailPost->thongso['thongso_30'])) {{$detailPost->thongso['thongso_30']}} @endif</span>
                            </div>
                            <div>
                                <span><img src="{{ URL::asset('images/icon-detail-post/so-cua.png')}}"/><b>Số cửa:</b> @if(isset($detailPost->thongso['thongso_29'])) {{$detailPost->thongso['thongso_29']}} @endif</span>
                            </div>
                        </li>
                        <li>
                            <span><img src="{{ URL::asset('images/icon-detail-post/dan-dong.png')}}"/><b>Dẫn động:</b> @if(isset($detailPost->thongso['thongso_33'])) {{$detailPost->thongso['thongso_33']}} @endif</span>
                        </li>
                    </ul>
                </div>
                <div class="right">
                    <p class="p-title-area">SỐ TIỀN CÓ THỂ VAY</p>
                    <div class="cover-price-bank">
                        <p class="price"><img src="{{ URL::asset('images/icon-detail-post/icon-price.png')}}"/><?php if(isset($detailPost->thongso['thongso_73'])&& !empty($detailPost->thongso['thongso_73'])) { if (is_numeric(str_replace(".","",$detailPost->thongso['thongso_73']))){ echo number_format(str_replace(".","",$detailPost->thongso['thongso_73']),0,",",".");}else{ echo $detailPost->thongso['thongso_73'];}} ?> VND</p>
                        <img class="img-bank" src="{{ URL::asset('images/icon-detail-post/img-bank.png')}}"/>
                    </div>
                </div>
            </div>
            <div class="div-des">
                <p class="p-title-area">NỘI DUNG MÔ TẢ</p>
                <div class="cover-descript">
                    <?php if(isset($detailPost->thongso['thongso_67'])) echo $detailPost->thongso['thongso_67'] ?>
                </div>
                <p class="p-notes"><span>* Lưu ý:</span> Quý vị đang xem nội dung tin rao "{{$detailPost->tieu_de}}". Mọi thông tin liên quan tới tin rao này là do người đăng tin đăng tải và chịu trách nhiệm. Vietnamoto.net luôn cố gắng để có chất lượng thông tin tốt nhất, nhưng Vietnamoto.net không chịu trách nhiệm về bất kỳ nội dung nào liên quan tới tin rao này. Nếu quý vị phát hiện có sai sót hay vấn đề gì xin hãy thông báo cho vietnamoto.net tại đây</p>
            </div>
            <div class="post-relate-type">
                <p class="p-relate-post"><img src="{{ URL::asset('images/icon-detail-post/icon-car.png')}}"/>XE CÙNG THỂ LOẠI</p>
                @foreach($listPostRelatedType as $item)
                    <div class="item-relate-post">
                        <a href="{{ URL::to('/bai-dang/'.$item->id.'/'.str_slug($item->tieu_de, '-')) }}"><img class="thumb" src="{{ URL::asset('/uploads/baiviet/thumb/tablet/'.$item->photo1)}}"/></a>
                        <div class="right-item">
                            <a href="{{ URL::to('/bai-dang/'.$item->id.'/'.str_slug($item->tieu_de, '-')) }}"><span class="sp-title">@if(isset($item->tieu_de)) {{$item->tieu_de}} @endif</span></a>
                            <span><?php if( isset($item->thongso['thongso_65'])) echo number_format(str_replace(".","",$item->thongso['thongso_65']),0,",","."); ?> VNĐ</span>
                            <span>@if(isset($item->thongso['thongso_62'])) {{$item->thongso['thongso_62']}} @endif</span>
                        </div>
                    </div>
                @endforeach
                @if(count($listPostRelatedType) > 0)
                    <div class="cover-view-more">
                        <a class="view-more" href="{{ URL::to('?branch='.$strFilter) }}">Xem nhiều hơn>></a>
                    </div>
                @endif
            </div>
            <div class="post-relate-type">
                <p class="p-relate-post"><img src="{{ URL::asset('images/icon-detail-post/icon-car.png')}}"/>XE CÙNG GIÁ</p>
                @foreach($listPostRelatedPrice as $item)
                    <div class="item-relate-post">
                        <a href="{{ URL::to('/bai-dang/'.$item->id.'/'.str_slug($item->tieu_de, '-')) }}"><img class="thumb" src="{{ URL::asset('/uploads/baiviet/thumb/tablet/'.$item->photo1)}}"/></a>
                        <div class="right-item">
                            <a href="{{ URL::to('/bai-dang/'.$item->id.'/'.str_slug($item->tieu_de, '-')) }}"><span class="sp-title">@if(isset($item->tieu_de)) {{$item->tieu_de}} @endif</span></a>
                            <span><?php if( isset($item->thongso['thongso_65'])) echo number_format(str_replace(".","",$item->thongso['thongso_65']),0,",","."); ?> VNĐ</span>
                            <span>@if(isset($item->thongso['thongso_62'])) {{$item->thongso['thongso_62']}} @endif</span>
                        </div>
                    </div>
                @endforeach
                @if(count($listPostRelatedPrice) > 0)
                    <div class="cover-view-more">
                        <a class="view-more" href="{{ URL::to('?price='.$price) }}">Xem nhiều hơn>></a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="detail-po">
        <div id="myModal" class="modal" style="background-color: rgba(59, 66, 60, 0.73);">
            <div class="modal-content" style="width:40%;">
                <span class="close cursor" onclick="closeModal()">&times;</span>
                <div class="mySlides">
                    <div class="numbertext">1 / 5</div>
                    <img src="{{ URL::asset('uploads/baiviet/'.$detailPost->photo1)}}" style="width:100%">
                </div>

                <div class="mySlides">
                    <div class="numbertext">2 / 5</div>
                    <img src="{{ URL::asset('uploads/baiviet/'.$detailPost->photo2)}}" style="width:100%">
                </div>

                <div class="mySlides">
                    <div class="numbertext">3 / 5</div>
                    <img src="{{ URL::asset('uploads/baiviet/'.$detailPost->photo3)}}" style="width:100%">
                </div>

                <div class="mySlides">
                    <div class="numbertext">4 / 5</div>
                    <img src="{{ URL::asset('uploads/baiviet/'.$detailPost->photo4)}}" style="width:100%">
                </div>

                <div class="mySlides">
                    <div class="numbertext">5 / 5</div>
                    <img src="{{ URL::asset('uploads/baiviet/'.$detailPost->photo5)}}" style="width:100%">
                </div>

                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
        </div>
    </div>
    <script  type="text/javascript">
        function openModal() {
            document.getElementById('myModal').style.display = "block";
        }

        function closeModal() {
            document.getElementById('myModal').style.display = "none";
        }

        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slides[slideIndex-1].style.display = "block";
        }
        (function($) {
            $(function() { //on DOM ready
                $("#scrollerRelatedPost").simplyScroll({
                    customClass: 'hori',
                    orientation: 'horizontal',
                    auto: true,
                    manualMode: 'loop',
                    frameRate: 20,
                    speed: 1
                });
            });
        })(jQuery);
    </script>
@stop
