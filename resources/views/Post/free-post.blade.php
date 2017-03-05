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
    .img-cap{
        cursor: pointer;
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
                <li class="active"><a data-toggle="tab" href="#tab1">THÔNG TIN CƠ BẢN</a></li>
                <li><a data-toggle="tab" href="#tab2">LOẠI TIN ĐĂNG</a></li>
            </ul>
            <div class="cover-tab-post tab-content">
                <div id="tab1" class="tab-pane fade in active" style="float: left;position:relative;width: 100%">
                    <div class="cover-tab-free">
                        <ul>
                            <li>
                                <p class="p-title-area">MÔ TẢ CƠ BẢN</p>
                            </li>
                            <li>
                                <div class="item-cover-one">
                                    <label>Hãng xe<span style="color:red;">*</span></label>
                                    <select type="select" class="free-post-input fm_required" name ="thongso_20">
                                        <option value="">Click chọn</option>
                                        <?php
//                                            var_dump($hangxes);exit();
                                        if(isset($hangxes) && !empty($hangxes)){
                                            foreach ($hangxes as $k=>$v){
                                                echo '<option value="'.$k.'">'.$v.'</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="item-cover-one">
                                    <label class="mar-right ">Dòng xe<span style="color:red;">*</span></label>
                                    <select  type="select" class="free-post-input fm_required" name="thongso_75">
                                        <option value="">Click chọn</option>
                                    </select>
                                </div>
                                <div class="item-cover-one">
                                    <label class="mar-right">Dáng xe<?php if($thongso["thongso_25"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
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
                                <div class="item-cover-one">
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
                                <div class="item-cover-one">
                                    <label class="mar-right">Xuất xứ<?php if($thongso["thongso_70"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <select  type="select" class="free-post-input <?php if($thongso["thongso_70"]['required']=="true"){echo 'fm_required';}?>" name="thongso_70">
                                        <option value="">Click chọn</option>
                                        <?php
                                        if(isset($thongso["thongso_70"]["arr_options"]) && !empty($thongso["thongso_70"]["arr_options"])){
                                            foreach ($thongso["thongso_70"]["arr_options"] as $k=>$v){
                                                echo '<option value="'.$k.'">'.$v.'</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="item-cover-one">
                                    <label class="mar-right">Tình trạng<?php if($thongso["thongso_24"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
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
                            </li>
                            <li>
                                <div class="item-cover-one">
                                    <label>Năm SX<?php if($thongso["thongso_22"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
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
                                <div class="item-cover-one">
                                    <label  class="mar-right">KM đã đi<?php if($thongso["thongso_26"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <input type="text" class="free-post-inp-text onlynumber <?php if($thongso["thongso_26"]['required']=="true"){echo 'fm_required';}?>" placeholder="Nhập số KM đã đi" name="thongso_26">

                                </div>
                                <div class="item-cover-one">

                                    <label  class="mar-right">Màu sắc<?php if($thongso["thongso_27"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <input type="text" class="free-post-inp-text <?php if($thongso["thongso_27"]['required']=="true"){echo 'fm_required';}?>" placeholder="Nhập màu xe" name="thongso_27">

                                </div>
                            </li>
                            <li>
                                <p class="p-title-area">THÔNG SỐ CƠ BẢN</p>
                            </li>
                            <li>
                                <div class="item-cover-one">
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
                                <div class="item-cover-one">
                                    <label class="mar-right">Hộp số<?php if($thongso["thongso_34"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <select  type="select" class="free-post-input <?php if($thongso["thongso_34"]['required']=="true"){echo 'fm_required';}?>" name="thongso_34">
                                        <option value="">Click chọn</option>
                                        <?php
                                        if(isset($thongso["thongso_34"]["arr_options"]) && !empty($thongso["thongso_34"]["arr_options"])){
                                            foreach ($thongso["thongso_34"]["arr_options"] as $k=>$v){
                                                echo '<option value="'.$k.'">'.$v.'</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="item-cover-one">
                                    <label class="mar-right">Dẫn động<?php if($thongso["thongso_33"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <select  type="select" class="free-post-input <?php if($thongso["thongso_33"]['required']=="true"){echo 'fm_required';}?>" name="thongso_33">
                                        <option value="">Click chọn</option>
                                        <?php
                                        if(isset($thongso["thongso_33"]["arr_options"]) && !empty($thongso["thongso_33"]["arr_options"])){
                                            foreach ($thongso["thongso_33"]["arr_options"] as $k=>$v){
                                                echo '<option value="'.$k.'">'.$v.'</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div class="item-cover-one">
                                    <label>Số ghế - cửa<?php if($thongso["thongso_74"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <input type="text" class="free-post-inp-text <?php if($thongso["thongso_74"]['required']=="true"){echo 'fm_required';}?>" name="thongso_74" placeholder="Nhập số ghế - cửa">
                                </div>
                                <div class="item-cover-two">
                                    <label class="mar-right">Mức tiệu thụ</label>
                                    <input type="text" class="free-post-inp-text inp-tieu-thu" name="thongso_71" placeholder="Lit/KM trên phạm vi đô thị">
                                    <input type="text" style="margin-right:1vw" class="free-post-inp-text inp-tieu-thu" name="thongso_72" placeholder="Lit/KM trên phạm vi đường trường">

                                    {{--<input type="text" class="free-post-inp-text inp-tieu-thu" placeholder="Lit/KM trên phạm vi đô thị">--}}
                                    {{--<input type="text"  style="margin-right:1vw" class="free-post-inp-text inp-tieu-thu" placeholder="Lit/KM trên phạm vi đường trường">--}}
                                </div>
                            </li>
                            <li>
                                <div class="item-cover-one">

                                    <label>Số điện thoại<?php if($thongso["thongso_63"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <input maxlength="11" type="text" class="free-post-inp-text onlynumber  <?php if($thongso["thongso_63"]['required']=="true"){echo 'fm_required';}?>" name="thongso_63" placeholder="Nhập số điện thoại">

                                </div>
                                <div class="item-cover-two">

                                    <label class="mar-right">Địa chỉ<?php if($thongso["thongso_68"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <input type="text" class="free-post-inp-text inp-address  <?php if($thongso["thongso_68"]['required']=="true"){echo 'fm_required';}?>" name="thongso_68" placeholder="Nhập địa chỉ của bạn">

                                </div>
                            </li>
                            <li>
                                <div class="item-cover-one">
                                    <label>Giá tiền<?php if($thongso["thongso_65"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <input type="text" class="free-post-inp-text onlynumber <?php if($thongso["thongso_65"]['required']=="true"){echo 'fm_required';}?>" name="thongso_65" placeholder="Nhập giá tiền">

                                </div>
                                <div class="item-cover-two">
                                    <label class="mar-right">Xe này có thể vay</label>
                                    <input type="text" class="free-post-inp-text inp-address" name="thongso_73" placeholder="Nhập số tiền hỗ trợ">
                                </div>
                            </li>
                            <li>
                                <p class="p-title-area">MÔ TẢ XE CỦA BẠN</p>
                            </li>
                            <li>
                                <textarea type="textarea" class="ckeditor <?php if($thongso["thongso_67"]['required']=="true"){echo 'fm_required';}?>" rows="5" name="thongso_67" id="comment" maxlength="1200" placeholder="Hãy nhập thông tin mô tả chi tiết"></textarea>
                            </li>
                            <li>
                                <div class="col-md-12" style="padding: 0px;">
                                    <div class="parent-img-upload">
                                        <div class="cover-inp-upload">

                                            <input  type="file" class="upload-image img-upload-1" id="photo1" name="file_photo1" size="20"/>
                                            <img id="img_photo1" src="<?php if(isset($baiviet['photo1']) && !empty($baiviet['photo1'])) echo '/uploads/baiviet/'.$baiviet['photo1'];else echo './images/1.png'; ?>"/>
                                            <input type="hidden" class="fm_required" name="photo1" value="<?php if(isset($baiviet['photo1']) && !empty($baiviet['photo1'])) echo $baiviet['photo1'];?>"/>
                                        </div>
                                        <div class="cover-inp-upload">
                                            <input  type="file" class="upload-image img-upload-2" id="photo2" name="file_photo2" size="20"/>
                                            <img id="img_photo2" src="<?php if(isset($baiviet['photo2']) && !empty($baiviet['photo2'])) echo '/uploads/baiviet/'.$baiviet['photo2'];else echo './images/2.png'; ?>"/>
                                            <input type="hidden"  class="fm_required" name="photo2"  value="<?php if(isset($baiviet['photo2']) && !empty($baiviet['photo2'])) echo $baiviet['photo2'];?>"/>
                                        </div>
                                        <div class="cover-inp-upload">
                                            <input type="file" class="upload-image img-upload-3" id="photo3" name="file_photo3" size="20"/>
                                            <img id="img_photo3" src="<?php if(isset($baiviet['photo3']) && !empty($baiviet['photo3'])) echo '/uploads/baiviet/'.$baiviet['photo3'];else echo './images/3.png'; ?>"/>
                                            <input type="hidden"  class="fm_required" name="photo3"  value="<?php if(isset($baiviet['photo3']) && !empty($baiviet['photo3'])) echo $baiviet['photo3'];?>"/>
                                        </div>
                                        <div class="cover-inp-upload">
                                            <input type="file" class="upload-image img-upload-4" id="photo4" name="file_photo4" size="20"/>
                                            <img id="img_photo4" src="<?php if(isset($baiviet['photo4']) && !empty($baiviet['photo4'])) echo '/uploads/baiviet/'.$baiviet['photo4'];else echo './images/4.png'; ?>"/>
                                            <input type="hidden"  class="fm_required" name="photo4"  value="<?php if(isset($baiviet['photo4']) && !empty($baiviet['photo4'])) echo $baiviet['photo4'];?>"/>
                                        </div>
                                        <div class="cover-inp-upload">
                                            <input type="file" class="upload-image img-upload-5" id="photo5" name="file_photo5" size="20"/>
                                            <img id="img_photo5" src="<?php if(isset($baiviet['photo5']) && !empty($baiviet['photo5'])) echo '/uploads/baiviet/'.$baiviet['photo5'];else echo './images/5.png'; ?>"/>
                                            <input type="hidden"  class="fm_required" name="photo5"  value="<?php if(isset($baiviet['photo5']) && !empty($baiviet['photo5'])) echo $baiviet['photo5'];?>"/>
                                        </div>

                                    </div>
                                </div>
                            </li>
                            <li style="text-align: center;">
                                <input type="button" class="btn-next-free-post" id="btnNext_tab1" value="TIẾP TỤC >>"/>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php $src_captcha = Captcha::src();?>
                <div id="tab2" class="tab-pane fade">
                    <p class="p-title-area">CHỌN LOẠI TIN ĐĂNG</p>
                    <div class="common-info">
                        <label class="radio-inline post-normal"><input type="radio" checked name="optradio" value="NORMAL">TIN THƯỜNG</label>
                        <label class="radio-inline post-vip1"><input type="radio" name="optradio" value="VIP001">TIN VIP 1</label>
                        <label class="radio-inline post-vip2"><input type="radio" name="optradio" value="VIP002">TIN VIP 2</label>
                        <label class="radio-inline post-vip-pro"><input type="radio" name="optradio" value="VIPPRO">TIN VIP PRO</label>
                        <div class="cover-div-first">
                            <div class="div-one">
                                <label>Ngày băt đầu</label>
                                <input type="text" id="datepicker1" class="calendar-inp" value="<?php echo date("d/m/Y");?>">
                            </div>
                            <div class="div-two">
                                <label>Ngày kết thúc</label>
                                <input type="text" id="datepicker2" class="calendar-inp" value="<?php echo date("d/m/Y",strtotime("+30 days"));?>">
                            </div>
                            <div class="div-three">
                                <label>Up tin tự động</label>
                                <div class="cover-radio">
                                    <label class="radio-inline post-normal"><input type="radio" value="1" checked name="optradio1">Có</label>
                                    <label class="radio-inline post-normal"><input type="radio" value="0" name="optradio1">Không</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="p-title-area">THÀNH TIỀN</p>
                    <div class="div-post-normal">
                        <ul>
                            <li>
                                <label>Tổng tiền</label>
                                <input type="text" class="inp-price" value="Miễn phí" disabled="disabled">
                            </li>
                            <li>
                                <label>Mã xác nhận</label>
                                <input type="text" class="code" placeholder="Nhập mã">
                                <img class="img-cap" src="{{$src_captcha}}"/>
                            </li>
                        </ul>
                    </div>
                    <div class="div-post-vip">
                        <ul>
                            <li>
                                <div class="div-item-vip-post">
                                    <label>Thời gian</label>
                                    <input type="text" class="inp-normal" value="30 ngày" id="vip_so_ngay"  disabled="disabled">
                                </div>
                                <div class="div-item-vip-post">
                                    <label>Loại tin</label>
                                    <input type="text" class="inp-normal" value="" id="vip_loai_tin"  disabled="disabled">
                                </div>
                                <div class="div-item-vip-post">
                                    <label>Phí đăng tin</label>
                                    <input type="text" class="inp-normal" value="" id="vip_phi_dang_tin"  disabled="disabled">
                                </div>
                            </li>
                            <li>
                                <div class="div-item-vip-post">
                                    <label>Phí Up tin<br> tự động</label>
                                    <input type="text" class="inp-normal" value="" id="vip_auto_up" disabled="disabled">
                                </div>
                                <div class="div-item-vip-post">
                                    <label>Tổng tiền</label>
                                    <input type="text" class="inp-normal"  value="" id="vip_total_price" disabled="disabled">
                                </div>
                                <div class="div-item-vip-post">
                                    <label>Mã xác nhận</label>
                                    <input type="text" class="code" placeholder="Nhập mã"   value="" id="vip_captcha">
                                    <img title="Click để đổi hình khác" class="img-cap" src="{{$src_captcha}}"/>

                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="div-bottom">
                        <p>* NHÂN DỊP RA MẮT HÌNH ẢNH MỚI VIETNAMOTO.NET MIỄN PHÍ 100% TIN ĐĂNG CỦA TẤT CẢ CÁC THỂ LOẠI ĐẾN HẾT NÀY 30/4/2017</p>
                        <input type="button" class="btn-next-free-post" id="btnNext_tab1" value="ĐĂNG BÀI"/>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $( document ).ready(function() {
        $(".img-cap").click(function () {
            $.ajax({
                url: '/changecaptcha',
                type: 'POST',
                dataType: "html",
                cache: false,
                enctype: 'multipart/form-data',
                data : {},
                success : function(data) {
                    $(".img-cap").attr("src",data);
                }
            });
        });


        $("input:radio[name=optradio]").click(function () {
            var value = $(this).val();
            if (value == "NORMAL") {
                $(".div-post-normal").fadeIn();
                $(".div-post-vip").hide();
            } else {
                generate_loaibv(value);

                $(".div-post-normal").hide();
                $(".div-post-vip").fadeIn();

            }




        });
        $( "#datepicker1" ).datepicker({ dateFormat: 'dd/mm/yy' });
        $( "#datepicker2" ).datepicker({ dateFormat: 'dd/mm/yy' });
        <?php
            if(isset($result) && !empty($result)){
                echo 'dhtmlx.alert("'.$result['mess'].'")';
            }
        ?>

    });

    $("#fmbaiviet").submit(function( event ) {
        var cando = true;
        var photo = false;
        $( ".fm_required" ).each(function( index ) {
            var name = $(this).attr("name");
            var type = $(this).attr("type");

            var vl =$(this).val();
            //var vl = $("*[name='"+name+"']").val();
            console.log(index+":"+name+":"+type+":"+vl);
            if(vl == null ||vl=="undefined" || vl==""){
//                console.log("empty:"+$(this).attr("name"));
                if(name.startsWith("photo")){
                    photo = true;
                }
                cando = false;
            }
        });
        if(!cando){
            event.preventDefault();
            if(photo){
                dhtmlx.alert("<strong>Vui lòng upload đủ 5 hình ảnh</strong>");
            }else{
                dhtmlx.alert("<strong>Vui lòng điền đầy đủ thông tin bắt buộc</strong>");
            }

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
    $("select[name='thongso_20']").change(function() {
        var vl = $("select[name='thongso_20']").val();
//        dhtmlx.alert(vl);
        if(vl!=''){
            $.ajax({
                url: '/getdongxe',
                type: 'POST',
                dataType: "json",
                cache: false,
                enctype: 'multipart/form-data',
                data : {id:vl},
                success : function(data) {
                    if(data.result){
//                        console.log(data.data);
                            generate_dongxe('thongso_75',data.data);

                    }else{
                        dhtmlx.alert(data.mess);
                    }
                }
            });
        }else{
            dhtmlx.alert("Vui lòng chọn thương hiệu xe trước!");
        }

    });
    function generate_dongxe(selectName,data){
        var sl = $("select[name='"+selectName+"']");
        //var obj = jQuery.parseJSON(data);
        sl.html('<option value="">Click chọn</option>');
        $.each(data, function(key,value) {
//            console.log(key+":"+value);

            sl.append('<option value="'+key+'">'+value+'</option>');
        });
    }
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
    function generate_loaibv(typeID){
        $.ajax({
            url: '/getloaibaiviet',
            type: 'POST',
            dataType: "json",
            cache: false,
            enctype: 'multipart/form-data',
            data : {id:typeID},
            success : function(data) {
                if(data.result){
                    dt = data.data;
                    calculate_prices();
                }else{
                    dhtmlx.alert(data.mess);
                }
            }
        });
    }
    var dt;
    function calculate_prices(){

        if(dt != null){
            $("#vip_loai_tin").val(dt.ten_loai_tin);

            var from = $("#datepicker1").val().split("/");
            var to = $("#datepicker2").val().split("/");

            var date1 = new Date(from[2], from[1] - 1, from[0]);
            var date2 = new Date(to[2], to[1] - 1, to[0]);
            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
            $("#vip_so_ngay").val(diffDays+" ngày");
            var months =0;
            var days = 0;
            var weeks = 0;
            if(diffDays>0){
                months = parseInt(diffDays/30);
                weeks = parseInt((diffDays - 30*months)/7);
                days = diffDays - 30*months - 7*weeks;
                var vip_phidt =0;
                var vip_price_unit = dt.price_unit;
                if(months>0) vip_phidt +=dt.price_month*months;
                if(weeks>0) vip_phidt +=dt.price_week*weeks;
                if(days>0) vip_phidt +=dt.price_day*days;
                var vip_total = vip_phidt;
                $("#vip_phi_dang_tin").val(vip_phidt +"  "+vip_price_unit);


                var autoUp = $('input:radio[name=optradio1]:checked', '#fmbaiviet').val();
                var numUp = 0;
                if(autoUp==1){
                    numUp = Math.round(diffDays/7);
                    vip_total += dt.price_day*numUp ;
                }
                if(numUp>0){
                    $("#vip_auto_up").val(dt.price_day+"/lần x "+numUp+"lần");
                }else{
                    $("#vip_auto_up").val("None");
                }

                $("#vip_total_price").val(vip_total+"  "+vip_price_unit);
            }else{
                dhtmlx.alert("Bạn phải đăng tin ít nhất 1 ngày");
            }



        }else{
            generate_loaibv($('input:radio[name=optradio]:checked', '#fmbaiviet').val());
        }
//        dhtmlx.alert(months+":"+days);
    }
    $("input:radio[name=optradio1]").click(function () {
        calculate_prices();

    });
    $(".calendar-inp").change(function() {
        calculate_prices();

    });

</script>
@stop
