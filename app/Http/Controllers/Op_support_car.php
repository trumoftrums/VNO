<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Response;

class Op_support_car extends Controller
{
   public function index()
    {
        $data =  DB::table('op_support_car')->paginate(4);
        return view('op_support_car.index', ['data' => $data]);
    }

    public function mobile()
    {
        $data =  DB::select('select * from op_support_car');
        return view('op_support_car.mobile', ['data' => $data]);
    }
    
    public function map()
    {
        $data = DB::select('select * from op_support_car');

        return Response::json($data);
    }
}
