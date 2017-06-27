<?php

namespace App\Http\Controllers;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\DB;

use Response;

class Op_lend_car extends Controller
{
    public function index()
    {
        $data = DB::select('select * from op_lend_car');

        return view('op_lend_car.index', ['data' => $data]);
    }

    public function map()
    {
        $data = DB::select('select * from op_lend_car');

        return Response::json($data);
    }
}
