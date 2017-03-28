@extends('Layouts.backend')

@section('title', $info["title"])

@section('content')
<script>
    var live_site_index = "<?php echo URL::to('/'); ?>/";
    var myWins = new dhtmlXWindows();
    myWins.attachEvent("onContentLoaded", function(win){
        if(win.getId()=="w_add"){

        }
        win.progressOff();
    });
    function doOnLoad() {


        myLayout = new dhtmlXLayoutObject({
            parent: "layoutBody",
            pattern: "3J",
            offsets: {          // optional, offsets for fullscreen init
                top:    0,     // you can specify all four sides
                right:  5,     // or only the side where you want to have an offset
                bottom: 0,
                left:   3
            },
            cells: [{id: "a", text: "Avatar",width:200,height:200}, {id: "b", text: "Data"}, {id: "c",width:200, text: "Menu"}]
        });
        myLayout.setSkin("dhx_web");
        myLayout.cells("a").hideHeader();
        myToolbar = myLayout.attachToolbar();
        myToolbar.setIconsPath(live_site_index + "backend/dhtmlx5/common/icons/");
        myToolbar.setAlign("right");
        var cfg_button = [
            {id: "home", text: "Home Page", type: "button", img: "ico-home.png"},

            {type: "separator"},
            {id: "logout", text: "Logout", type: "button", img: "ico-logout.png"}

        ];
        myToolbar.loadStruct(cfg_button);

        myToolbar.attachEvent("onClick", function (id) {
            if(id=="home"){
                var win = window.open('/', '_blank');
                if (win) {
                    //Browser has allowed it to be opened
                    win.focus();
                } else {
                    //Browser has blocked it
                    dhtmlx.alert('Please allow popups for this website');
                }
            }

        });
        myFilter = myLayout.cells("c").attachAccordion({
            icons_path: live_site_index + "backend/dhtmlx5/common/icons/",
            items: [
                {id: "users", text: "Người dùng ", icon: "ico-users.png"},
                {id: "posts", text: "Bài viết ({{$tt_baiviet}})", icon: "ico-post.png"},
                {id: "news", text: "Tin tức ({{$tt_news}})", icon: "ico-news.png"},
                {id: "salon", text: "Salon({{$tt_salons}})", icon: "icon-ser01.png"},
                {id: "suaxe", text: "Sửa xe ({{$tt_suaxes}})", icon: "icon-ser02.png"},
                {id: "cuuho", text: "Cứu hộ ({{$tt_cuuhos}})", icon: "icon-ser03.png"},
                {id: "giuxe", text: "Giữ Xe ({{$tt_giuxes}})", icon: "icon-ser04.png"}


            ]
        });
        current_menu = "users";


        init_profile(myLayout.cells("a"));

        myFilter.attachEvent("onActive", function(id, state){
            current_menu = id;
            switch (current_menu){
                case 'users':
                    init_users(myFilter.cells("users"),myLayout.cells("b"));

                    break;

                case 'posts':
                    init_form_posts(myFilter.cells("posts"),myLayout.cells("b"));
                    break;
                case 'news':
                    init_form_news(myFilter.cells("news"),myLayout.cells("b"));
                    break;
                case 'salon':
                    init_salon(myFilter.cells("salon"),myLayout.cells("b"));
                    break;
            }
        });
        myLayout.cells("b").attachStatusBar({
            text: '<div style="width: 100%;"><span id="pagingArea" style="display: inline-flex"></span>&nbsp;<span id="infoArea"></span></div>',
            paging: true
        });

        init_users(myFilter.cells("users"),myLayout.cells("b"));

    }
    $(document ).ready(function() {
        doOnLoad();

    });
    function init_profile(Dhxcell){
        Dhxcell.attachURL("/admin/profile");

    }
    var formPost,formNews,formUsers ;
    function init_form_posts(Dhxcell,DhxLayoutToolbar){
        if(Dhxcell!=null){
            var childLayout = DhxLayoutToolbar.attachLayout({
                pattern: "1C",
                offsets: {          // optional, offsets for fullscreen init
                    top:    0,     // you can specify all four sides
                    right:  5,     // or only the side where you want to have an offset
                    bottom: 0,
                    left:   3
                },
                cells: [{id: "a", text: "Danh sách bài viết"}]
            });
            var formPost = Dhxcell.attachForm();
            var userToolbar = childLayout.attachToolbar();
            userToolbar.setIconsPath(live_site_index + "backend/dhtmlx5/common/icons/");

            userToolbar.setAlign("left");
            var cfg_button = [
                {id: "add", text: "Add", type: "button", img: "ico-add.png"},
                {type: "separator"},
                {id: "edit", text: "Edit", type: "button", img: "ico-edit.png"},
                {type: "separator"},
                {id: "delete", text: "Delete", type: "button", img: "ico-del.png"},
                {type: "separator"},
                {id: "reload", text: "Reload", type: "button", img: "ico-reload.png"}

            ];
            userToolbar.loadStruct(cfg_button);

            userToolbar.attachEvent("onClick", function (id) {
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
                                    var bv = data.data.id+'-'+data.data.tieu_de.replace(" ","-");
                                    add_baiviet(bv);

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

                if(id=="reload"){
                    postGetDT(formPost,childLayout.cells("a"));
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


            var cfgform = [
                {type: "settings", position: "label-left"},
                {type: "block", offsetLeft: 0, inputWidth: 190, list: [

                    {type: "calendar", name: "date_fr", enableTime: false, labelAlign: "right", showWeekNumbers: true, label: "Từ", labelWidth: 20, inputWidth: 100, dateFormat: "%Y-%m-%d", value: "<?php echo date("Y-m-d",strtotime("- 7 days")); ?>"},
                    {type: "calendar", name: "date_to", enableTime: false, labelAlign: "right", showWeekNumbers: true, label: "Đến", labelWidth: 20, inputWidth: 100, dateFormat: "%Y-%m-%d", value: "<?php echo date("Y-m-d"); ?>"},

                    {type: "button", offsetLeft: 20, value: "Apply", name: "btnApply"}

                ]}];
            formPost.loadStruct(cfgform);
            formPost.attachEvent("onButtonClick", function (name) {
                if (name == "btnApply") {
                    postGetDT(formPost,childLayout.cells("a"));
                }

            });
            postGetDT(formPost,childLayout.cells("a"));

        }

    }
    function postGetDT(formFilter, LayoutCell){
        mygrid = LayoutCell.attachGrid();
        mygrid.setImagePath(live_site_index + "backend/dhtmlx5/imgs/");
        mygrid.enablePaging(true,50,10,"pagingArea",true,"infoArea");
//        mygrid.enablePaging(true,50,3,"recinfoArea");
//        mygrid.setPagingSkin("toolbar","dhx_skyblue");
        mygrid.enableBlockSelection();
        mygrid.setPagingSkin("bricks");

        mygrid.init();
        mygrid.attachEvent("onXLE", function(grid_obj,count){
            LayoutCell.progressOff();
        });
        mygrid.attachEvent("onXLS", function(grid_obj){
            LayoutCell.progressOn();
        });
//        var h = mygrid.attachEvent("onPaging",function(){
//            this.aToolBar.setAlign("right");
//            this.detachEvent(h);
//        });
        mygrid.setAwaitedRowHeight(25);
        var date_fr = formFilter.getItemValue("date_fr", true);
        var date_to = formFilter.getItemValue("date_to", true);

        mygrid.loadXML("/admin/getbaiviet?"+"&date_fr="+date_fr+"&date_to="+date_to);
    }
    function add_baiviet(baiviet) {
        var baiviet_thongso;
        var viewportWidth = $(window).width();
        var viewportHeight = $(window).height();
        var wd = viewportWidth -100;
        var hg = viewportHeight-100;
        var left = (viewportWidth / 2) - (wd / 2) ;
        var top = (viewportHeight / 2) - (hg / 2);
        var win = myWins.createWindow("w_add", left, top, wd, hg);
        var url = "posts/add_bai_viet";
        if(baiviet !== null && baiviet !=="undefined"){
            win.setText("Sửa bài viết ... ");
            url += "/"+baiviet;
        }else{
            win.setText("Đăng bài viết ... ");
        }

        win.setModal(true);
        win.button("minmax").disable();
        win.button("park").disable();
        win.attachURL(url);


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
                    postGetDT(myLayout.cells("b"));
                    dhtmlx.alert(data.mess);
                },
                error: function () {
                    dhtmlx.alert("Error,Please try again!");
                }
            });
        }

    }
    function init_form_news(Dhxcell,DhxLayoutToolbar){
        if(Dhxcell!=null){
            var childLayout = DhxLayoutToolbar.attachLayout({
                pattern: "1C",
                offsets: {          // optional, offsets for fullscreen init
                    top:    0,     // you can specify all four sides
                    right:  5,     // or only the side where you want to have an offset
                    bottom: 0,
                    left:   3
                },
                cells: [{id: "a", text: "Danh sách tin tức"}]
            });
            var formPost = Dhxcell.attachForm();
            var userToolbar = childLayout.attachToolbar();
            userToolbar.setIconsPath(live_site_index + "backend/dhtmlx5/common/icons/");

            userToolbar.setAlign("left");
            var cfg_button = [
                {id: "add", text: "Add", type: "button", img: "ico-add.png"},
                {type: "separator"},
                {id: "edit", text: "Edit", type: "button", img: "ico-edit.png"},
                {type: "separator"},
                {id: "delete", text: "Delete", type: "button", img: "ico-del.png"},
                {type: "separator"},
                {id: "reload", text: "Reload", type: "button", img: "ico-reload.png"}

            ];
            userToolbar.loadStruct(cfg_button);

            userToolbar.attachEvent("onClick", function (id) {
                if (id == "add") {
                    add_news(null);
                }
                if (id == "edit") {
                    if (mygrid.getSelected() != null &&  mygrid._selectionArea) {
                        dhtmlx.alert("Please select 1 row!");
                    } else {
                        var bvid =  mygrid.getSelectedRowId();
                        var token = "{{csrf_token()}}";

                        $.ajax({
                            url: '/admin/getnewsedit',
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
                                    add_news(data.data);

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
                        dhtmlx.alert("Vui lòng chọn 1 tin tức");
                    }
                    else {
                        var bvid = mygrid.getSelectedRowId();
                        dhtmlx.confirm({
                            title: "Xóa tin",
                            type:"confirm-warning",
                            text: "Bạn chắc chắn muốn xóa tin này?",
                            callback: function(ok) {
                                if(ok){
                                    delete_news(bvid)
                                }

                            }
                        });
                    }

                }

                if(id=="reload"){
                    newsGetDT(formPost,childLayout.cells("a"));
                }

            });
            var cfgform = [
                {type: "settings", position: "label-left"},
                {type: "block", offsetLeft: 0, inputWidth: 190, list: [

                    {type: "calendar", name: "date_fr", enableTime: false, labelAlign: "right", showWeekNumbers: true, label: "Từ", labelWidth: 20, inputWidth: 100, dateFormat: "%Y-%m-%d", value: "<?php echo date("Y-m-d",strtotime("- 7 days")); ?>"},
                    {type: "calendar", name: "date_to", enableTime: false, labelAlign: "right", showWeekNumbers: true, label: "Đến", labelWidth: 20, inputWidth: 100, dateFormat: "%Y-%m-%d", value: "<?php echo date("Y-m-d"); ?>"},

                    {type: "button", offsetLeft: 20, value: "Apply", name: "btnApply"}

                ]}];
            formPost.loadStruct(cfgform);
            formPost.attachEvent("onButtonClick", function (name) {
                if (name == "btnApply") {
                    newsGetDT(formPost,childLayout.cells("a"));
                }

            });
            newsGetDT(formPost,childLayout.cells("a"));

        }

    }
    function newsGetDT(formFilter, LayoutCell){
        mygrid = LayoutCell.attachGrid();
        mygrid.setImagePath(live_site_index + "backend/dhtmlx5/imgs/");
        mygrid.enablePaging(true,50,10,"pagingArea",true,"infoArea");
//        mygrid.enablePaging(true,50,3,"recinfoArea");
//        mygrid.setPagingSkin("toolbar","dhx_skyblue");
        mygrid.enableBlockSelection();
        mygrid.setPagingSkin("bricks");

        mygrid.init();
        mygrid.attachEvent("onXLE", function(grid_obj,count){
            LayoutCell.progressOff();
        });
        mygrid.attachEvent("onXLS", function(grid_obj){
            LayoutCell.progressOn();
        });
//        var h = mygrid.attachEvent("onPaging",function(){
//            this.aToolBar.setAlign("right");
//            this.detachEvent(h);
//        });
        mygrid.setAwaitedRowHeight(25);
        var date_fr = formFilter.getItemValue("date_fr", true);
        var date_to = formFilter.getItemValue("date_to", true);

        mygrid.loadXML("/admin/getnews?"+"&date_fr="+date_fr+"&date_to="+date_to);
    }

    function add_news(baiviet) {

        var viewportWidth = $(window).width();
        var viewportHeight = $(window).height();
        var wd = 1050;
        var hg = viewportHeight - 100;
        var left = (viewportWidth / 2) - (wd / 2) ;
        var top = (viewportHeight / 2) - (hg / 2);
        var win = myWins.createWindow("w_add", left, top, wd, hg);
        var itemid = null;
        if(baiviet !== null && baiviet !=="undefined"){
            itemid = {type: "hidden", name:"id", value:baiviet.id};
            win.setText("Sửa tin tức ... ");
        }else{
            win.setText("Đăng tin tức ... ");
            baiviet = new Object();
            baiviet.title = "";
            baiviet.summary = "";
            baiviet.description = "";
            baiviet.thumnail = "";
            baiviet.status = "";
        }
//            console.log(baiviet);
        win.setModal(true);
        win.button("minmax").disable();
        win.button("park").disable();


        wform = win.attachForm();
        var cfgform1 = [
            {type: "settings", position: "label-left"},
            {type: "block", offsetLeft: 10, inputWidth: 980, list: [
                {type: "input", name: "title",required:true, label: "Tiêu đề", labelWidth: 70, inputWidth: 800, value:baiviet.title},
                {type: "input", name: "summary", required:true,label: "Tóm tắt", labelWidth: 70, rows: 5, inputWidth: 800, value:baiviet.summary},
                {type: "input", id:"editor",name: "description", label: "Nội dung", rows: 12,labelWidth: 70, inputWidth: 800}

            ]},
            {type: "block", offsetLeft: 10, inputWidth: 980, list: [
                {type: "image", id:"photo", required:true,name: "photo",labelWidth: 70, label: "Hình đại diện",inputWidth: 221, inputHeight: 65, imageHeight: 65, url: "./tool/dhtmlxform_image", value:baiviet.img},
                {type: "newcolumn"},
                {type: "image", id:"thumbnail", required:true, offsetLeft:100 , name: "thumbnail",labelWidth: 80, label: "Thumbnail",inputWidth: 100, inputHeight: 65, imageHeight: 65, url: "./tool/dhtmlxform_image", value:baiviet.thumbnail}
            ]},
            {type: "block", offsetLeft: 10, inputWidth: 980, list: [
                {type: "button", offsetLeft: 70, value: "Save", name: "btnSave"}
            ]}
        ];
        wform.loadStruct(cfgform1);
        if(itemid != null){
            wform.addItem(null,itemid,0,0);
        }

        wform.attachEvent("onImageUploadSuccess", function(name, value, extra){

        });
        wform.attachEvent("onImageUploadFail", function(name, extra){
            console.log("onImageUploadFail::"+extra);
        });
//            console.log("OK");
        wform.attachEvent("onButtonClick", function (id) {
            console.log("Click button"+id);
            if(id=="btnSave"){

                if(wform.validate()){
                    var formData = wform.getFormData();
                    var description = CKEDITOR.instances[des_id].getData();
                    formData.description = description;
                    //console.log(formData);
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
                            CKupdate();
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
        des_id = $( "textarea[name='description']" ).attr("id");
        console.log(des_id);
        initSample(des_id);
        CKEDITOR.instances[des_id].setData(baiviet.description);

    }
    function CKupdate(){
        for ( instance in CKEDITOR.instances ){
            CKEDITOR.instances[des_id].updateElement();
            CKEDITOR.instances[des_id].setData('');
        }
    }
    var can_change_selected = true;
    var current_row_id =0;
    var baiviet_form_tabbar;
    function delete_news(baivietID) {
        if(baivietID != null && baivietID != "undefined"){
            $.ajax({
                url: '/admin/delnews',
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
                    newsGetDT(myLayout.cells("b"));
                    dhtmlx.alert(data.mess);
                },
                error: function () {
                    dhtmlx.alert("Error,Please try again!");
                }
            });
        }

    }

    function init_users(formFilter, LayoutCell) {
        var userLayout = LayoutCell.attachLayout({
            pattern: "2U",
            offsets: {          // optional, offsets for fullscreen init
                top:    0,     // you can specify all four sides
                right:  5,     // or only the side where you want to have an offset
                bottom: 0,
                left:   3
            },
            cells: [{id: "a", text: "Danh sách user"}, {id: "b",width: 510, text: "Thông tin chi tiết"}]
        });
        var userToolbar = userLayout.attachToolbar();
        userToolbar.setIconsPath(live_site_index + "backend/dhtmlx5/common/icons/");
        userToolbar.setAlign("left");
        var cfg_button = [
            {id: "add", text: "Add", type: "button", img: "ico-add.png"},
            {type: "separator"},
            {id: "edit", text: "Edit", type: "button", img: "ico-edit.png"},
            {type: "separator"},
            {id: "delete", text: "Delete", type: "button", img: "ico-del.png"},
            {type: "separator"},
            {id: "reload", text: "Reload", type: "button", img: "ico-reload.png"}

        ];
        userToolbar.loadStruct(cfg_button);

        userToolbar.attachEvent("onClick", function (id) {
            dhtmlx.alert("Sorry, This function is not available!");
//            if (id == "add") {
//
//            }
//
//
//            if(id=="reload"){
//                usermygrid.loadXML("/admin/getusers");
//            }


        });
        var usermygrid = userLayout.cells("a").attachGrid();
        usermygrid.setImagePath("../js/dhtmlx5/imgs/");
        usermygrid.init();
        usermygrid.attachEvent("onXLE", function(grid_obj,count){
            userLayout.cells("a").progressOff();
        });
        usermygrid.attachEvent("onXLS", function(grid_obj){
            userLayout.cells("a").progressOn();
        });
        usermygrid.attachEvent("onRowSelect", function(id,ind){
            // your code here
            if(can_change_selected && current_row_id != id){
//                    dhtmlx.alert(id+":"+ind);
                current_row_id = id;
                userLayout.cells("b").progressOn();
                $.ajax({
                    url: '/admin/getuserinfo',
                    dataType: "json",
                    cache: false,
                    type: 'post',
                    data: {
                        id: id
                    },
                    beforeSend: function(xhr){

//                            xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    },
                    success: function (data) {
                        userLayout.cells("b").progressOff();
                        if(data.result){
                            add_user(data.data,userLayout.cells("b"));


                        }else{
                            dhtmlx.alert(data.mess);
                        }
                    },
                    error: function () {
                        dhtmlx.alert("Error,Please try again!");
                        userLayout.cells("b").progressOff();
                    }
                });
            }else{
                return false;
            }

        });

        usermygrid.setAwaitedRowHeight(25);
        usermygrid.loadXML("/admin/getusers");

    }
    function add_user(user,Dhxcell) {



        var wform = Dhxcell.attachForm();
        var cfgform1 = [
            {type: "settings", position: "label-left"},
            {type: "block", offsetLeft: 10, inputWidth: 480, list: [
                {type: "image", id:"photo", required:true,name: "photo",labelWidth: 80, label: "Avatar",inputWidth: 150, inputHeight: 150, imageHeight: 150, url: "./tool/dhtmlxform_photo_user", value:user.avatar},
                {type: "input", name: "username",required:true, label: "Username", labelWidth: 80, inputWidth: 150, value:user.username},
                {type: "input", name: "phone", required:true,label: "Phone", labelWidth: 80, inputWidth: 150, value:user.phone},
                {type: "input", id:"email",name: "email", label: "Email", labelWidth: 80, inputWidth: 350, value: user.email},
                {type: "input", id:"address",name: "address", label: "Address", labelWidth: 80, inputWidth: 350, value: user.address},

                {type: "combo",labelWidth: 80,  label: "Group", name: "group",inputWidth: 100,  options:[

                    <?php
                    if(!empty($groups)){
                        $i =1;
                        foreach ($groups as $g){
                            $seletec = "";
                            echo '{value: "'.$g['id'].'" , text: "'.$g['name'].'"}';
                            if($i<count($groups)) echo ',';
                            $i++;
                        }
                    }
                    ?>
                ]},
                {type:"checkbox",labelWidth: 80,  name:"status", value:"Actived", label:"Actived"}
            ]},

            {type: "block", offsetLeft: 10, inputWidth: 490, list: [
                {type: "button", offsetLeft: 80, value: "Save", name: "btnSave"},
                {type: "newcolumn"},
                {type: "button", offsetLeft: 80, value: "Cancel", name: "btnCancel"}
            ]}
        ];
        wform.loadStruct(cfgform1);
        wform.disableItem('phone');
        if(user != null && user !="undefined" && user != ''){
//                dhtmlx.alert("ok");
            wform.setItemValue('group',user.group);
//                wform.setItemValue('group',user.group);
            wform.checkItem('status');
        }else{
            wform.setItemValue('group',2);

        }


        wform.attachEvent("onImageUploadSuccess", function(name, value, extra){

        });
        wform.attachEvent("onImageUploadFail", function(name, extra){

        });
        wform.attachEvent("onButtonClick", function (id) {

            if(id=="btnSave"){

                if(wform.validate()){
                    var formData = wform.getFormData();
                    var description = CKEDITOR.instances[des_id].getData();
                    formData.description = description;
                    //console.log(formData);
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
                            CKupdate();
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

    }
    function init_salon(formFilter, LayoutCell) {
        var userLayout = LayoutCell.attachLayout({
            pattern: "2U",
            offsets: {          // optional, offsets for fullscreen init
                top:    0,     // you can specify all four sides
                right:  5,     // or only the side where you want to have an offset
                bottom: 0,
                left:   3
            },
            cells: [{id: "a", text: "Danh sách salon"}, {id: "b",width: 510, text: "Thông tin chi tiết"}]
        });
        var userToolbar = userLayout.attachToolbar();
        userToolbar.setIconsPath(live_site_index + "backend/dhtmlx5/common/icons/");
        userToolbar.setAlign("left");
        var cfg_button = [
            {id: "add", text: "Add", type: "button", img: "ico-add.png"},
            {type: "separator"},
            {id: "edit", text: "Edit", type: "button", img: "ico-edit.png"},
            {type: "separator"},
            {id: "delete", text: "Delete", type: "button", img: "ico-del.png"},
            {type: "separator"},
            {id: "reload", text: "Reload", type: "button", img: "ico-reload.png"}

        ];
        userToolbar.loadStruct(cfg_button);

        userToolbar.attachEvent("onClick", function (id) {
            dhtmlx.alert("Sorry, This function is not available!");
//            if (id == "add") {
//
//            }
//
//
//            if(id=="reload"){
//                usermygrid.loadXML("/admin/getusers");
//            }


        });
        var usermygrid = userLayout.cells("a").attachGrid();
        usermygrid.setImagePath("../js/dhtmlx5/imgs/");
        usermygrid.init();
        usermygrid.attachEvent("onXLE", function(grid_obj,count){
            userLayout.cells("a").progressOff();
        });
        usermygrid.attachEvent("onXLS", function(grid_obj){
            userLayout.cells("a").progressOn();
        });
        usermygrid.attachEvent("onRowSelect", function(id,ind){
            // your code here
            if(can_change_selected && current_row_id != id){
//                    dhtmlx.alert(id+":"+ind);
                current_row_id = id;
                userLayout.cells("b").progressOn();
                $.ajax({
                    url: '/admin/getuserinfo',
                    dataType: "json",
                    cache: false,
                    type: 'post',
                    data: {
                        id: id
                    },
                    beforeSend: function(xhr){

//                            xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    },
                    success: function (data) {
                        userLayout.cells("b").progressOff();
                        if(data.result){
                            add_user(data.data,userLayout.cells("b"));


                        }else{
                            dhtmlx.alert(data.mess);
                        }
                    },
                    error: function () {
                        dhtmlx.alert("Error,Please try again!");
                        userLayout.cells("b").progressOff();
                    }
                });
            }else{
                return false;
            }

        });

//        usermygrid.setAwaitedRowHeight(25);
//        usermygrid.loadXML("/admin/getusers");

    }

</script>

@endsection

