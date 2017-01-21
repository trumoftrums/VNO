<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
class ToolController extends Controller {

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

            var_dump($_REQUEST);exit();
            // load any default image
            $i = "uploads/car.png";

            // check if requested image exists
            $k = "uploads/".md5($_REQUEST["itemValue"]);
            if (file_exists($k)) $i = $k;

            // output image
            header("Content-Type: image/png");
            print_r(file_get_contents($i));

        }
        if (@$_REQUEST["action"] == "uploadImage") {

            $k = md5($_FILES["file"]["filename"]);

            // make sure you added security checks for $k variable here
            @unlink("uploads/".$k);

            // and here...
            move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/".$k);

            header("Content-Type: text/html; charset=utf-8");
            print_r("{state: true, itemId: '".@$_REQUEST["itemId"]."', itemValue: '".$k."'}");

        }

    }


}