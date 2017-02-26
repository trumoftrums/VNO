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
        <form id="fmbaiviet" action="" method="post" enctype="multipart/form-data">


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
                                    <label>Thương hiệu xe<?php if($thongso["thongso_20"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <select type="select" class="free-post-input <?php if($thongso["thongso_20"]['required']=="true"){echo 'fm_required';}?>" name ="thongso_20">
                                        <option value="">Click chọn</option>
                                        <?php
                                            if(isset($thongso["thongso_20"]["arr_options"]) && !empty($thongso["thongso_20"]["arr_options"])){
                                                foreach ($thongso["thongso_20"]["arr_options"] as $k=>$v){
                                                    echo '<option value="'.$k.'">'.$v.'</option>';
                                                }
                                            }

                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Dòng xe</label>
                                    <select  type="select" class="free-post-input">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Dáng xe<?php if($thongso["thongso_25"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <select  type="select" class="free-post-input <?php if($thongso["thongso_25"]['required']=="true"){echo 'fm_required';}?>" name="thongso_25">
                                        <option value="">Click chọn</option>
                                        <?php
                                        if(isset($thongso["thongso_25"]["arr_options"]) && !empty($thongso["thongso_25"]["arr_options"])){
                                            foreach ($thongso["thongso_25"]["arr_options"] as $k=>$v){
                                                echo '<option value="'.$k.'">'.$v.'</option>';
                                            }
                                        }

                                        ?>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div class="col-md-4">
                                    <label>Tình trạng<?php if($thongso["thongso_24"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <select  type="select" class="free-post-input <?php if($thongso["thongso_24"]['required']=="true"){echo 'fm_required';}?>" name="thongso_24">
                                        <option value="">Click chọn</option>
                                        <?php
                                        if(isset($thongso["thongso_24"]["arr_options"]) && !empty($thongso["thongso_24"]["arr_options"])){
                                            foreach ($thongso["thongso_24"]["arr_options"] as $k=>$v){
                                                echo '<option value="'.$k.'">'.$v.'</option>';
                                            }
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Năm sản xuất<?php if($thongso["thongso_22"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <select  type="select" class="free-post-input <?php if($thongso["thongso_22"]['required']=="true"){echo 'fm_required';}?>" name="thongso_22">
                                        <option value="">Click chọn</option>
                                        <?php
                                        if(isset($thongso["thongso_22"]["arr_options"]) && !empty($thongso["thongso_22"]["arr_options"])){
                                            foreach ($thongso["thongso_22"]["arr_options"] as $k=>$v){
                                                echo '<option value="'.$k.'">'.$v.'</option>';
                                            }
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>KM đã đi<?php if($thongso["thongso_26"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <input type="text" class="free-post-input onlynumber <?php if($thongso["thongso_26"]['required']=="true"){echo 'fm_required';}?>" name="thongso_26">
                                </div>
                            </li>
                            <li>
                                <div class="col-md-4">
                                    <label>Màu sắc<?php if($thongso["thongso_27"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <input type="text" class="free-post-input <?php if($thongso["thongso_27"]['required']=="true"){echo 'fm_required';}?>" name="thongso_27">
                                </div>
                                <div class="col-md-4">
                                    <label>Hệ thống nhiên liệu<?php if($thongso["thongso_31"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <select  type="select" class="free-post-input <?php if($thongso["thongso_31"]['required']=="true"){echo 'fm_required';}?>" name="thongso_31">
                                        <option value="">Click chọn</option>
                                        <?php
                                        if(isset($thongso["thongso_31"]["arr_options"]) && !empty($thongso["thongso_31"]["arr_options"])){
                                            foreach ($thongso["thongso_31"]["arr_options"] as $k=>$v){
                                                echo '<option value="'.$k.'">'.$v.'</option>';
                                            }
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Nhiên liệu<?php if($thongso["thongso_32"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <select  type="select" class="free-post-input <?php if($thongso["thongso_32"]['required']=="true"){echo 'fm_required';}?>" name="thongso_32">
                                        <option value="">Click chọn</option>
                                        <?php
                                        if(isset($thongso["thongso_32"]["arr_options"]) && !empty($thongso["thongso_32"]["arr_options"])){
                                            foreach ($thongso["thongso_32"]["arr_options"] as $k=>$v){
                                                echo '<option value="'.$k.'">'.$v.'</option>';
                                            }
                                        }

                                        ?>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div class="col-md-4">
                                    <label>Số ghế<?php if($thongso["thongso_30"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <select  type="select" class="free-post-input <?php if($thongso["thongso_30"]['required']=="true"){echo 'fm_required';}?>" name="thongso_30">
                                        <option value="">Click chọn</option>
                                        <?php
                                        if(isset($thongso["thongso_30"]["arr_options"]) && !empty($thongso["thongso_30"]["arr_options"])){
                                            foreach ($thongso["thongso_30"]["arr_options"] as $k=>$v){
                                                echo '<option value="'.$k.'">'.$v.'</option>';
                                            }
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Tỉnh thành<?php if($thongso["thongso_62"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <select  type="select" class="free-post-input <?php if($thongso["thongso_62"]['required']=="true"){echo 'fm_required';}?>" name="thongso_62">
                                        <option value=""><i style="color: #d1d1d1;">Click chọn</i></option>
                                        <?php
                                        if(isset($thongso["thongso_62"]["arr_options"]) && !empty($thongso["thongso_62"]["arr_options"])){
                                            foreach ($thongso["thongso_62"]["arr_options"] as $k=>$v){
                                                echo '<option value="'.$k.'">'.$v.'</option>';
                                            }
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Giá tiền<?php if($thongso["thongso_65"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <input type="text" class="ip-price free-post-input onlynumber <?php if($thongso["thongso_65"]['required']=="true"){echo 'fm_required';}?>" name="thongso_65" placeholder="Nhập giá tiền">
                                </div>
                            </li>
                            <li>
                                <div class="col-md-4">
                                    <label>Số điện thoại<?php if($thongso["thongso_63"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <input maxlength="11" type="text" class="free-post-input onlynumber  <?php if($thongso["thongso_63"]['required']=="true"){echo 'fm_required';}?>" name="thongso_63">
                                </div>
                                <div class="col-md-8">
                                    <label class="lb-address">Địa chỉ<?php if($thongso["thongso_68"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <input type="text" class="free-post-input  <?php if($thongso["thongso_68"]['required']=="true"){echo 'fm_required';}?>" name="thongso_68">
                                </div>
                            </li>
                            <li>
                                <div class="col-md-5">
                                    <textarea type="textarea" class="ip-descript <?php if($thongso["thongso_67"]['required']=="true"){echo 'fm_required';}?>" rows="5" name="thongso_67" id="comment" maxlength="1200" placeholder="Hãy nhập thông tin mô tả chi tiết"></textarea>
                                </div>
                                <div class="col-md-7">
                                    <div class="cover-inp-upload">

                                        <input  type="file" class="upload-image img-upload-1" id="photo1" name="file_photo1" size="20"/>
                                        <img id="img_photo1" src="{{ URL::asset('./images/1.png')}}"/>
                                        <input type="hidden" class="fm_required" name="photo1" value=""/>
                                    </div>
                                    <div class="cover-inp-upload">
                                        <input  type="file" class="upload-image img-upload-2" id="photo2" name="file_photo2" size="20"/>
                                        <img id="img_photo2" src="{{ URL::asset('./images/2.png')}}"/>
                                        <input type="hidden"  class="fm_required" name="photo2"  value=""/>
                                    </div>
                                    <div class="cover-inp-upload">
                                        <input type="file" class="upload-image img-upload-3" id="photo3" name="file_photo3" size="20"/>
                                        <img id="img_photo3" src="{{ URL::asset('./images/3.png')}}"/>
                                        <input type="hidden"  class="fm_required" name="photo3"  value=""/>
                                    </div>
                                    <div class="cover-inp-upload">
                                        <input type="file" class="upload-image img-upload-4" id="photo4" name="file_photo4" size="20"/>
                                        <img id="img_photo4" src="{{ URL::asset('./images/4.png')}}"/>
                                        <input type="hidden"  class="fm_required" name="photo4"  value=""/>
                                    </div>
                                    <div class="cover-inp-upload">
                                        <input type="file" class="upload-image img-upload-5" id="photo5" name="file_photo5" size="20"/>
                                        <img id="img_photo5" src="{{ URL::asset('./images/5.png')}}"/>
                                        <input type="hidden"  class="fm_required" name="photo5"  value=""/>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <input type="button" class="btn-next-free-post" id="btnNext_tab1" value="TIẾP TỤC >>"/>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="tab2" class="tab-pane fade">
                    <div>
                        <p class="p-thuoc-tinh-post">túi khí an toàn</p>
                        <label class="checkbox-inline">*Túi khí người lái<input type="checkbox" name="thongso_1" value=""></label>
                        <label class="checkbox-inline">*Túi khí khách phía trước<input type="checkbox" name="thongso_2" value=""></label>
                        <label class="checkbox-inline">*Túi khí khách phía sau<input type="checkbox" name="thongso_3" value=""></label>
                        <label class="checkbox-inline">*Túi khí hai bên ghế<input type="checkbox" name="thongso_4" value=""></label>
                    </div>
                    <div>
                        <p class="p-thuoc-tinh-post">phanh - điều khiển</p>
                        <label class="checkbox-inline">*Chống bó cứng phanh(ABS)<input type="checkbox" name="thongso_5" value=""></label>
                        <label class="checkbox-inline">*Phân bổ lực phanh điện tử<input type="checkbox" name="thongso_9" value=""></label>
                        <label class="checkbox-inline">*Trợ lực phanh khẩn cấp(EBA)<input type="checkbox" name="thongso_6" value=""></label>
                        <label class="checkbox-inline">*Điều khiển hành trình<input type="checkbox" name="thongso_7" value=""></label>
                        <label class="checkbox-inline">*Tự động cân bằng điện tử(ESP)<input type="checkbox" name="thongso_10" value=""></label>
                        <label class="checkbox-inline">*Hỗ trợ cảnh báo lùi<input type="checkbox" name="thongso_11"  value=""></label>
                        <label class="checkbox-inline">*Hệ thống kiểm soát trượt<input type="checkbox" name="thongso_8" value=""></label>
                        <label class="checkbox-inline">*Chốt cửa an toàn<input type="checkbox" name="thongso_12" value=""></label>
                    </div>
                    <div>
                        <p class="p-thuoc-tinh-post">khóa chống trộm</p>
                        <label class="checkbox-inline">*Khóa cửa tự động<input type="checkbox" name="thongso_13" value=""></label>
                        <label class="checkbox-inline">*Khóa cửa điều khiển từ xa<input type="checkbox" name="thongso_15" value=""></label>
                        <label class="checkbox-inline">*Khóa động cơ<input type="checkbox" name="thongso_14" value=""></label>
                        <label class="checkbox-inline">*Hệ thống báo trộm ngoại vi<input type="checkbox" name="thongso_16" value=""></label>
                    </div>
                    <div>
                        <p class="p-thuoc-tinh-post">các thống số khác</p>
                        <label class="checkbox-inline">*Đèn sương mù<input type="checkbox" name="thongso_17" value=""></label>
                        <label class="checkbox-inline">*Đèn báo thắt dây an toàn<input type="checkbox" name="thongso_19" value=""></label>
                        <label class="checkbox-inline">*Đèn phanh phụ thứ 3 lắp cao<input type="checkbox" name="thongso_18" value=""></label>
                    </div>
                    <div>
                        <input type="button" class="btn-next-free-post" id="btnNext_tab2" value="TIẾP TỤC >>"/>
                    </div>
                </div>
                <div id="tab3" class="tab-pane fade">
                    <div>
                        <label class="checkbox-inline">*Thiết bị định vị<input type="checkbox"  name="thongso_36"  value=""></label>
                        <label class="checkbox-inline">*Thiết bị giải trí<input type="checkbox"  name="thongso_38" value=""></label>
                        <label class="checkbox-inline">*Kính chính diện<input type="checkbox"  name="thongso_37"  value=""></label>
                        <label class="checkbox-inline">*Điều hòa sau<input type="checkbox"  name="thongso_39" value=""></label>
                        <label class="checkbox-inline">*Điều hòa trước<input type="checkbox"  name="thongso_45" value=""></label>
                        <label class="checkbox-inline">*Hỗ trợ xe tự động<input type="checkbox"  name="thongso_46"  value=""></label><br>
                        <label class="checkbox-inline">*Sấy kính sau<input type="checkbox"  name="thongso_40" value=""></label>
                        <label class="checkbox-inline">*Kính màu<input type="checkbox"  name="thongso_41" value=""></label>
                        <label class="checkbox-inline">*Cửa sổ nóc<input type="checkbox"  name="thongso_43" value=""></label>
                        <label class="checkbox-inline">*Tay lái trợ lực<input type="checkbox"  name="thongso_44" value=""></label>
                        <label class="checkbox-inline">*Quạt kính sau<input type="checkbox"  name="thongso_47" value=""></label>
                        <label class="checkbox-inline">*Màn hình LCD<input type="checkbox"  name="thongso_48" value=""></label>
                    </div>
                    <div>
                        <p class="p-descript">MÔ TẢ THÊM</p>
                        <textarea class="ip-descript" rows="5" id="comment" placeholder="Hãy nhập thông tin mô tả chi tiết"></textarea>
                    </div>
                    <div>
                        <input type="button" class="btn-next-free-post" id="btnNext_tab3" value="TIẾP TỤC >>"/>
                    </div>
                </div>
                <div id="tab4" class="tab-pane fade">
                    <div>
                        <p class="p-thuoc-tinh-post">kích thước/ Trọng lượng</p>
                        <label class="checkbox-inline">*Chiều dài: <input type="text"  name="thongso_50" class="free-post-input onlynumber"></label>
                        <label class="checkbox-inline">*Chiều rộng: <input type="text"  name="thongso_51" class="free-post-input onlynumber"></label>
                        <label class="checkbox-inline">*Chiều cao: <input type="text"  name="thongso_52" class="free-post-input onlynumber"></label>
                        <label class="checkbox-inline">*Trọng lượng không tải: <?php if($thongso["thongso_53"]['required']=="true"){echo '<span style="color:red;">*</span>';}?><input type="text"  name="thongso_53" class="free-post-input onlynumber <?php if($thongso["thongso_53"]['required']=="true"){echo 'fm_required';}?>"></label>
                        <label class="checkbox-inline">*Dung tích nhiên liệu: <?php if($thongso["thongso_54"]['required']=="true"){echo '<span style="color:red;">*</span>';}?><input type="text"  name="thongso_54" class="free-post-input onlynumber <?php if($thongso["thongso_54"]['required']=="true"){echo 'fm_required';}?>"></label>
                    </div>
                    <div>
                        <p class="p-thuoc-tinh-post">động cơ</p>
                        <label class="checkbox-inline">*Động cơ: <?php if($thongso["thongso_66"]['required']=="true"){echo '<span style="color:red;">*</span>';}?><input type="text"  name="thongso_66"  class="free-post-input <?php if($thongso["thongso_66"]['required']=="true"){echo 'fm_required';}?>"></label>
                        <label class="checkbox-inline">*Kiểu động cơ: <?php if($thongso["thongso_55"]['required']=="true"){echo '<span style="color:red;">*</span>';}?><input type="text"  name="thongso_55"  class="free-post-input <?php if($thongso["thongso_55"]['required']=="true"){echo 'fm_required';}?>"></label>
                        <label class="checkbox-inline">*Dung tích xilanh: <?php if($thongso["thongso_56"]['required']=="true"){echo '<span style="color:red;">*</span>';}?><input type="text" name="thongso_56"  class="free-post-input onlynumber <?php if($thongso["thongso_56"]['required']=="true"){echo 'fm_required';}?>"></label>
                    </div>
                    <div>
                        <p class="p-thuoc-tinh-post">phanh giảm sóc-lốp</p>
                        <label class="checkbox-inline">*Phanh: <?php if($thongso["thongso_57"]['required']=="true"){echo '<span style="color:red;">*</span>';}?><input type="text"  name="thongso_57"  class="free-post-input <?php if($thongso["thongso_57"]['required']=="true"){echo 'fm_required';}?>"></label>
                        <label class="checkbox-inline">*Giảm sóc: <?php if($thongso["thongso_58"]['required']=="true"){echo '<span style="color:red;">*</span>';}?><input type="text"  name="thongso_58" class="free-post-input <?php if($thongso["thongso_58"]['required']=="true"){echo 'fm_required';}?>"></label>
                        <label class="checkbox-inline">*Lốp xe/ Vành mâm: <?php if($thongso["thongso_59"]['required']=="true"){echo '<span style="color:red;">*</span>';}?><input type="text"  name="thongso_59" class="free-post-input <?php if($thongso["thongso_59"]['required']=="true"){echo 'fm_required';}?>"></label>
                    </div>
                    <div>
                        <input type="submit" class="btn-next-free-post" value="ĐĂNG BÀI"/>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
<script>
    $( document ).ready(function() {


    });
    $("#fmbaiviet").submit(function( event ) {
        var cando = true;
//        var formData = $( "#fmbaiviet" ).serializeArray();
//        console.log(formData);
        $( ".fm_required" ).each(function( index ) {
            var name = $(this).attr("name");
            var type = $(this).attr("type");

            var vl =$(this).val();
//            if(type=="hidden"){
//                vl = $("input[name='"+name+"']").attr("value");
//            }
            //var vl = $("*[name='"+name+"']").val();
            console.log(index+":"+name+":"+type+":"+vl);
            if(vl == null ||vl=="undefined" || vl==""){
                console.log("empty:"+$(this).attr("name"));
                cando = false;
            }
        });
        if(!cando){
            event.preventDefault();
            dhtmlx.alert("<strong>Vui lòng điền đầy đủ thông tin bắt buộc</strong>");
        }

    });
    $(".onlynumber").keydown(function(e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    $(".upload-image").change(function () {
        upload_img($(this).attr("id"));

    });

    function upload_img(fileID){
        var formData = new FormData();
        formData.append('file', $("#"+fileID)[0].files[0]);
        $.ajax({
            url: '/baiviet/uploadimg',
            type: 'POST',
            enctype: 'multipart/form-data',
            data : formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            success : function(data) {
                if(data.result){
                    $("#img_"+fileID).attr("src",data.url);
                    $( "input[name='"+fileID+"']" ).val(data.url);
                }else{
                    dhtmlx.alert(data.mess);
                }
            }
        });
    }

</script>
@stop
