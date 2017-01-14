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
</style>
<link rel="stylesheet" type="text/css" href="../js/dhtmlx5/dhtmlx.css"/>
<link rel="stylesheet" type="text/css" href="../js/dhtmlx5/fonts/font_roboto/roboto.css"/>
<script src="../js/dhtmlx5/dhtmlx.js"></script>
@section('content')
    <div id="layoutObj" class="row  border-bottom white-bg dashboard-header"></div>
    <script>
        var myLayout;
        var myWins = new dhtmlXWindows();
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
            myToolbar.addButton("add", 0, "Thêm bài viết", "../js/dhtmlx5/common/add.png", "add.png");
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
        function add_baiviet(baiviet) {
            {{--var dbc  = "{!! Helper::test('this is how to use autoloading correctly!!') !!}";--}}
            {{--dhtmlx.alert(dbc);--}}
            var viewportWidth = $(window).width();
            var viewportHeight = $(window).height();
            var wd = 1000;
            var hg = $("#layoutObj").height()-50;
            var left = (viewportWidth / 2) - (wd / 2) ;
            var top = (viewportHeight / 2) - (hg / 2);
            var win = myWins.createWindow("w_add", left, top, wd, hg);
            win.setText("Thêm xe bán");
            win.setModal(true);
            win.button("minmax").disable();
            win.button("park").disable();
            var myTabbar = win.attachTabbar({
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
                        $tab_content = '[{type: "settings", position: "label-left"},{type: "block", offsetLeft: 10, inputWidth: 900, list: [';
                        foreach ($thongtin['ls']  as  $kk => $nhomthongso){
                            $no =1;
                            foreach ($nhomthongso['ls'] as  $thongso){
//                                var_dump(Helper::dhtmlx_form($thongso));exit();
                                if($no>1) $tab_content .=',';
                                $tab_content .=Helper::dhtmlx_form($thongso);
                                switch ($k){
                                    case 1:

                                        break;
                                    case 2:
                                        if($tab_content)
                                        $tab_content .='{type: "newcolumn"}';
                                        break;
                                    case 3:

                                        break;
                                    case 4:

                                        break;
                                    default: break;
                                }
                                $no++;
                            }
                            $tab_content .=',';

                        }
                        $tab_content .= '{type: "block", offsetLeft: 10, offsetTop: 50, name: "lst_button", width: 570, list: [{type: "button", offsetLeft: 80, value: "Save", name: "btnSave"}]}]}]';


//                        echo 'var cfgform_'.$k.' ='.$tab_content;exit();
                        $arr_cfgform[$k] = $tab_content;
                    }
                }
                foreach ($arr_cfgform as $k=> $v){
                    echo 'var cfgform_'.$k .'='.$v.';  ';
                    echo 'var wform_'.$k.' ='.'myTabbar.tabs("tab_'.$k.'").attachForm();  ';
                    echo 'wform_'.$k.'.loadStruct(cfgform_'.$k.');  ';
                }

            ?>


//            var cfgform_summary = [
//                {type: "settings", position: "label-left"},
//                {type: "block", offsetLeft: 10, inputWidth: 900, list: [
//                    {type: "input", required: true, name: "tieu_de", labelAlign: "right", label: "Title", labelWidth: 80, inputWidth: 700, value: "", tooltip: "enter title", validate: "NotEmpty"},
//                    {type: "input", inputHeight: 100, name: "mo_ta", labelAlign: "right", label: "Mô tả", labelWidth: 80, rows: 10, inputWidth: 700, value: "", tooltip: "Nhập nội dung mô tả chiếc xe"},
//                    {type: "combo",  name: "tinh_tp", labelAlign: "right", label: "Tỉnh/TP", labelWidth: 80, inputWidth: 150,
//                        options:[
//                            {text: "Hồ Chi Minh", value: "1", selected: true},
//                            {text: "Hà Nội", value: "2"},
//                            {text: "Đà Nẵng", value: "3"},
//                            {text: "Cần Thơ", value: "4"}
//                        ]
//                    },
//                    {type: "input", name: "dia_chi", labelAlign: "right", label: "Địa chỉ", labelWidth: 80, inputWidth: 700, value: "", tooltip: "nhập địa chỉ bán xe"},
//                    {type: "combo",  name: "loai_xe", labelAlign: "right", label: "Loại xe", labelWidth: 80, inputWidth: 150,
//                        options:[
//                            {text: "Camry", value: "1", selected: true},
//                            {text: "Toyota", value: "2"},
//                            {text: "Ford", value: "3"}
//                        ]
//                    }
//
//                ]},
//                {type: "block", offsetLeft: 10, inputWidth: 900, list: [
//
//
//
//                    {type: "input", required: true, name: "gia_goc", labelAlign: "right", label: "Giá gốc", labelWidth: 80, inputWidth: 150, value: "", tooltip: "nhập giá gốc", validate: "NotEmpty"},
//                    {type: "input",  required: true,name: "phone", labelAlign: "right", label: "Phone", labelWidth: 80, inputWidth: 150, value: "", tooltip: "nhập số điện thoại liên lạc"},
//
//                    {type: "input", name: "chu_xe", labelAlign: "right", label: "Tên chủ xe", labelWidth: 80, inputWidth: 150, value: "", tooltip: "nhập họ và tên chủ xe"},
//                    {type: "newcolumn"},
//                    {type: "input", required: true, name: "gia_sale", labelAlign: "right", label: "Giá đã sale", labelWidth: 100, inputWidth: 150, value: "", tooltip: "nhập giá sau khi sale", validate: "NotEmpty"},
//                    {type: "input", name: "phone2", labelAlign: "right", label: "Phone 2", labelWidth: 100, inputWidth: 150, value: "", tooltip: "nhập số điện thoại khác nếu có"},
//                    {type: "newcolumn"},
//                    {type: "input", required: true, name: "donvi", labelAlign: "right", label: "Đơn vị", labelWidth: 100, inputWidth: 150, value: "VND", tooltip: "nhập đơn vị tiền tệ", validate: "NotEmpty"}
//                ]},
//                {type: "block", offsetLeft: 10, offsetTop: 50, name: "lst_button", width: 570, list: [
//                    {type: "button", offsetLeft: 80, value: "Save", name: "btnSave"}
//                ]}
//
//            ];
//
//
//            wform.attachEvent("onButtonClick", function (name) {
//                if (name == "btnCreate") {
//                    if (wFormSummary.validate()) {
//                        var e_title = wform.getItemValue("title", true);
//                        var e_desc = wform.getItemValue("description", true);
//                        var e_lmtime = wform.getItemValue("limittime", true);
//                        var e_fr = wform.getItemValue("valid_fr", true);
//                        var e_to = wform.getItemValue("valid_to", true);
//                        var e_pass = wform.getItemValue("ppass", true);
//
//                    }
//
//                }
//            });
//            var input_valid_fr = form_add.getCalendar("valid_fr");
//            var input_valid_to = form_add.getCalendar("valid_to");
//            input_valid_fr.attachEvent("onClick", function (date) {
//
//                input_valid_to.setSensitiveRange(date, null);
//            });
//            if (baiviet != null) {
//                wform.setItemValue("title", baiviet.title);
//                wform.setItemValue("description", baiviet.desc);
//                wform.setItemValue("valid_fr", baiviet.valid_fr);
//                wform.setItemValue("valid_to", baiviet.valid_to);
//                wform.setItemValue("limittime", baiviet.limittime);
//                wform.setItemValue("ppass", baiviet.pass);
//            }

        }
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
    </script>

@endsection

