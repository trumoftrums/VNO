@extends('Layouts.backend')

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
    div.gridbox table.row20px tr  td img{
        max-height:60px !important;
    }
</style>
<link rel="stylesheet" type="text/css" href="../js/dhtmlx5/dhtmlx.css"/>
<link rel="stylesheet" type="text/css" href="../js/dhtmlx5/fonts/font_roboto/roboto.css"/>
<script src="../js/dhtmlx5/dhtmlx.js"></script>
<script src="../js/ckeditor/ckeditor.js"></script>
<script src="../js/ckeditor/samples/js/sample.js"></script>
@section('content')
    <div id="layoutObj" class="row  border-bottom white-bg dashboard-header"></div>
    <script>
        var myLayout;
        var myWins = new dhtmlXWindows();
        myWins.attachEvent("onContentLoaded", function(win){
//            console.log("onContentLoaded");
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
            myLayout.cells("a").setText("Tất cả tin tức");
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
            myToolbar.addButton("add", 0, "Đăng tin tức", "../js/dhtmlx5/common/add.png", "add.png");
            myToolbar.addButton("edit",1, "Sửa tin tức", "../js/dhtmlx5/common/edit.png", "edit.png");
            myToolbar.addButton("delete",2, "Xóa tin tức", "../js/dhtmlx5/common/delete.png", "delete.png");
            myToolbar.addButton("publish",3, "Publish", "../js/dhtmlx5/common/publish.png", "publish.png");
            myToolbar.addButton("refresh",4, "Làm mới", "../js/dhtmlx5/common/refresh.png", "refresh.png");

            myToolbar.attachEvent("onClick", function (id) {
                if (id == "add") {
                    add_baiviet(null);
                }
                if (id == "edit") {
                    if (mygrid.getSelected() != null &&  mygrid._selectionArea) {
                        dhtmlx.alert("Please select 1 row!");
                    } else {
                        var bvid =  mygrid.getSelectedRowId();
                        var token = "{{csrf_token()}}";

                        $.ajax({
                            url: '/admin/getbaivietedit',
                            dataType: "json",
                            cache: false,
                            type: 'post',
                            data: {
                                bvid: bvid
                            },
                            beforeSend: function(xhr){

                                xhr.setRequestHeader('X-CSRF-TOKEN', token);
                            },
                            success: function (data) {
                                if(data.result){
                                    add_baiviet(data.data);

                                }else{
                                    dhtmlx.alert(data.mess);
                                }
                            },
                            error: function () {
                                dhtmlx.alert("Error,Please try again!");
                            }
                        });


                    }
                }

                if(id=="delete"){
                    var selectedId = mygrid.getSelectedRowId();
                    if (selectedId == null) {
                        dhtmlx.alert("Vui lòng chọn 1 bài viết");
                    }
                     else {
                        var bvid = mygrid.getSelectedRowId();
                        dhtmlx.confirm({
                            title: "Xóa bài viết",
                            type:"confirm-warning",
                            text: "Bạn chắc chắn muốn xóa bài viết này?",
                            callback: function(ok) {
                                if(ok){
                                    delete_baiviet(bvid)
                                }

                            }
                        });
                    }

                }

                if(id=="refresh"){
                    mygrid.loadXML("getbaiviet");
                }
                if(id == "publish"){
                    var selectedId = mygrid.getSelectedRowId();
                    if (selectedId == null) {
                        dhtmlx.alert("Vui lòng chọn 1 bài viết");
                    }
                    else {
                        var bvid = mygrid.getSelectedRowId();
                        dhtmlx.confirm({
                            title: "Public bài viết",
                            type:"confirm-warning",
                            text: "Bạn chắc chắn muốn public bài viết này?",
                            callback: function(ok) {
                                if(ok){
                                    pub_baiviet(bvid);
                                }

                            }
                        });
                    }
                }


            });
            mygrid = myLayout.cells("a").attachGrid();
            mygrid.setImagePath("../js/dhtmlx5/imgs/");
            mygrid.init();
            mygrid.attachEvent("onXLE", function(grid_obj,count){
                myLayout.cells("a").progressOff();
            });
            mygrid.attachEvent("onXLS", function(grid_obj){
                myLayout.cells("a").progressOn();
            });
            mygrid.setAwaitedRowHeight(25);
            mygrid.loadXML("getnews");

        }
        var baiviet_form_tabbar;
        function add_baiviet(baiviet) {

            var baiviet_thongso;
            var viewportWidth = $(window).width();
            var viewportHeight = $(window).height();
            var wd = 1020;
            var hg = $("#layoutObj").height()-50;
            var left = (viewportWidth / 2) - (wd / 2) ;
            var top = (viewportHeight / 2) - (hg / 2);
            var win = myWins.createWindow("w_add", left, top, wd, hg);
            if(baiviet !== null && baiviet !=="undefined"){
                win.setText("Sửa tin tức ... ");


            }else{
                win.setText("Đăng tin tức ... ");
                baiviet = new Object();
            }
//            console.log(baiviet);
            win.setModal(true);
            win.button("minmax").disable();
            win.button("park").disable();


            wform = win.attachForm();
            var cfgform1 = [
                {type: "settings", position: "label-left"},
                {type: "block", offsetLeft: 10, inputWidth: 980, list: [
                    {type: "input", name: "title",required:true, label: "Tiêu đề", labelWidth: 70, inputWidth: 800},
                    {type: "input", name: "summary", required:true,label: "Tóm tắt", labelWidth: 70, rows: 5, inputWidth: 800},
                    {type: "input", id:"editor",required:true, name: "description", label: "Nội dung", rows: 12,labelWidth: 70, inputWidth: 800},
                    {type: "image", id:"photo", required:true,name: "photo",labelWidth: 70, label: "Hình đại diện",inputWidth: 150, inputHeight: 130, imageHeight: 130, url: "./tool/dhtmlxform_image", value:""}
                    ,{type: "button", offsetLeft: 70, value: "Save", name: "btnSave"}
                ]}
            ];
            wform.loadStruct(cfgform1);
            wform.attachEvent("onImageUploadSuccess", function(name, value, extra){

            });
            wform.attachEvent("onImageUploadFail", function(name, extra){
                console.log("onImageUploadFail::"+extra);
            });

            wform.attachEvent("onClick", function (id) {
                console.log("Click button"+id);
                if(id=="btnSave"){

                    if(wform.validate()){
                        var formData = wform.getFormData();
                        $.ajax({
                            url: '/admin/save_news',
                            dataType: "json",
                            cache: false,
                            type: 'post',
                            data: {
                                formData: formData
                            },
                            beforeSend: function(xhr){

                                //xhr.setRequestHeader('X-CSRF-TOKEN', token);
                            },
                            success: function (data) {
                                wform.clear();
                                dhtmlx.alert(data.mess);
                            },
                            error: function () {
                                dhtmlx.alert("Error,Please try again!");
                            }
                        });
                    }else {
                        dhtmlx.alert("Vui lòng nhập đầy đủ thông tin bắt buộc (có dấu sao màu đỏ) ");
                    }

                }
            });
            var des_id = $( "textarea[name='description']" ).attr("id");
            console.log(des_id);
            initSample(des_id);

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
                    dhtmlx.alert("Vui lòng nhập đầy đủ thông tin bắt buộc (có dấu sao màu đỏ) ");
                }


            }else{
                if(btnId=="btnSave" || btnId =="btnPublish"){
                    var formData = [];
                    var cando = true;
                    for(var i =1;i<=4;i++){
                        var form = 'wform_'+i;
                        var values = (window[form]).getFormData();
                        cando = (window[form]).validate();
                        if(!cando){
                            break;
                        }
                        formData = formData.concat(values);

                    };
                    if(cando){
                        var token = $('input[name="csrf-token"]').attr('value');
//                        console.log(token);
                        var publish = false;
                        if(btnId =="btnPublish") {
                            publish =true;
                        }
                        $.ajax({
                            url: '/admin/save_bai_viet',
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
                                        var form = 'wform_'+i;
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
        function delete_baiviet(baivietID) {
            if(baivietID != null && baivietID != "undefined"){
                $.ajax({
                    url: '/admin/delbaiviet',
                    dataType: "json",
                    cache: false,
                    type: 'post',
                    data: {
                        baivietID: baivietID
                    },
                    beforeSend: function(xhr){

//                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    },
                    success: function (data) {
                        mygrid.loadXML("getbaiviet");
                        dhtmlx.alert(data.mess);
                    },
                    error: function () {
                        dhtmlx.alert("Error,Please try again!");
                    }
                });
            }

        }
        function pub_baiviet(baivietID) {
            if(baivietID != null && baivietID != "undefined"){
                $.ajax({
                    url: '/admin/pubbaiviet',
                    dataType: "json",
                    cache: false,
                    type: 'post',
                    data: {
                        baivietID: baivietID
                    },
                    beforeSend: function(xhr){

//                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    },
                    success: function (data) {
                        mygrid.loadXML("getbaiviet");
                        dhtmlx.alert(data.mess);
                    },
                    error: function () {
                        dhtmlx.alert("Error,Please try again!");
                    }
                });
            }

        }
    </script>

@endsection

