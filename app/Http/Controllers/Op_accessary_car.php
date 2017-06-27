<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Response;

class Op_accessary_car extends Controller
{
    public function index()
    {
        $data =  DB::table('op_accessary_car')->paginate(4);
        return view('op_accessary_car.index', ['data' => $data]);
    }

    public function mobile()
    {
        $data =  DB::select('select * from op_accessary_car');
        return view('op_accessary_car.mobile', ['data' => $data]);
    }
    
    public function map()
    {
        $data = DB::select('select * from op_accessary_car');

        return Response::json($data);
    }
}
