<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Response;

class Op_bai_giu_xe extends Controller
{
    public function index()
    {
        $data =  DB::table('op_bai_giu_xe')->paginate(4);
        return view('op_bai_giu_xe.index', ['data' => $data]);
    }

    public function mobile()
    {
        $data =  DB::select('select * from op_bai_giu_xe');
        return view('op_bai_giu_xe.mobile', ['data' => $data]);
    }
    
    public function map()
    {
        $data = DB::select('select * from op_bai_giu_xe');

        return Response::json($data);
    }
}
