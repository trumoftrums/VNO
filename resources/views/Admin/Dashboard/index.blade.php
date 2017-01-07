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
</style>
<link rel="stylesheet" type="text/css" href="../js/dhtmlx5/dhtmlx.css"/>
<link rel="stylesheet" type="text/css" href="../js/dhtmlx5/fonts/font_roboto/roboto.css"/>
<script src="../js/dhtmlx5/dhtmlx.js"></script>
@section('content')
    <script>
        var myLayout;
        function doOnLoad() {
            myLayout = new dhtmlXLayoutObject({
                parent: "layoutObj",
                pattern: "2U",
                offsets: {          // optional, offsets for fullscreen init
                    top:    0,     // you can specify all four sides
                    right:  5,     // or only the side where you want to have an offset
                    bottom: 0,
                    left:   3
                }
            });
//            var myToolbar = myLayout.attachToolbar({
//                skin:               "dhx_skyblue",
//                mode:               "top",
//                align:              "right",
//                text:   "some text here",
//                height: 35
//            });
//            myToolbar.setIconPath = "../js/dhtmlx5/common";
//            myToolbar.addButton("open", 0, "", "../js/dhtmlx5/common/save.png", "save.png");
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
            var h = pr.height() - $("#toolbar_top").height();
            var w = pr.width() - $("#menu-left").width();
            $("#layoutObj").css("height",h);
            $("#layoutObj").css("width",w);
        }
    </script>

@endsection

