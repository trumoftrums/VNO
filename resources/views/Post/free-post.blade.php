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
                <div id="tab1" class="tab-pane fade in active">

                </div>
                <div id="tab2" class="tab-pane fade">

                </div>
                <div id="tab3" class="tab-pane fade">

                </div>
                <div id="tab4" class="tab-pane fade">

                </div>
            </div>
        </div>
    </div>
    <script>
        $(document ).ready(function() {

            doOnLoad(null);

        });
        function doOnLoad(baiviet) {
            if(baiviet !== null && baiviet !=="undefined"){
                baiviet_thongso = baiviet.thongso;

            }else{

                baiviet = new Object();
                baiviet.photo1  ="noimage.png";
                baiviet.photo2  ="noimage.png";
                baiviet.photo3  ="noimage.png";
                baiviet.photo4  ="noimage.png";
                baiviet.photo5  ="noimage.png";
            }
            myLayout1 = new dhtmlXLayoutObject({
                parent: "tab1",
                pattern: "1C",
                offsets: {          // optional, offsets for fullscreen init
                    top:    0,     // you can specify all four sides
                    right:  0,     // or only the side where you want to have an offset
                    bottom: 0,
                    left:   0
                }
            });
            myLayout2 = new dhtmlXLayoutObject({
                parent: "tab2",
                pattern: "1C",
                offsets: {          // optional, offsets for fullscreen init
                    top:    0,     // you can specify all four sides
                    right:  0,     // or only the side where you want to have an offset
                    bottom: 0,
                    left:   0
                }
            });
            myLayout3 = new dhtmlXLayoutObject({
                parent: "tab3",
                pattern: "1C",
                offsets: {          // optional, offsets for fullscreen init
                    top:    0,     // you can specify all four sides
                    right:  0,     // or only the side where you want to have an offset
                    bottom: 0,
                    left:   0
                }
            });
            myLayout4 = new dhtmlXLayoutObject({
                parent: "tab4",
                pattern: "1C",
                offsets: {          // optional, offsets for fullscreen init
                    top:    0,     // you can specify all four sides
                    right:  0,     // or only the side where you want to have an offset
                    bottom: 0,
                    left:   0
                }
            });
            myform1 = myLayout1.cells("a").attachForm();
            myform2 = myLayout2.cells("a").attachForm();
            myform3 = myLayout3.cells("a").attachForm();
            myform4 = myLayout4.cells("a").attachForm();
            myLayout1.cells("a").hideHeader();
            myLayout2.cells("a").hideHeader();
            myLayout3.cells("a").hideHeader();
            myLayout4.cells("a").hideHeader();
            <?php
            $arr_cfgform =array();
//            var_dump($thongtinxe);exit();
            if(!empty($thongtinxe)){

                foreach ($thongtinxe as $k => $thongtin){
                    $tab_content = "[";
                    $noNhom = 1;
                    foreach ($thongtin['ls']  as  $kk => $nhomthongso){

                        if(empty($nhomthongso["hidden"])){
                            $tab_content .= '{type: "block", offsetLeft: 10, width: 980, list: [{type: "label", label: "'.$nhomthongso["nameNhom"].'"}]},';
                        }
                        $tab_content .= '{type: "block", offsetLeft: 10, width: 980, list: [';
                        $no =1;
                        foreach ($nhomthongso['ls'] as  $thongso){
//                                var_dump($nhomthongso);exit();
//                                var_dump(Helper::dhtmlx_form($thongso));exit();

                            if($no>1) $tab_content .=',';
                            $lbwidth = 120;
                            $ipwidth = 120;

                            switch ($k){
                                case 1:

                                    break;
                                case 2:

                                    //$ipwidth = 20;
                                    //$lbwidth = 220;
                                    break;
                                case 3:
                                    if($thongso['type']=="input"){
                                        $ipwidth = 710;
                                        $lbwidth = 120;
                                    }else{
                                        $ipwidth = 20;
                                        $lbwidth = 120;
                                    }

                                    break;
                                case 4:

                                    break;
                                default: break;
                            }
                            if($thongso['id']==65){
                                $ipwidth = 450;
                            }
                            if($thongso['id']==67){
                                $ipwidth = 750;
                            }
                            $tab_content .=Helper::dhtmlx_form($thongso,$lbwidth,$ipwidth);
                            switch ($k){
                                case 1:
                                    if($thongso["idNhom"]==14){
                                        $tab_content .=',{type: "newcolumn"}';
                                    }else{
                                        if($no%3==0){
                                            $tab_content .=',{type: "newcolumn"}';
                                        }
                                    }

                                    break;
                                case 2:
                                    $tab_content .=',{type: "newcolumn"}';
                                    break;
                                case 3:
                                    if($no%2==0){
                                        $tab_content .=',{type: "newcolumn"}';
                                    }
                                    break;
                                case 4:
                                    if($no%2==0){
                                        $tab_content .=',{type: "newcolumn"}';
                                    }
                                    break;
                                default: break;
                            }
                            $no++;
                        }
                        $tab_content .="]},";

                    }

                    if($k==1){

                        $tab_content .= '{type: "block", offsetLeft: 150, offsetTop: 20, name: "lst_image", width: 800, align:"right", list: [';
                        $tab_content .= '{type: "image", id:"photo1", name: "photo1", label: "",inputWidth: 150, inputHeight: 130, imageHeight: 130, url: "./admin/tool/dhtmlxform_image", value:baiviet.photo1},';
                        $tab_content .='{type: "newcolumn"},';
                        $tab_content .= '{type: "image",id:"photo2", name: "photo2", label: "", inputWidth: 150, inputHeight: 60, imageHeight: 60, url: "./admin/tool/dhtmlxform_image", value:baiviet.photo2},';
                        $tab_content .= '{type: "image", id:"photo3",name: "photo3", label: "", inputWidth: 150, inputHeight: 60, imageHeight: 60, url: "./admin/tool/dhtmlxform_image", value:baiviet.photo3},';
                        $tab_content .='{type: "newcolumn"},';
                        $tab_content .= '{type: "image", id:"photo4",name: "photo4", label: "", inputWidth: 60, inputHeight: 130,imageWidth: 60, url: "./admin/tool/dhtmlxform_image", value:baiviet.photo4},';
                        $tab_content .='{type: "newcolumn"},';
                        $tab_content .= '{type: "image",id:"photo5", name: "photo5", label: "", inputWidth: 60, inputHeight: 130,imageWidth: 60, url: "./admin/tool/dhtmlxform_image", value:baiviet.photo5}';
                        $tab_content .="]},";
                    }
                    if($k == count($thongtinxe)){
                        $tab_content .= '{type: "block", offsetRight: 10, offsetTop: 50, name: "lst_button", width: 980, list: [{type: "button", offsetLeft: 80, value: "Đăng bài",  name: "btnPublish"},{type: "hidden", name:"csrf-token", value:"'.csrf_token().'"}]}';
                    }else{
                        $tab_content .= '{type: "block",offsetRight: 10, offsetTop: 50, offsetBottom: 0, offsetRight: 0, name: "lst_button", width: 150, list: [{type: "button", offsetLeft: 80, value: "Tiếp tục >>>",name: "btnNext_'.$k.'"}]}';
                    }

                    $tab_content .=']';
                    $arr_cfgform[$k] = $tab_content;
                }
                foreach ($arr_cfgform as $k=> $v){
                    echo 'var cfgform_'.$k .'='.$v.';  ';
                    echo 'myform'.$k.'.loadStruct(cfgform_'.$k.');  ';

                    echo 'myform'.$k.'.attachEvent("onButtonClick", function(btnID){btn_form_click(btnID,myform'.$k.');});';

                }
            }
            ?>
            $(".dhxform_obj_material").removeAttr("style");
            var wtab = $("#tab1 .dhxlayout_cont .dhx_cell_cont_layout").width();
            $("#tab2 .dhxlayout_cont .dhx_cell_cont_layout").css("width",wtab);
            $("#tab3 .dhxlayout_cont .dhx_cell_cont_layout").css("width",wtab);
            $("#tab4 .dhxlayout_cont .dhx_cell_cont_layout").css("width",wtab);
        }
        function  btn_form_click(btnId,wform) {
//            dhtmlx.alert("btn_form_click::"+btnId);
            var dt = btnId.split("_");
            if(dt.length==2){
                var tabID = parseInt(dt[1]);
                if(wform.validate()){
                    // active tab +1


                }else{
                    dhtmlx.alert("Vui lòng nhập đầy đủ thông tin bắt buộc (có dấu sao màu đỏ) ");
                }


            }else{
                if(btnId =="btnPublish"){
                    var formData = [];
                    var cando = true;
                    for(var i =1;i<=4;i++){
                        var form = 'myform'+i;
                        var values = (window[form]).getFormData();
                        cando = (window[form]).validate();
                        if(!cando){
                            break;
                        }
                        formData = formData.concat(values);

                    };
                    if(cando){
                        var token = $('input[name="csrf-token"]').attr('value');
                        var publish = false;
                        $.ajax({
                            url: '/baiviet/save_bai_viet',
                            dataType: "json",
                            cache: false,
                            type: 'post',
                            data: {
                                formData: formData,
                                publish:publish
                            },
                            beforeSend: function(xhr){

                                xhr.setRequestHeader('X-CSRF-TOKEN', token);
                            },
                            success: function (data) {
                                if(data.result){
                                    for(var i =1;i<=4;i++){
                                        var form = 'myform'+i;
                                        (window[form]).clear();
                                    };
                                }
                                dhtmlx.alert(data.mess);
                            },
                            error: function () {
                                dhtmlx.alert("Error,Please try again!");
                            }
                        });
                    }else{
                        dhtmlx.alert("Vui lòng nhập đầy đủ thông tin bắt buộc (có dấu sao màu đỏ) ");
                        baiviet_form_tabbar.tabs("tab_1").setActive();
                    }

                }
            }


        }

    </script>
@stop
