<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Response;
use App\BaiXe;
use App\City;

class Op_bai_giu_xe extends Controller
{
    public function index()
    {
        $data = DB::select('select * from op_bai_giu_xe');
        $listBaiGiuXe = BaiXe::where('status', BaiXe::STATUS_ACTIVE)
            ->OrderBy('id', 'desc')
            ->paginate(16);

        $listCity = City::getCity();



        return view('Service.list-bai-xe-map', [
            'data' => $data,
            'citySelected' => 'all',
            'listBaiGiuXe' => $listBaiGiuXe,
            'listCity' => $listCity]
        );
    }

    public function map()
    {
        $data = DB::select('select * from op_bai_giu_xe');

        return Response::json($data);
    }
}
