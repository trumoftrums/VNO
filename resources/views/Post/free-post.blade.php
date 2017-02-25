@extends('Layouts.frontend')
<link rel="stylesheet" type="text/css" href="../js/dhtmlx5/dhtmlx.css"/>
<link rel="stylesheet" type="text/css" href="../js/dhtmlx5/fonts/font_roboto/roboto.css"/>
<script src="../js/dhtmlx5/dhtmlx.js"></script>
<style>
    .dhxlayout_base_material div.dhxcelltop_toolbar{
        padding-bottom: 2px !important;
    }
    div.dhxform_control input.dhxform_textarea{
        border: 1px solid #DDDDDD !important;
    }
    .dhxform_label label{
        font-weight: normal !important;
    }
    .dhxform_obj_material .dhxform_textarea{
        border-width: 1px 1px 1px 1px !important;
    }
    div.gridbox table.row20px tr  td img{
        max-height:60px !important;
    }
    .dhxform_obj_material div.dhxform_base {
        position: relative;
        float: left;
        margin-right: 10px;
        margin-left: 5px;
    }
    .dhxcombolist_material{
        height:250px;
    }
    #tab2 .dhxform_obj_material div.dhxform_item_label_left{
        padding-top: 0px;
    }
    #tab4 .dhxform_obj_material div.dhxform_item_label_left{
        padding-top: 6px;
    }
</style>
@section('content')
    <div class="detail-post">
        <div class="header-free-post">
            <img class="avatar-free-post img-circle"
                 @if($user->avatar != null)
                 src="{{ URL::asset($user->avatar)}}"
                 @else
                 src="{{ URL::asset('images/icon-avatar.png')}}"
                    @endif
            />
            <h4 class="user-name-free-post">
                <img class="line-free-post" src="{{ URL::asset('images/line.png')}}"/>
                {{$user->username}}
                <img class="line-free-post" src="{{ URL::asset('images/line.png')}}"/>
            </h4>
        </div>
        <div class="info-post">
            <ul class="ul-cover-tabs-post">
                <li class="active"><a data-toggle="tab" href="#tab1">THÔNG TIN CĂN BẢN</a></li>
                <li><a data-toggle="tab" href="#tab2">THÔNG TIN AN TOÀN</a></li>
                <li><a data-toggle="tab" href="#tab3">TÍNH TIỆN NGHI</a></li>
                <li><a data-toggle="tab" href="#tab4">THÔNG TIN KỸ THUẬT</a></li>
            </ul>
            <div class="cover-tab-post tab-content">
                <div id="tab1" class="tab-pane fade in active" style="float: left;position:relative;width: 100%">
                    <div class="cover-tab-free">
                        <ul>
                            <li>
                                <div class="col-md-4">
                                    <label>Thương hiệu xe</label>
                                    <select class="free-post-input">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Dòng xe</label>
                                    <select class="free-post-input">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Dáng xe</label>
                                    <select class="free-post-input">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div class="col-md-4">
                                    <label>Tình trạng</label>
                                    <select class="free-post-input">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Năm sản xuất</label>
                                    <select class="free-post-input">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>KM đã đi</label>
                                    <select class="free-post-input">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div class="col-md-4">
                                    <label>Màu sắc</label>
                                    <input type="text" class="free-post-input">
                                </div>
                                <div class="col-md-4">
                                    <label>Hệ thống nhiên liệu</label>
                                    <select class="free-post-input">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Nhiên liệu</label>
                                    <select class="free-post-input">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div class="col-md-4">
                                    <label>Số ghế</label>
                                    <select class="free-post-input">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Tỉnh thành</label>
                                    <select class="free-post-input">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Giá tiền</label>
                                    <input type="text" class="ip-price free-post-input" placeholder="Nhập giá tiền">
                                </div>
                            </li>
                            <li>
                                <div class="col-md-4">
                                    <label>Số điện thoại</label>
                                    <input type="text" class="free-post-input">
                                </div>
                                <div class="col-md-8">
                                    <label class="lb-address">Địa chỉ</label>
                                    <input type="text" class="ip-long free-post-input">
                                </div>
                            </li>
                            <li>
                                <div class="col-md-5">
                                    <textarea class="ip-descript" rows="5" id="comment" placeholder="Hãy nhập thông tin mô tả chi tiết"></textarea>
                                </div>
                                <div class="col-md-7">
                                    <div class="cover-inp-upload">
                                        <input type="file" class="upload-image img-upload-1" size="20"/>
                                        <img src="{{ URL::asset('./images/1.png')}}"/>
                                    </div>
                                    <div class="cover-inp-upload">
                                        <input type="file" class="upload-image img-upload-2" size="20"/>
                                        <img src="{{ URL::asset('./images/2.png')}}"/>
                                    </div>
                                    <div class="cover-inp-upload">
                                        <input type="file" class="upload-image img-upload-3" size="20"/>
                                        <img src="{{ URL::asset('./images/3.png')}}"/>
                                    </div>
                                    <div class="cover-inp-upload">
                                        <input type="file" class="upload-image img-upload-4" size="20"/>
                                        <img src="{{ URL::asset('./images/4.png')}}"/>
                                    </div>
                                    <div class="cover-inp-upload">
                                        <input type="file" class="upload-image img-upload-5" size="20"/>
                                        <img src="{{ URL::asset('./images/5.png')}}"/>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <input type="submit" class="btn-next-free-post" value="TIẾP TỤC >>"/>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="tab2" class="tab-pane fade">
                    <div>
                        <p class="p-thuoc-tinh-post">túi khí an toàn</p>
                        <label class="checkbox-inline">*Túi khí người lái<input type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Túi khí khách phía trước<input type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Túi khí khách phía sau<input type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Túi khí hai bên ghế<input type="checkbox" value=""></label>
                    </div>
                    <div>
                        <p class="p-thuoc-tinh-post">phanh - điều khiển</p>
                        <label class="checkbox-inline">*Chống bó cứng phanh(ABS)<input type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Phân bổ lực phanh điện tử<input type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Trợ lực phanh khẩn cấp(EBA)<input type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Điều khiển hành trình<input type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Tự động cân bằng điện tử(ESP)<input type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Hỗ trợ cảnh báo lùi<input type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Hệ thống kiểm soát trượt<input type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Chốt cửa an toàn<input type="checkbox" value=""></label>
                    </div>
                    <div>
                        <p class="p-thuoc-tinh-post">khóa chống trộm</p>
                        <label class="checkbox-inline">*Khóa cửa tự động<input type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Khóa cửa điều khiển từ xa<input type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Khóa động cơ<input type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Hệ thống báo trộm ngoại vi<input type="checkbox" value=""></label>
                    </div>
                    <div>
                        <p class="p-thuoc-tinh-post">các thống số khác</p>
                        <label class="checkbox-inline">*Đèn sương mù<input type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Đèn báo thắt dây an toàn<input type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Đèn phanh phụ thứ 3 lắp cao<input type="checkbox" value=""></label>
                    </div>
                    <div>
                        <input type="submit" class="btn-next-free-post" value="TIẾP TỤC >>"/>
                    </div>
                </div>
                <div id="tab3" class="tab-pane fade">
                    <div>
                        <label class="checkbox-inline">*Thiết bị định vị<input type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Thiết bị giải trí<input type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Kính chính diện<input type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Điều hòa sau<input type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Điều hòa trước<input type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Hỗ trợ xe tự động<input type="checkbox" value=""></label><br>
                        <label class="checkbox-inline">*Sấy kính sau<input type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Kính màu<input type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Cửa sổ nóc<input type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Tay lái trợ lực<input type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Quạt kính sau<input type="checkbox" value=""></label>
                        <label class="checkbox-inline">*Màn hình LCD<input type="checkbox" value=""></label>
                    </div>
                    <div>
                        <p class="p-descript">MÔ TẢ THÊM</p>
                        <textarea class="ip-descript" rows="5" id="comment" placeholder="Hãy nhập thông tin mô tả chi tiết"></textarea>
                    </div>
                    <div>
                        <input type="submit" class="btn-next-free-post" value="TIẾP TỤC >>"/>
                    </div>
                </div>
                <div id="tab4" class="tab-pane fade">
                    <div>
                        <p class="p-thuoc-tinh-post">kích thước/ Trọng lượng</p>
                        <label class="checkbox-inline">*Chiều dài: <input type="text" class="free-post-input"></label>
                        <label class="checkbox-inline">*Chiều rộng: <input type="text" class="free-post-input"></label>
                        <label class="checkbox-inline">*Chiều cao: <input type="text" class="free-post-input"></label>
                        <label class="checkbox-inline">*Trọng lượng không tải: <input type="text" class="free-post-input"></label>
                        <label class="checkbox-inline">*Dung tích nhiên liệu: <input type="text" class="free-post-input"></label>
                    </div>
                    <div>
                        <p class="p-thuoc-tinh-post">động cơ</p>
                        <label class="checkbox-inline">*Động cơ: <input type="text" class="free-post-input"></label>
                        <label class="checkbox-inline">*Kiểu động cơ: <input type="text" class="free-post-input"></label>
                        <label class="checkbox-inline">*Dung tích xilanh: <input type="text" class="free-post-input"></label>
                    </div>
                    <div>
                        <p class="p-thuoc-tinh-post">phanh giảm sóc-lốp</p>
                        <label class="checkbox-inline">*Phanh: <input type="text" class="free-post-input"></label>
                        <label class="checkbox-inline">*Giảm sóc: <input type="text" class="free-post-input"></label>
                        <label class="checkbox-inline">*Lốp xe/ Vành mâm: <input type="text" class="free-post-input"></label>
                    </div>
                    <div>
                        <input type="submit" class="btn-next-free-post" value="ĐĂNG BÀI"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
