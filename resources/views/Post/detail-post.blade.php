@extends('Layouts.frontend')

@section('content')
    <div class="detail-post">
        <div class="header-post">
            <h3><img src="{{ URL::asset('images/icon-title-news.png')}}"/> {{$detailPost->tieu_de}}</h3>
            <p>Đăng bởi <span>{{$detailPost->username}}</span> - {{date_format(date_create($detailPost->created_at), 'd/m/Y H:i a')}}</p>
            <div class="cover-img-post">
                <img class="pic01" src="{{ URL::asset('images/post/img-post-01.png')}}"/>
                <div class="cover-two-img-post">
                    <img src="{{ URL::asset('images/post/img-post-02.png')}}"/><br>
                    <img src="{{ URL::asset('images/post/img-post-03.png')}}"/>
                </div>
                <img  class="pic04" src="{{ URL::asset('images/post/img-post-04.png')}}"/>
                <img  class="pic05" src="{{ URL::asset('images/post/img-post-05.png')}}"/>
            </div>
        </div>
        <div class="info-post">
            <ul class="ul-cover-tabs-post">
                <li class="active"><a data-toggle="tab" href="#tab1">THÔNG TIN CĂN BẢN</a></li>
                <li><a data-toggle="tab" href="#tab2">THÔNG TIN AN TOÀN</a></li>
                <li><a data-toggle="tab" href="#tab3">TÍNH TIỆN NGHI</a></li>
                <li><a data-toggle="tab" href="#tab4">THÔNG TIN KỸ THUẬT</a></li>
            </ul>
            <div class="cover-tab-post tab-content">
                <div id="tab1" class="tab-pane fade in active">
                    <div class="info-01">
                        <ul>
                            <li><p>*Năm sản xuất: {{$detailPost->thongso['thongso_22']}}</p></li>
                            <li><p>*Tình trạng: {{$detailPost->thongso['thongso_24']}}</p></li>
                            <li><p>*KM đã đi: {{$detailPost->thongso['thongso_26']}} km</p></li>
                        </ul>
                        <ul>
                            <li><p>*Hệ thống nhiên liệu: {{$detailPost->thongso['thongso_31']}}</p></li>
                            <li><p>*Nhiên liệu: {{$detailPost->thongso['thongso_32']}}</p></li>
                            <li><p>*Dòng xe: {{$detailPost->thongso['thongso_25']}}</p></li>
                        </ul>
                        <ul class="final-ul">
                            <li><p>*Màu sắc: {{$detailPost->thongso['thongso_27']}}</p></li>
                            <li><p>*Số ghế: {{$detailPost->thongso['thongso_30']}}</p></li>
                            <li><p>*Tỉnh thành: {{$detailPost->thongso['thongso_62']}}</p></li>
                        </ul>
                    </div>
                    <p class="mo-ta">{{$detailPost->thongso['thongso_49']}}</p>
                    <div class="price">
                        <p class="p-price">{{$detailPost->thongso['thongso_65']}} VND</p>
                        <p class="p-address">Đ/C: 02 Phạm Văn Đồng, P.Linh Đông, Q.Thủ Đức, TP. Hồ Chí Minh</p>
                        <p class="p-phone">Điện thoại: <span>{{$detailPost->thongso['thongso_63']}}</span></p>
                    </div>
                </div>
                <div id="tab2" class="tab-pane fade">
                    <div>
                        <p class="p-thuoc-tinh-post">túi khí an toàn</p>
                        <label class="checkbox-inline">*Túi khí người lái<input disabled="disabled" @if($detailPost->thongso['thongso_1'] == 1) checked @endif type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Túi khí khách phía trước<input disabled="disabled" @if($detailPost->thongso['thongso_3'] == 1) checked @endif type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Túi khí khách phía sau<input disabled="disabled" @if($detailPost->thongso['thongso_2'] == 1) checked @endif type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Túi khí hai bên ghế<input disabled="disabled" @if($detailPost->thongso['thongso_4'] == 1) checked @endif type="checkbox" value=""></label>
                    </div>
                    <div>
                        <p class="p-thuoc-tinh-post">phanh - điều khiển</p>
                        <label class="checkbox-inline">*Chống bó cứng phanh(ABS)<input @if($detailPost->thongso['thongso_5'] == 1) checked @endif disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Phân bổ lực phanh điện tử<input @if($detailPost->thongso['thongso_9'] == 1) checked @endif disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Trợ lực phanh khẩn cấp(EBA)<input @if($detailPost->thongso['thongso_6'] == 1) checked @endif disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Điều khiển hành trình<input @if($detailPost->thongso['thongso_7'] == 1) checked @endif disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Tự động cân bằng điện tử(ESP)<input @if($detailPost->thongso['thongso_10'] == 1) checked @endif disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Hỗ trợ cảnh báo lùi<input @if($detailPost->thongso['thongso_11'] == 1) checked @endif disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Hệ thống kiểm soát trượt<input @if($detailPost->thongso['thongso_8'] == 1) checked @endif disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Chốt cửa an toàn<input @if($detailPost->thongso['thongso_12'] == 1) checked @endif disabled="disabled" type="checkbox" value=""></label>
                    </div>
                    <div>
                        <p class="p-thuoc-tinh-post">khóa chống trộm</p>
                        <label class="checkbox-inline">*Khóa cửa tự động<input @if($detailPost->thongso['thongso_13'] == 1) checked @endif disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Khóa cửa điều khiển từ xa<input @if($detailPost->thongso['thongso_15'] == 1) checked @endif disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Khóa động cơ<input @if($detailPost->thongso['thongso_14'] == 1) checked @endif disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Hệ thống báo trộm ngoại vi<input @if($detailPost->thongso['thongso_16'] == 1) checked @endif disabled="disabled" type="checkbox" value=""></label>
                    </div>
                    <div>
                        <p class="p-thuoc-tinh-post">các thống số khác</p>
                        <label class="checkbox-inline">*Đèn sương mù<input @if($detailPost->thongso['thongso_17'] == 1) checked @endif disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Đèn báo thắt dây an toàn<input @if($detailPost->thongso['thongso_19'] == 1) checked @endif disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Đèn phanh phụ thứ 3 lắp cao<input @if($detailPost->thongso['thongso_18'] == 1) checked @endif disabled="disabled" type="checkbox" value=""></label>
                    </div>
                </div>
                <div id="tab3" class="tab-pane fade">
                    <div>
                        <label class="checkbox-inline">*Thiết bị định vị<input @if($detailPost->thongso['thongso_36'] == 1) checked @endif disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Thiết bị giải trí<input @if($detailPost->thongso['thongso_38'] == 1) checked @endif disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Kính chính diện<input @if($detailPost->thongso['thongso_37'] == 1) checked @endif disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Điều hòa sau<input @if($detailPost->thongso['thongso_39'] == 1) checked @endif disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Điều hòa trước<input @if($detailPost->thongso['thongso_45'] == 1) checked @endif disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Hỗ trợ xe tự động<input @if($detailPost->thongso['thongso_46'] == 1) checked @endif disabled="disabled" type="checkbox" value=""></label><br>
                        <label class="checkbox-inline">*Sấy kính sau<input @if($detailPost->thongso['thongso_40'] == 1) checked @endif disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Kính màu<input @if($detailPost->thongso['thongso_41'] == 1) checked @endif disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Cửa sổ nóc<input @if($detailPost->thongso['thongso_43'] == 1) checked @endif disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Tay lái trợ lực<input @if($detailPost->thongso['thongso_44'] == 1) checked @endif disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Quạt kính sau<input @if($detailPost->thongso['thongso_47'] == 1) checked @endif disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Màn hình LCD<input @if($detailPost->thongso['thongso_48'] == 1) checked @endif disabled="disabled" type="checkbox" value=""></label>
                    </div>
                    <p class="mo-ta">{{$detailPost->thongso['thongso_67']}}</p>
                </div>
                <div id="tab4" class="tab-pane fade">
                    <div>
                        <p class="p-thuoc-tinh-post">kích thước/ Trọng lượng</p>
                        <label class="checkbox-inline">*Chiều dài: {{$detailPost->thongso['thongso_50']}}m</label>
                        <label class="checkbox-inline">*Chiều rộng: {{$detailPost->thongso['thongso_51']}}m</label>
                        <label class="checkbox-inline">*Chiều cao: {{$detailPost->thongso['thongso_52']}}m</label>
                        <label class="checkbox-inline">*Trọng lượng không tải: {{$detailPost->thongso['thongso_53']}}kg</label>
                        <label class="checkbox-inline">*Dung tích nhiên liệu: {{$detailPost->thongso['thongso_54']}} lít</label>
                    </div>
                    <div>
                        <p class="p-thuoc-tinh-post">động cơ</p>
                        <label class="checkbox-inline">*Động cơ: {{$detailPost->thongso['thongso_66']}} mã lực</label>
                        <label class="checkbox-inline">*Kiểu động cơ: {{$detailPost->thongso['thongso_55']}}</label>
                        <label class="checkbox-inline">*Dung tích xilanh: {{$detailPost->thongso['thongso_56']}} cm3</label>
                    </div>
                    <div>
                        <p class="p-thuoc-tinh-post">phanh giảm sóc-lốp</p>
                        <label class="checkbox-inline">*Phanh: {{$detailPost->thongso['thongso_57']}}</label>
                        <label class="checkbox-inline">*Giảm sóc: {{$detailPost->thongso['thongso_58']}}</label>
                        <label class="checkbox-inline">*Lốp xe/ Vành mâm: {{$detailPost->thongso['thongso_59']}}</label>
                    </div>
                </div>
            </div>
            <div class="related-post">
                <p class="title-related-post"><img src="{{ URL::asset('images/icon-title-news.png')}}"/> có thể bạn cũng thích</p>
                <div class="list-related-post">
                    <ul id="scrollerRelatedPost">
                        <li class="item">
                            <a href="#"><img src="./images/icon-salon.png"></a>
                            <div class="caption">
                                <a href="#"><h3>lexus nx300h 2016</h3></a>
                                <p>2.300.000.000 VND</p>
                                <p>Hồ Chí Minh</p>
                            </div>
                        </li>
                        <li class="item">
                            <a href="#"><img src="./images/icon-salon.png"></a>
                            <div class="caption">
                                <a href="#"><h3>lexus nx300h 2016</h3></a>
                                <p>2.300.000.000 VND</p>
                                <p>Hồ Chí Minh</p>
                            </div>
                        </li>
                        <li class="item">
                            <a href="#"><img src="./images/icon-salon.png"></a>
                            <div class="caption">
                                <a href="#"><h3>lexus nx300h 2016</h3></a>
                                <p>2.300.000.000 VND</p>
                                <p>Hồ Chí Minh</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script  type="text/javascript">
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
