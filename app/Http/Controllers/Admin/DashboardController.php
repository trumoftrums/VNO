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
       $res = Thongtinxe::join('md_nhom_thongso', 'md_nhom_thongso.parentid', '=', 'md_thongtinxe.id')
            ->join('md_thongso', 'md_thongso.group', '=', 'md_nhom_thongso.id')
            ->select('md_thongso.*','md_nhom_thongso.name as nameNhom', 'md_nhom_thongso.id as idNhom',
                'md_thongtinxe.id as idTab', 'md_thongtinxe.name as nameTab','md_nhom_thongso.hidden')
            ->get()->toArray();

//       var_dump($res);exit();
        $info =  array(
            'title' =>'Admin DashBoard',
            'content' =>'This is admin dashboard page'
        );
//        $thongtinxe = Thongtinxe::where('status',1)->get();
//        $thongtinxe = $thongtinxe->toArray();
//        $nhomthongso = Nhomthongso::where('status',1)->get();
        $thongtinxe = array();
        foreach ($res as $v){
            $thongtinxe[$v['idTab']]['ls'][$v['idNhom']]['ls'][] = $v;
            if(!isset($thongtinxe[$v['idTab']]['nameTab'])){
                $thongtinxe[$v['idTab']]['nameTab'] = $v['nameTab'];
            }
            if(!isset($thongtinxe[$v['idTab']]['ls'][$v['idNhom']]['nameNhom'])){
                $thongtinxe[$v['idTab']]['ls'][$v['idNhom']]['nameNhom'] = $v['nameNhom'];
                $thongtinxe[$v['idTab']]['ls'][$v['idNhom']]['hidden'] = $v['hidden'];
            }
        }
//        var_dump($thongtinxe[2]);exit();
        $datas = array(
            'info' => $info,
            'thongtinxe' =>$thongtinxe
        );

        return view('Admin\Dashboard.index')->with($datas);
    }
}