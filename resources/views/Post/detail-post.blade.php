@extends('Layouts.frontend')

@section('content')
    <div class="detail-post">
        <div class="header-post">
            <h3><img src="{{ URL::asset('images/icon-title-news.png')}}"/> lexus nx300h 2016</h3>
            <p>Đăng bởi <span>Thắng Nguyễn</span> - 01/07/2017</p>
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
                            <li><p>*Năm sản xuất: 2016</p></li>
                            <li><p>*Tình trạng: Xe mới</p></li>
                            <li><p>*KM đã đi: 0 km</p></li>
                        </ul>
                        <ul>
                            <li><p>*Hệ thống nhiên liệu: Phun xăng điện tử</p></li>
                            <li><p>*Nhiê liệu: Xăng</p></li>
                            <li><p>*Dòng xe: SUV/Crossover</p></li>
                        </ul>
                        <ul class="final-ul">
                            <li><p>*Màu sắc: Trắng</p></li>
                            <li><p>*Số ghế: 4</p></li>
                            <li><p>*Tỉnh thành: HCM</p></li>
                        </ul>
                    </div>
                    <p class="mo-ta">Create a list that contain links. These links are used to open the specific tab content. All elements with class="tabcontent" are hidden by default (with CSS & JS) - when the user clicks on a link - it will open the tab content that "matches" this link.
                        Demo See it in action! Click the thumbnail below to open the lightbox. This demo includes the optional .lightbox-caption element, which adds an image caption.</p>
                    <div class="price">
                        <p class="p-price">2.730.000.000 VND</p>
                        <p class="p-address">Đ/C: 02 Phạm Văn Đồng, P.Linh Đông, Q.Thủ Đức, TP. Hồ Chí Minh</p>
                        <p class="p-phone">Điện thoại: <span>0937 905 938</span></p>
                    </div>
                </div>
                <div id="tab2" class="tab-pane fade">
                    <div>
                        <p class="p-thuoc-tinh-post">túi khí an toàn</p>
                        <label class="checkbox-inline">*Túi khí người lái<input disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Túi khí khách phía trước<input disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Túi khí khách phía sau<input disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Túi khí hai bên ghế<input disabled="disabled" type="checkbox" value=""></label>
                    </div>
                    <div>
                        <p class="p-thuoc-tinh-post">phanh - điều khiển</p>
                        <label class="checkbox-inline">*Chống bó cứng phanh(ABS)<input disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Phân bổ lực phanh điện tử<input disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Trợ lực phanh khẩn cấp(EBA)<input disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Điều khiển hành trình<input disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Tự động cân bằng điện tử(ESP)<input disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Hỗ trợ cảnh báo lùi<input disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Hệ thống kiểm soát trượt<input disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Chốt cửa an toàn<input disabled="disabled" type="checkbox" value=""></label>
                    </div>
                    <div>
                        <p class="p-thuoc-tinh-post">khóa chống trộm</p>
                        <label class="checkbox-inline">*Khóa cửa tự động<input disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Khóa cửa điều khiển từ xa<input disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Khóa động cơ<input disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Hệ thống báo trộm ngoại vi<input disabled="disabled" type="checkbox" value=""></label>
                    </div>
                    <div>
                        <p class="p-thuoc-tinh-post">các thống số khác</p>
                        <label class="checkbox-inline">*Đèn sương mù<input disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Đèn báo thắt dây an toàn<input disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Đèn phanh phụ thứ 3 lắp cao<input disabled="disabled" type="checkbox" value=""></label>
                    </div>
                </div>
                <div id="tab3" class="tab-pane fade">
                    <div>
                        <label class="checkbox-inline">*Thiết bị định vị<input disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Thiết bị giải trí<input disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Kính chính diện<input disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Điều hòa sau<input disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Điều hòa trước<input disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Hỗ trợ xe tự động<input disabled="disabled" type="checkbox" value=""></label><br>
                        <label class="checkbox-inline">*Sấy kính sau<input disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Kính màu<input disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Cửa sổ nóc<input disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Tay lái trợ lực<input disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Quạt kính sau<input disabled="disabled" type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Màn hình LCD<input disabled="disabled" type="checkbox" value=""></label>
                    </div>
                    <p class="mo-ta">Create a list that contain links. These links are used to open the specific tab content. All elements with class="tabcontent" are hidden by default (with CSS & JS) - when the user clicks on a link - it will open the tab content that "matches" this link.
                        Demo See it in action! Click the thumbnail below to open the lightbox. This demo includes the optional .lightbox-caption element, which adds an image caption.</p>
                </div>
                <div id="tab4" class="tab-pane fade">
                    <div>
                        <p class="p-thuoc-tinh-post">kích thước/ Trọng lượng</p>
                        <label class="checkbox-inline">*Chiều dài: 4.63m</label>
                        <label class="checkbox-inline">*Chiều rộng: 1.4m</label>
                        <label class="checkbox-inline">*Chiều cao: 1.3m</label>
                        <label class="checkbox-inline">*Trọng lượng không tải: 1.839kg</label>
                        <label class="checkbox-inline">*Dung tích nhiên liệu: 56 lít</label>
                    </div>
                    <div>
                        <p class="p-thuoc-tinh-post">động cơ</p>
                        <label class="checkbox-inline">*Động cơ: 1200 mã lực</label>
                        <label class="checkbox-inline">*Kiểu động cơ: 225/65R17</label>
                        <label class="checkbox-inline">*Dung tích xilanh: 2494 cm3</label>
                    </div>
                    <div>
                        <p class="p-thuoc-tinh-post">phanh giảm sóc-lốp</p>
                        <label class="checkbox-inline">*Phanh: Hệ thống ABS</label>
                        <label class="checkbox-inline">*Giảm sóc: Cảm biến TPMS</label>
                        <label class="checkbox-inline">*Lốp xe/ Vành mâm: </label>
                    </div>
                </div>
            </div>
            <div class="related-post">
                <p><img src="{{ URL::asset('images/icon-title-news.png')}}"/> có thể bạn cũng thích</p>
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
