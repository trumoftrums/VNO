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
                                <div class="item-cover-one">
                                    <label class="mar-right">Dòng xe</label>
                                    <select  type="select" class="free-post-input">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
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
                                    <label class="mar-right">Xuất xứ</label>
                                    <select  type="select" class="free-post-input">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
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
                                    <input type="text" class="free-post-input onlynumber <?php if($thongso["thongso_26"]['required']=="true"){echo 'fm_required';}?>" name="thongso_26">

                                </div>
                                <div class="item-cover-one">

                                    <label  class="mar-right">Màu sắc<?php if($thongso["thongso_27"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <input type="text" class="free-post-input <?php if($thongso["thongso_27"]['required']=="true"){echo 'fm_required';}?>" name="thongso_27">

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
                                    <label class="mar-right">Hộp số</label>
                                    <select  type="select" class="free-post-input">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                                <div class="item-cover-one">
                                    <label class="mar-right">Dẫn động</label>
                                    <select  type="select" class="free-post-input">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div class="item-cover-one">
                                    <label>Số ghế - cửa<?php if($thongso["thongso_30"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
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
                <div id="tab2" class="tab-pane fade">
                    <div>
                        <p class="p-thuoc-tinh-post">túi khí an toàn</p>
                        <input type='hidden' value='0' name='thongso_1'>
                        <label class="checkbox-inline">*Túi khí người lái<input type="checkbox" name="thongso_1" value="1"></label>
                        <input type='hidden' value='0' name='thongso_2'>
                        <label class="checkbox-inline">*Túi khí khách phía trước<input type="checkbox" name="thongso_2" value="1"></label>
                        <input type='hidden' value='0' name='thongso_3'>
                        <label class="checkbox-inline">*Túi khí khách phía sau<input type="checkbox" name="thongso_3" value="1"></label>
                        <input type='hidden' value='0' name='thongso_4'>
                        <label class="checkbox-inline">*Túi khí hai bên ghế<input type="checkbox" name="thongso_4" value="1"></label>
                    </div>
                    <div>
                        <p class="p-thuoc-tinh-post">phanh - điều khiển</p>
                        <input type='hidden' value='0' name='thongso_5'>
                        <label class="checkbox-inline">*Chống bó cứng phanh(ABS)<input type="checkbox" name="thongso_5" value="1"></label>
                        <input type='hidden' value='0' name='thongso_9'>
                        <label class="checkbox-inline">*Phân bổ lực phanh điện tử<input type="checkbox" name="thongso_9" value="1"></label>
                        <input type='hidden' value='0' name='thongso_6'>
                        <label class="checkbox-inline">*Trợ lực phanh khẩn cấp(EBA)<input type="checkbox" name="thongso_6" value="1"></label>
                        <input type='hidden' value='0' name='thongso_7'>
                        <label class="checkbox-inline">*Điều khiển hành trình<input type="checkbox" name="thongso_7" value="1"></label>
                        <input type='hidden' value='0' name='thongso_10'>
                        <label class="checkbox-inline">*Tự động cân bằng điện tử(ESP)<input type="checkbox" name="thongso_10" value="1"></label>
                        <input type='hidden' value='0' name='thongso_11'>
                        <label class="checkbox-inline">*Hỗ trợ cảnh báo lùi<input type="checkbox" name="thongso_11"  value="1"></label>
                        <input type='hidden' value='0' name='thongso_8'>
                        <label class="checkbox-inline">*Hệ thống kiểm soát trượt<input type="checkbox" name="thongso_8" value="1"></label>
                        <input type='hidden' value='0' name='thongso_12'>
                        <label class="checkbox-inline">*Chốt cửa an toàn<input type="checkbox" name="thongso_12" value="1></label>
                    </div>
                    <div>
                        <p class="p-thuoc-tinh-post">khóa chống trộm</p>
                        <input type='hidden' value='0' name='thongso_13'>
                        <label class="checkbox-inline">*Khóa cửa tự động<input type="checkbox" name="thongso_13" value="1"></label>
                        <input type='hidden' value='0' name='thongso_15'>
                        <label class="checkbox-inline">*Khóa cửa điều khiển từ xa<input type="checkbox" name="thongso_15" value="1"></label>
                        <input type='hidden' value='0' name='thongso_14'>
                        <label class="checkbox-inline">*Khóa động cơ<input type="checkbox" name="thongso_14" value="1"></label>
                        <input type='hidden' value='0' name='thongso_16'>
                        <label class="checkbox-inline">*Hệ thống báo trộm ngoại vi<input type="checkbox" name="thongso_16" value="1"></label>
                    </div>
                    <div>
                        <p class="p-thuoc-tinh-post">các thống số khác</p>
                        <input type='hidden' value='0' name='thongso_17'>
                        <label class="checkbox-inline">*Đèn sương mù<input type="checkbox" name="thongso_17" value="1"></label>
                        <input type='hidden' value='0' name='thongso_19'>
                        <label class="checkbox-inline">*Đèn báo thắt dây an toàn<input type="checkbox" name="thongso_19" value="1"></label>
                        <input type='hidden' value='0' name='thongso_18'>
                        <label class="checkbox-inline">*Đèn phanh phụ thứ 3 lắp cao<input type="checkbox" name="thongso_18" value="1"></label>
                    </div>
                    <div>
                        <input type="button" class="btn-next-free-post" id="btnNext_tab2" value="TIẾP TỤC >>"/>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
<script>
    $( document ).ready(function() {
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
