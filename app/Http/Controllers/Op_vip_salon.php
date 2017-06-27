<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Response;

class Op_vip_salon extends Controller
{
	public function index()
    {
        $data =  DB::table('op_vip_salon')->paginate(4);
        return view('op_vip_salon.index', ['data' => $data]);
    }

    public function mobile()
    {
        $data =  DB::select('select * from op_vip_salon');
        return view('op_vip_salon.mobile', ['data' => $data]);
    }

    public function map()
    {
        $data = DB::select('select * from op_vip_salon');

        return Response::json($data);
    }
}
