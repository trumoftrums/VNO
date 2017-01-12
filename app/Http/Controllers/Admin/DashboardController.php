<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Nhomthongso;
use Request;
use App\Models\Thongtinxe;
use DB;
class DashboardController extends Controller {

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        $info =  array(
            'title' =>'Admin DashBoard',
            'content' =>'This is admin dashboard page'
        );
        $thongtinxe = Thongtinxe::where('status',1)->get();
        $thongtinxe = $thongtinxe->toArray();

        $nhomthongso = Nhomthongso::where('status',1)->get();
        foreach ($nhomthongso as $ts){
            var_dump($ts);
            var_dump($ts->relatedThongso);
        }
        exit();

        $datas = array(
            'info' => $info,
            'thongtinxe' =>$thongtinxe
        );

        return view('Admin\Dashboard.index')->with($datas);
    }
}