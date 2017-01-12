@extends('layouts.backend')

@section('title', $title)
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
</style>
<link rel="stylesheet" type="text/css" href="../js/dhtmlx5/dhtmlx.css"/>
<link rel="stylesheet" type="text/css" href="../js/dhtmlx5/fonts/font_roboto/roboto.css"/>
<script src="../js/dhtmlx5/dhtmlx.js"></script>
@section('content')
    <div id="layoutObj" class="row  border-bottom white-bg dashboard-header"></div>
    <script>
        var myLayout;
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

            mygrid = myLayout.cells("a").attachGrid();
            mygrid.setImagePath("../js/dhtmlx5/imgs/");
            mygrid.init();
            mygrid.loadXML("getbaiviet");
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

