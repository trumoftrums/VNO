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
            <?php
                if(!empty($baiviet) && !empty($baiviet['id'])){
                    echo '<input type="hidden" name ="id" value="'.$baiviet['id'].'"  />';
                }
            ?>


        <div class="info-post">
            <ul class="ul-cover-tabs-post">
                <li id="title_tab1" class="active"><a data-toggle="tab" href="#tab1">THÔNG TIN CĂN BẢN</a></li>
                <li id="title_tab2" ><a data-toggle="tab" href="#tab2">THÔNG TIN AN TOÀN</a></li>
                <li id="title_tab3" ><a data-toggle="tab" href="#tab3">TÍNH TIỆN NGHI</a></li>
                <li id="title_tab4" ><a data-toggle="tab" href="#tab4">THÔNG TIN KỸ THUẬT</a></li>
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
                                                    $selected ="";
                                                    if(!empty($baiviet) && $k == $baiviet['thongso']['thongso_20']) $selected = ' selected="selected" ';
                                                    echo '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
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
                                                $selected ="";
                                                if(!empty($baiviet) && $k == $baiviet['thongso']['thongso_25']) $selected = ' selected="selected" ';
                                                echo '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
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
                                                $selected ="";
                                                if(!empty($baiviet) && $k == $baiviet['thongso']['thongso_24']) $selected = ' selected="selected" ';
                                                echo '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
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
                                                $selected ="";
                                                if(!empty($baiviet) && $k == $baiviet['thongso']['thongso_22']) $selected = ' selected="selected" ';
                                                echo '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
                                            }
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>KM đã đi<?php if($thongso["thongso_26"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <input value="<?php if(isset($baiviet['thongso']['thongso_26'])) echo $baiviet['thongso']['thongso_26']; ?>" type="text" class="free-post-input onlynumber <?php if($thongso["thongso_26"]['required']=="true"){echo 'fm_required';}?>" name="thongso_26">
                                </div>
                            </li>
                            <li>
                                <div class="col-md-4">
                                    <label>Màu sắc<?php if($thongso["thongso_27"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <input  value="<?php if(isset($baiviet['thongso']['thongso_27'])) echo $baiviet['thongso']['thongso_27']; ?>" type="text" class="free-post-input <?php if($thongso["thongso_27"]['required']=="true"){echo 'fm_required';}?>" name="thongso_27">
                                </div>
                                <div class="col-md-4">
                                    <label>Hệ thống nhiên liệu<?php if($thongso["thongso_31"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <select  type="select" class="free-post-input <?php if($thongso["thongso_31"]['required']=="true"){echo 'fm_required';}?>" name="thongso_31">
                                        <option value="">Click chọn</option>
                                        <?php
                                        if(isset($thongso["thongso_31"]["arr_options"]) && !empty($thongso["thongso_31"]["arr_options"])){
                                            foreach ($thongso["thongso_31"]["arr_options"] as $k=>$v){
                                                $selected ="";
                                                if(!empty($baiviet) && $k == $baiviet['thongso']['thongso_31']) $selected = ' selected="selected" ';
                                                echo '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
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
                                                $selected ="";
                                                if(!empty($baiviet) && $k == $baiviet['thongso']['thongso_32']) $selected = ' selected="selected" ';
                                                echo '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
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
                                                $selected ="";
                                                if(!empty($baiviet) && $k == $baiviet['thongso']['thongso_30']) $selected = ' selected="selected" ';
                                                echo '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
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
                                                $selected ="";
                                                if(!empty($baiviet) && $k == $baiviet['thongso']['thongso_62']) $selected = ' selected="selected" ';
                                                echo '<option value="'.$k.'"'.$selected.'>'.$v.'</option>';
                                            }
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Giá tiền<?php if($thongso["thongso_65"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <input value="<?php if(isset($baiviet['thongso']['thongso_65'])) echo $baiviet['thongso']['thongso_65']; ?>"  type="text" class="ip-price free-post-input onlynumber <?php if($thongso["thongso_65"]['required']=="true"){echo 'fm_required';}?>" name="thongso_65" placeholder="Nhập giá tiền">
                                </div>
                            </li>
                            <li>
                                <div class="col-md-4">
                                    <label>Số điện thoại<?php if($thongso["thongso_63"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <input  value="<?php if(isset($baiviet['thongso']['thongso_63'])) echo $baiviet['thongso']['thongso_63']; ?>" maxlength="11" type="text" class="free-post-input onlynumber  <?php if($thongso["thongso_63"]['required']=="true"){echo 'fm_required';}?>" name="thongso_63">
                                </div>
                                <div class="col-md-8">
                                    <label class="lb-address">Địa chỉ<?php if($thongso["thongso_68"]['required']=="true"){echo '<span style="color:red;">*</span>';}?></label>
                                    <input value="<?php if(isset($baiviet['thongso']['thongso_68'])) echo $baiviet['thongso']['thongso_68']; ?>"  type="text" class="free-post-input  <?php if($thongso["thongso_68"]['required']=="true"){echo 'fm_required';}?>" name="thongso_68">
                                </div>
                            </li>
                            <li>
                                <div class="col-md-5">
                                    <textarea value="<?php if(isset($baiviet['thongso']['thongso_67'])) echo $baiviet['thongso']['thongso_67']; ?>"  type="textarea" class="ip-descript <?php if($thongso["thongso_67"]['required']=="true"){echo 'fm_required';}?>" rows="5" name="thongso_67" id="comment" maxlength="1200" placeholder="Hãy nhập thông tin mô tả chi tiết"><?php if(isset($baiviet['thongso']['thongso_67'])) echo $baiviet['thongso']['thongso_67']; ?></textarea>
                                </div>
                                <div class="col-md-7 parent-img-upload">
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
                        <input type='hidden' value='0' name='thongso_1'>
                        <label class="checkbox-inline">*Túi khí người lái<input <?php if(isset($baiviet['thongso']['thongso_1']) && !empty($baiviet['thongso']['thongso_1'])) echo ' checked="checked"'; ?> type="checkbox"  name="thongso_1" value="1"></label>
                        <input type='hidden' value='0' name='thongso_2'>
                        <label class="checkbox-inline">*Túi khí khách phía trước<input  <?php if(isset($baiviet['thongso']['thongso_2']) && !empty($baiviet['thongso']['thongso_2'])) echo ' checked="checked"'; ?> type="checkbox" name="thongso_2" value="1"></label>
                        <input type='hidden' value='0' name='thongso_3'>
                        <label class="checkbox-inline">*Túi khí khách phía sau<input  <?php if(isset($baiviet['thongso']['thongso_3']) && !empty($baiviet['thongso']['thongso_3'])) echo ' checked="checked"'; ?> type="checkbox" name="thongso_3" value="1"></label>
                        <input type='hidden' value='0' name='thongso_4'>
                        <label class="checkbox-inline">*Túi khí hai bên ghế<input  <?php if(isset($baiviet['thongso']['thongso_4']) && !empty($baiviet['thongso']['thongso_4'])) echo ' checked="checked"'; ?> type="checkbox" name="thongso_4" value="1"></label>
                    </div>
                    <div>
                        <p class="p-thuoc-tinh-post">phanh - điều khiển</p>
                        <input type='hidden' value='0' name='thongso_5'>
                        <label class="checkbox-inline">*Chống bó cứng phanh(ABS)<input <?php if(isset($baiviet['thongso']['thongso_5']) && !empty($baiviet['thongso']['thongso_5'])) echo ' checked="checked"'; ?>  type="checkbox" name="thongso_5" value="1"></label>
                        <input type='hidden' value='0' name='thongso_9'>
                        <label class="checkbox-inline">*Phân bổ lực phanh điện tử<input <?php if(isset($baiviet['thongso']['thongso_9']) && !empty($baiviet['thongso']['thongso_9'])) echo ' checked="checked"'; ?>  type="checkbox" name="thongso_9" value="1"></label>
                        <input type='hidden' value='0' name='thongso_6'>
                        <label class="checkbox-inline">*Trợ lực phanh khẩn cấp(EBA)<input <?php if(isset($baiviet['thongso']['thongso_6']) && !empty($baiviet['thongso']['thongso_6'])) echo ' checked="checked"'; ?>  type="checkbox" name="thongso_6" value="1"></label>
                        <input type='hidden' value='0' name='thongso_7'>
                        <label class="checkbox-inline">*Điều khiển hành trình<input <?php if(isset($baiviet['thongso']['thongso_7']) && !empty($baiviet['thongso']['thongso_7'])) echo ' checked="checked"'; ?>  type="checkbox" name="thongso_7" value="1"></label>
                        <input type='hidden' value='0' name='thongso_10'>
                        <label class="checkbox-inline">*Tự động cân bằng điện tử(ESP)<input  <?php if(isset($baiviet['thongso']['thongso_10']) && !empty($baiviet['thongso']['thongso_10'])) echo ' checked="checked"'; ?> type="checkbox" name="thongso_10" value="1"></label>
                        <input type='hidden' value='0' name='thongso_11'>
                        <label class="checkbox-inline">*Hỗ trợ cảnh báo lùi<input  <?php if(isset($baiviet['thongso']['thongso_11']) && !empty($baiviet['thongso']['thongso_11'])) echo ' checked="checked"'; ?> type="checkbox" name="thongso_11"  value="1"></label>
                        <input type='hidden' value='0' name='thongso_8'>
                        <label class="checkbox-inline">*Hệ thống kiểm soát trượt<input  <?php if(isset($baiviet['thongso']['thongso_8']) && !empty($baiviet['thongso']['thongso_8'])) echo ' checked="checked"'; ?> type="checkbox" name="thongso_8" value="1"></label>
                        <input type='hidden' value='0' name='thongso_12'>
                        <label class="checkbox-inline">*Chốt cửa an toàn<input  <?php if(isset($baiviet['thongso']['thongso_12']) && !empty($baiviet['thongso']['thongso_12'])) echo ' checked="checked"'; ?> type="checkbox" name="thongso_12" value="1></label>
                    </div>
                    <div>
                        <p class="p-thuoc-tinh-post">khóa chống trộm</p>
                        <input type='hidden' value='0' name='thongso_13'>
                        <label class="checkbox-inline">*Khóa cửa tự động<input  <?php if(isset($baiviet['thongso']['thongso_13']) && !empty($baiviet['thongso']['thongso_13'])) echo ' checked="checked"'; ?> type="checkbox" name="thongso_13" value="1"></label>
                        <input type='hidden' value='0' name='thongso_15'>
                        <label class="checkbox-inline">*Khóa cửa điều khiển từ xa<input  <?php if(isset($baiviet['thongso']['thongso_15']) && !empty($baiviet['thongso']['thongso_15'])) echo ' checked="checked"'; ?> type="checkbox" name="thongso_15" value="1"></label>
                        <input type='hidden' value='0' name='thongso_14'>
                        <label class="checkbox-inline">*Khóa động cơ<input  <?php if(isset($baiviet['thongso']['thongso_14']) && !empty($baiviet['thongso']['thongso_14'])) echo ' checked="checked"'; ?> type="checkbox" name="thongso_14" value="1"></label>
                        <input type='hidden' value='0' name='thongso_16'>
                        <label class="checkbox-inline">*Hệ thống báo trộm ngoại vi<input  <?php if(isset($baiviet['thongso']['thongso_16']) && !empty($baiviet['thongso']['thongso_16'])) echo ' checked="checked"'; ?> type="checkbox" name="thongso_16" value="1"></label>
                    </div>
                    <div>
                        <p class="p-thuoc-tinh-post">các thống số khác</p>
                        <input type='hidden' value='0' name='thongso_17'>
                        <label class="checkbox-inline">*Đèn sương mù<input  <?php if(isset($baiviet['thongso']['thongso_17']) && !empty($baiviet['thongso']['thongso_17'])) echo ' checked="checked"'; ?> type="checkbox" name="thongso_17" value="1"></label>
                        <input type='hidden' value='0' name='thongso_19'>
                        <label class="checkbox-inline">*Đèn báo thắt dây an toàn<input  <?php if(isset($baiviet['thongso']['thongso_19']) && !empty($baiviet['thongso']['thongso_19'])) echo ' checked="checked"'; ?> type="checkbox" name="thongso_19" value="1"></label>
                        <input type='hidden' value='0' name='thongso_18'>
                        <label class="checkbox-inline">*Đèn phanh phụ thứ 3 lắp cao<input  <?php if(isset($baiviet['thongso']['thongso_18']) && !empty($baiviet['thongso']['thongso_18'])) echo ' checked="checked"'; ?> type="checkbox" name="thongso_18" value="1"></label>
                    </div>
                    <div>
                        <input type="button" class="btn-next-free-post" id="btnNext_tab2" value="TIẾP TỤC >>"/>
                    </div>
                </div>
                <div id="tab3" class="tab-pane fade">
                    <div>
                        <input type='hidden' value='0' name='thongso_36'>
                        <label class="checkbox-inline">*Thiết bị định vị<input  <?php if(isset($baiviet['thongso']['thongso_36']) && !empty($baiviet['thongso']['thongso_36'])) echo ' checked="checked"'; ?> type="checkbox"  name="thongso_36"  value="1"></label>
                        <input type='hidden' value='0' name='thongso_38'>
                        <label class="checkbox-inline">*Thiết bị giải trí<input  <?php if(isset($baiviet['thongso']['thongso_38']) && !empty($baiviet['thongso']['thongso_38'])) echo ' checked="checked"'; ?> type="checkbox"  name="thongso_38" value="1"></label>
                        <input type='hidden' value='0' name='thongso_37'>
                        <label class="checkbox-inline">*Kính chính diện<input  <?php if(isset($baiviet['thongso']['thongso_37']) && !empty($baiviet['thongso']['thongso_37'])) echo ' checked="checked"'; ?> type="checkbox"  name="thongso_37"  value="1"></label>
                        <input type='hidden' value='0' name='thongso_39'>
                        <label class="checkbox-inline">*Điều hòa sau<input  <?php if(isset($baiviet['thongso']['thongso_39']) && !empty($baiviet['thongso']['thongso_39'])) echo ' checked="checked"'; ?> type="checkbox"  name="thongso_39" value="1"></label>
                        <input type='hidden' value='0' name='thongso_45'>
                        <label class="checkbox-inline">*Điều hòa trước<input  <?php if(isset($baiviet['thongso']['thongso_45']) && !empty($baiviet['thongso']['thongso_45'])) echo ' checked="checked"'; ?> type="checkbox"  name="thongso_45" value="1"></label>
                        <input type='hidden' value='0' name='thongso_46'>
                        <label class="checkbox-inline">*Hỗ trợ xe tự động<input  <?php if(isset($baiviet['thongso']['thongso_46']) && !empty($baiviet['thongso']['thongso_46'])) echo ' checked="checked"'; ?> type="checkbox"  name="thongso_46"  value="1"></label><br>
                        <input type='hidden' value='0' name='thongso_40'>
                        <label class="checkbox-inline">*Sấy kính sau<input  <?php if(isset($baiviet['thongso']['thongso_40']) && !empty($baiviet['thongso']['thongso_40'])) echo ' checked="checked"'; ?> type="checkbox"  name="thongso_40" value="1"></label>
                        <input type='hidden' value='0' name='thongso_41'>
                        <label class="checkbox-inline">*Kính màu<input  <?php if(isset($baiviet['thongso']['thongso_41']) && !empty($baiviet['thongso']['thongso_41'])) echo ' checked="checked"'; ?> type="checkbox"  name="thongso_41" value="1"></label>
                        <input type='hidden' value='0' name='thongso_43'>
                        <label class="checkbox-inline">*Cửa sổ nóc<input  <?php if(isset($baiviet['thongso']['thongso_43']) && !empty($baiviet['thongso']['thongso_43'])) echo ' checked="checked"'; ?> type="checkbox"  name="thongso_43" value="1"></label>
                        <input type='hidden' value='0' name='thongso_44'>
                        <label class="checkbox-inline">*Tay lái trợ lực<input  <?php if(isset($baiviet['thongso']['thongso_44']) && !empty($baiviet['thongso']['thongso_44'])) echo ' checked="checked"'; ?> type="checkbox"  name="thongso_44" value="1"></label>
                        <input type='hidden' value='0' name='thongso_47'>
                        <label class="checkbox-inline">*Quạt kính sau<input  <?php if(isset($baiviet['thongso']['thongso_47']) && !empty($baiviet['thongso']['thongso_47'])) echo ' checked="checked"'; ?> type="checkbox"  name="thongso_47" value="1"></label>
                        <input type='hidden' value='0' name='thongso_48'>
                        <label class="checkbox-inline">*Màn hình LCD<input  <?php if(isset($baiviet['thongso']['thongso_48']) && !empty($baiviet['thongso']['thongso_48'])) echo ' checked="checked"'; ?> type="checkbox"  name="thongso_48" value="1"></label>
                    </div>
                    <div>
                        <p class="p-descript">MÔ TẢ THÊM</p>
                        <textarea class="ip-descript"  rows="5" id="comment" value="<?php if(isset($baiviet['thongso']['thongso_67'])) echo $baiviet['thongso']['thongso_67']; ?>"  name="thongso_49" placeholder="Hãy nhập thông tin mô tả chi tiết"><?php if(isset($baiviet['thongso']['thongso_49'])) echo $baiviet['thongso']['thongso_49']; ?></textarea>
                    </div>
                    <div>
                        <input type="button" class="btn-next-free-post" id="btnNext_tab3" value="TIẾP TỤC >>"/>
                    </div>
                </div>
                <div id="tab4" class="tab-pane fade">
                    <div>
                        <p class="p-thuoc-tinh-post">kích thước/ Trọng lượng</p>
                        <label class="checkbox-inline"><span>*Chiều dài:</span> <input  value="<?php if(isset($baiviet['thongso']['thongso_50'])) echo $baiviet['thongso']['thongso_50']; ?>" type="text"  name="thongso_50" class="free-post-input onlynumber"></label>
                        <label class="checkbox-inline"><span>*Chiều rộng:</span> <input  value="<?php if(isset($baiviet['thongso']['thongso_51'])) echo $baiviet['thongso']['thongso_51']; ?>" type="text"  name="thongso_51" class="free-post-input onlynumber"></label>
                        <label class="checkbox-inline"><span>*Chiều cao:</span> <input  value="<?php if(isset($baiviet['thongso']['thongso_52'])) echo $baiviet['thongso']['thongso_52']; ?>" type="text"  name="thongso_52" class="free-post-input onlynumber"></label>
                        <label class="checkbox-inline"><span>*Trọng lượng không tải:</span> <?php if($thongso["thongso_53"]['required']=="true"){echo '<span style="color:red;">*</span>';}?><input  value="<?php if(isset($baiviet['thongso']['thongso_53'])) echo $baiviet['thongso']['thongso_53']; ?>" type="text"  name="thongso_53" class="free-post-input onlynumber <?php if($thongso["thongso_53"]['required']=="true"){echo 'fm_required';}?>"></label>
                        <label class="checkbox-inline"><span>*Dung tích nhiên liệu:</span> <?php if($thongso["thongso_54"]['required']=="true"){echo '<span style="color:red;">*</span>';}?><input  value="<?php if(isset($baiviet['thongso']['thongso_54'])) echo $baiviet['thongso']['thongso_54']; ?>" type="text"  name="thongso_54" class="free-post-input onlynumber <?php if($thongso["thongso_54"]['required']=="true"){echo 'fm_required';}?>"></label>
                    </div>
                    <div>
                        <p class="p-thuoc-tinh-post">động cơ</p>
                        <label class="checkbox-inline"><span>*Động cơ:</span> <?php if($thongso["thongso_66"]['required']=="true"){echo '<span style="color:red;">*</span>';}?><input  value="<?php if(isset($baiviet['thongso']['thongso_66'])) echo $baiviet['thongso']['thongso_66']; ?>" type="text"  name="thongso_66"  class="free-post-input <?php if($thongso["thongso_66"]['required']=="true"){echo 'fm_required';}?>"></label>
                        <label class="checkbox-inline"><span>*Kiểu động cơ:</span> <?php if($thongso["thongso_55"]['required']=="true"){echo '<span style="color:red;">*</span>';}?><input  value="<?php if(isset($baiviet['thongso']['thongso_55'])) echo $baiviet['thongso']['thongso_55']; ?>" type="text"  name="thongso_55"  class="free-post-input <?php if($thongso["thongso_55"]['required']=="true"){echo 'fm_required';}?>"></label>
                        <label class="checkbox-inline"><span>*Dung tích xilanh:</span> <?php if($thongso["thongso_56"]['required']=="true"){echo '<span style="color:red;">*</span>';}?><input  value="<?php if(isset($baiviet['thongso']['thongso_56'])) echo $baiviet['thongso']['thongso_56']; ?>" type="text" name="thongso_56"  class="free-post-input onlynumber <?php if($thongso["thongso_56"]['required']=="true"){echo 'fm_required';}?>"></label>
                    </div>
                    <div>
                        <p class="p-thuoc-tinh-post">phanh giảm sóc-lốp</p>
                        <label class="checkbox-inline"><span>*Phanh:</span> <?php if($thongso["thongso_57"]['required']=="true"){echo '<span style="color:red;">*</span>';}?><input  value="<?php if(isset($baiviet['thongso']['thongso_57'])) echo $baiviet['thongso']['thongso_57']; ?>" type="text"  name="thongso_57"  class="free-post-input <?php if($thongso["thongso_57"]['required']=="true"){echo 'fm_required';}?>"></label>
                        <label class="checkbox-inline"><span>*Giảm sóc:</span> <?php if($thongso["thongso_58"]['required']=="true"){echo '<span style="color:red;">*</span>';}?><input  value="<?php if(isset($baiviet['thongso']['thongso_58'])) echo $baiviet['thongso']['thongso_58']; ?>" type="text"  name="thongso_58" class="free-post-input <?php if($thongso["thongso_58"]['required']=="true"){echo 'fm_required';}?>"></label>
                        <label class="checkbox-inline"><span>*Lốp xe/<br> Vành mâm:</span> <?php if($thongso["thongso_59"]['required']=="true"){echo '<span style="color:red;">*</span>';}?><input  value="<?php if(isset($baiviet['thongso']['thongso_59'])) echo $baiviet['thongso']['thongso_59']; ?>" type="text"  name="thongso_59" class="free-post-input <?php if($thongso["thongso_59"]['required']=="true"){echo 'fm_required';}?>"></label>
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
        <?php
            if(isset($result) && !empty($result)){
                echo 'dhtmlx.alert("'.$result['mess'].'")';
            }
        ?>

    });
    $( ".btn-next-free-post" ).click(function() {
        var id = $(this).attr("id");
        if(id.startsWith("btnNext_")){
            var arr = id.split("_");
            var  current_tab = arr[1];
            var tabidx = current_tab.substr(current_tab.length-1,current_tab.length);
            var next_tab = current_tab.substr(0,current_tab.length-1)+parseInt(parseInt(tabidx)+1);
//            dhtmlx.alert(tabidx+":"+next_tab);
            var current_tab_tt = "title_"+current_tab;
            var next_tab_tt = "title_"+next_tab;
            $("#"+current_tab_tt).removeAttr("class");
            $("#"+next_tab_tt).attr("class","active");

            $("#"+current_tab).attr("class","tab-pane fade");
            $("#"+next_tab).attr("class","tab-pane fade in active");
        }

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
