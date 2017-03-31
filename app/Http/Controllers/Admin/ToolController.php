<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
class ToolController extends Controller {
    /**
     * ToolController constructor.
     */
    public function __construct()
    {
    }

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */

    public function index()
    {

        exit();
    }
    public function dhtmlxform_image()
    {
        if (@$_REQUEST["action"] == "loadImage") {

            // load any default image
            $i = "uploads/car.png";

            // check if requested image exists
            if(!empty($_REQUEST["itemValue"])){
                $k = "uploads/baiviet/".$_REQUEST["itemValue"];
                if (file_exists($k)) $i = $k;
            }


            // output image
            header("Content-Type: image/png");
            print_r(file_get_contents($i));

        }
        if (@$_REQUEST["action"] == "uploadImage") {

//            var_dump($_FILES);exit();
            $k = md5($_FILES["file"]["name"]);

            // make sure you added security checks for $k variable here
            $path = "uploads/baiviet/";
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $path .= $k;
            if(!file_exists($path)){
                move_uploaded_file($_FILES["file"]["tmp_name"],$path);
            }
            header("Content-Type: text/html; charset=utf-8");
            print_r("{state: true, itemId: '".@$_REQUEST["itemId"]."', itemValue: '".$k."'}");

        }


    }

    public function dhtmlxform_photo_user()
    {
        if (@$_REQUEST["action"] == "loadImage") {

            // load any default image
            $i = "uploads/car.png";

            // check if requested image exists
            if(!empty($_REQUEST["itemValue"])){
                $k = "uploads/users/".$_REQUEST["itemValue"];
                if (file_exists($k)) $i = $k;
            }


            // output image
            header("Content-Type: image/png");
            print_r(file_get_contents($i));

        }
        if (@$_REQUEST["action"] == "uploadImage") {

//            var_dump($_FILES);exit();
            $k = md5($_FILES["file"]["name"]);

            // make sure you added security checks for $k variable here
            $path = "uploads/users/";
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $path .= $k;
            if(!file_exists($path)){
                move_uploaded_file($_FILES["file"]["tmp_name"],$path);
            }
            header("Content-Type: text/html; charset=utf-8");
            print_r("{state: true, itemId: '".@$_REQUEST["itemId"]."', itemValue: '".$k."'}");

        }


    }

    public function dhtmlxform_image_user()
    {
        if (@$_REQUEST["action"] == "loadImage") {

            // load any default image
            $i = "images/noimage.png";
//            var_dump(strpos($_REQUEST["itemValue"],"/"));exit();
            // check if requested image exists
            if(!empty($_REQUEST["itemValue"])){
                $k = "uploads/users/".$_REQUEST["itemValue"];

                if(strlen($_REQUEST["itemValue"])>32){
                    $arr = explode("%2F",$_REQUEST["itemValue"]);

                    $k = $arr[count($arr)-1];
                    $k = str_replace("%2F","/",$k);
                }

                if (file_exists($k)) $i = $k;
            }



            // output image
            header("Content-Type: image/png");
            print_r(file_get_contents($i));

        }
        if (@$_REQUEST["action"] == "uploadImage") {

//            var_dump($_FILES);exit();
            $k = md5($_FILES["file"]["name"]);

            // make sure you added security checks for $k variable here
            $path = "uploads/users/";
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $path .= $k;
            if(!file_exists($path)){
                move_uploaded_file($_FILES["file"]["tmp_name"],$path);
            }
            header("Content-Type: text/html; charset=utf-8");
            print_r("{state: true, itemId: '".@$_REQUEST["itemId"]."', itemValue: '".$k."'}");

        }


    }
}