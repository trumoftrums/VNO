<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Response;

class Op_design_car extends Controller
{
    public function index()
    {
        $data = DB::select('select * from op_design_car');

        return view('op_design_car.index', ['data' => $data]);
    }

    public function map()
    {
        $data = DB::select('select * from op_design_car');

        return Response::json($data);
    }
}
