<?php

namespace App\Http\Controllers;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\DB;

use Response;

class Op_lend_car extends Controller
{
    public function index()
    {
        $data =  DB::table('op_lend_car')->paginate(4);
        return view('op_lend_car.index', ['data' => $data]);
    }

    public function mobile()
    {
        $data =  DB::select('select * from op_lend_car');
        return view('op_lend_car.mobile', ['data' => $data]);
    }

    public function map()
    {
        $data = DB::select('select * from op_lend_car');

        return Response::json($data);
    }
}
