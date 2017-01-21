@extends('layouts.backend')

@section('title', $info["title"])
<style>
    html, body {
        width: 100%;
        height: 100%;
        margin: 0px;
        padding: 0px;
        overflow: hidden;
    }
    #layoutObj{
        width: 100%;
    }
    .dashboard-header{
        padding: 0px !important;

    }
    .dhxlayout_base_material div.dhxcelltop_toolbar{
        padding-bottom: 2px !important;
    }
    div.dhxform_control input.dhxform_textarea{
        border: 1px solid #DDDDDD !important;
    }
    .dhxform_label label{
        font-weight: normal !important;
    }
    .dhxtabbar_tab_actv .dhxtabbar_tab_text{
        background-color: #0c834a !important;
        color: #FFFFFF !important;
    }
    .dhxform_obj_material .dhxform_textarea{
        border-width: 1px 1px 1px 1px !important;
    }
</style>
<link rel="stylesheet" type="text/css" href="../js/dhtmlx5/dhtmlx.css"/>
<link rel="stylesheet" type="text/css" href="../js/dhtmlx5/fonts/font_roboto/roboto.css"/>
<script src="../js/dhtmlx5/dhtmlx.js"></script>
@section('content')
    <div id="layoutObj" class="row  border-bottom white-bg dashboard-header"></div>
    <script>
        var myLayout;
        var myWins = new dhtmlXWindows();
        myWins.attachEvent("onContentLoaded", function(win){
            console.log("onContentLoaded");
            if(win.getId()=="w_add"){

            }
        });
        function doOnLoad() {
            myLayout = new dhtmlXLayoutObject({
                parent: "layoutObj",
                pattern: "1C",
                offsets: {          // optional, offsets for fullscreen init
                    top:    0,     // you can specify all four sides
                    right:  5,     // or only the side where you want to have an offset
                    bottom: 0,
                    left:   3
                }
            });
            myLayout.cells("a").setText("Tất cả bài viết");
            var myToolbar = myLayout.attachToolbar({
                parent: "toolbar",
                mode:   "top",
                align:  "left",
                height:35,
                offsets: {          // optional, offsets for fullscreen init
                    top:    0,     // you can specify all four sides
                    right:  0,     // or only the side where you want to have an offset
                    bottom: 0,
                    left:   0
                }
            });
            myToolbar.setIconPath = "../js/dhtmlx5/common";
            myToolbar.addButton("add", 0, "Đăng bài viết", "../js/dhtmlx5/common/add.png", "add.png");
            myToolbar.addButton("edit",1, "Sửa bài viết", "../js/dhtmlx5/common/edit.png", "edit.png");
            myToolbar.addButton("delete",2, "Xóa bài viết", "../js/dhtmlx5/common/delete.png", "delete.png");

            myToolbar.attachEvent("onClick", function (id) {
                if (id == "add") {
                    add_baiviet(null);
                }
                if (id == "edit") {
                    if (mygrid._selectionArea) {
                        dhtmlx.alert("Please select 1 row!");
                    } else {

                    }
                }

            });
            mygrid = myLayout.cells("a").attachGrid();
            mygrid.setImagePath("../js/dhtmlx5/imgs/");
            mygrid.init();
            mygrid.loadXML("getbaiviet");
        }
        var baiviet_form_tabbar;
        function add_baiviet(baiviet) {
            {{--var dbc  = "{!! Helper::test('this is how to use autoloading correctly!!') !!}";--}}
            {{--dhtmlx.alert(dbc);--}}
            var viewportWidth = $(window).width();
            var viewportHeight = $(window).height();
            var wd = 1020;
            var hg = $("#layoutObj").height()-50;
            var left = (viewportWidth / 2) - (wd / 2) ;
            var top = (viewportHeight / 2) - (hg / 2);
            var win = myWins.createWindow("w_add", left, top, wd, hg);
            win.setText("Đăng bài viết ... ");
            win.setModal(true);
            win.button("minmax").disable();
            win.button("park").disable();
            baiviet_form_tabbar = win.attachTabbar({
                tabs: [
                    <?php
                        if(!empty($thongtinxe)){
                            $no = 0;
                            foreach ($thongtinxe as $k => $v){
                                $active = 'true';
                                if($no >0){
                                    echo ',';
                                    $active = 'false';
                                }
                                echo '{
                                        id:      "tab_'.$k.'",
                                        text:    "'.$v["nameTab"].'",
                                        width:   null,
                                        index:   null,
                                        active:  '.$active.',
                                        enabled: true,
                                        close:   false
                                    }';
                                $no++;
                            }
                        }

                    ?>
                ]
            });
            <?php
                $arr_cfgform =array();
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
                                $lbwidth = 150;
                                $ipwidth = 150;

                                switch ($k){
                                    case 1:

                                        break;
                                    case 2:

                                        $ipwidth = 20;
                                        $lbwidth = 220;
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
                            $tab_content .= '{type: "block", offsetLeft: 160, offsetTop: 20, name: "lst_image", width: 800, align:"right", list: [';
                            $tab_content .= '{type: "image", id:"photo1", name: "photo1", label: "",inputWidth: 150, inputHeight: 130, imageHeight: 130, url: "./tool/dhtmlxform_image" , value:"car.png"},';
                            $tab_content .='{type: "newcolumn"},';
                            $tab_content .= '{type: "image",id:"photo2", name: "photo2", label: "", inputWidth: 150, inputHeight: 60, imageHeight: 60, url: "./tool/dhtmlxform_image", value:"car.png"},';
                            $tab_content .= '{type: "image", id:"photo3",name: "photo3", label: "", inputWidth: 150, inputHeight: 60, imageHeight: 60, url: "./tool/dhtmlxform_image", value:"car.png"},';
                            $tab_content .='{type: "newcolumn"},';
                            $tab_content .= '{type: "image", id:"photo4",name: "photo4", label: "", inputWidth: 60, inputHeight: 130,imageWidth: 60, url: "./tool/dhtmlxform_image", value:"car.png"},';
                            $tab_content .='{type: "newcolumn"},';
                            $tab_content .= '{type: "image",id:"photo5", name: "photo5", label: "", inputWidth: 60, inputHeight: 130,imageWidth: 60, url: "./tool/dhtmlxform_image", value:"car.png"}';
                            $tab_content .="]},";
                        }
                        if($k == count($thongtinxe)){
                            $tab_content .= '{type: "block", offsetRight: 10, offsetTop: 50, name: "lst_button", width: 980, list: [{type: "button", offsetLeft: 80, value: "Đăng bài",  name: "btnSave"},{type: "hidden", name:"csrf-token", value:"'.csrf_token().'"}]}';
                        }else{
                            $tab_content .= '{type: "block",offsetRight: 10, offsetTop: 50, offsetBottom: 0, offsetRight: 0, name: "lst_button", width: 150, list: [{type: "button", offsetLeft: 80, value: "Tiếp tục >>>",name: "btnNext_'.$k.'"}]}';
                        }

                        $tab_content .=']';
                        $arr_cfgform[$k] = $tab_content;
                    }
                }
                foreach ($arr_cfgform as $k=> $v){
                    echo 'var cfgform_'.$k .'='.$v.';  ';
                    echo 'wform_'.$k.' ='.'baiviet_form_tabbar.tabs("tab_'.$k.'").attachForm();  ';
                    echo 'wform_'.$k.'.loadStruct(cfgform_'.$k.');  ';

                    echo 'wform_'.$k.'.attachEvent("onButtonClick", function(btnID){btn_form_click(btnID,wform_'.$k.');});';

                }

            ?>
            wform_1.attachEvent("onImageUploadSuccess", function(name, value, extra){
                console.log("onImageUploadSuccess::"+extra);
            });
            //wform_1.setItemValue("photo1", "car.png");

// fires when an image was uploaded incorrectly
            wform_1.attachEvent("onImageUploadFail", function(name, extra){
                console.log("onImageUploadFail::"+extra);
            });
            var temp = $(".dhxform_btn").parent().parent();
            temp.css("right",0);
            temp.css("bottom",0);
            temp.css("position","absolute");

        }
        var photo1,photo2,photo3,photo4,photo5;
        $(document ).ready(function() {

            adjust_size();
            doOnLoad();



        });
        $( window ).resize(function() {
            adjust_size();
        });
        function adjust_size(){
            var pr = $( window );
            var h = pr.height() - $("#toolbar_top").height()-5;
            var w = pr.width() - $("#menu-left").width();
            $("#layoutObj").css("height",h);
            $("#layoutObj").css("width",w);


        }
        function adjust_img_control() {

            photo2.css("height","60px");
            photo3.css("height","60px");
            $("img.dhxform_image_img").each(function( index ) {
                $(this).removeAttr( "style" );
                $(this).css("margin","auto");
                $(this).css("height","auto");
                $(this).css("width","auto");
                $(this).css("top","0");
                $(this).css("left","auto");
                $(this).css("bottom","auto");
                $(this).css("right","auto");
                $(this).css("max-height","100%");
                $(this).css("max-width","100%");
            });

        }
        function  btn_form_click(btnId,wform) {
//            dhtmlx.alert("btn_form_click::"+btnId);
            var dt = btnId.split("_");
            if(dt.length==2){
                var tabID = parseInt(dt[1]);
                if(wform.validate()){
                    var nextTab  = tabID+1;
                    baiviet_form_tabbar.tabs("tab_"+nextTab).setActive();
                }else{
                    dhtmlx.alert("Empty Validate!");
                }


            }else{
                if(btnId=="btnSave"){
                    var formData = [];
                    for(var i =1;i<=4;i++){
                        var form = 'wform_'+i;
                        var values = (window[form]).getFormData();
                        formData = formData.concat(values);
                    };
                    var token = $('input[name="csrf-token"]').attr('value');
                    $.ajax({
                        url: '/admin/save_bai_viet',
                        dataType: "json",
                        cache: false,
                        type: 'post',
                        data: {
                            formData: formData
                        },
                        beforeSend: function(xhr){

                            xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        },
                        success: function (data) {
                            if(data.result){
                                for(var i =1;i<=4;i++){
                                    var form = 'wform_'+i;
                                    var values = (window[form]).clearAll();
                                };
                            }
                            dhtmlx.alert(data.mess);


                        },
                        error: function () {
                            dhtmlx.alert("Error,Please try again!");
                        }
                    });
                }
            }


        }
        function  save_bai_viet() {


        }
    </script>

@endsection

