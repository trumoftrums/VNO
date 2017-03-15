<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
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
        if(!Auth::check()){
            return Redirect::to("admin/login");
        }
        $user = Auth::user();
        if($user->group!=1){
            return Redirect::to("/");
        }
        $info =  array(
            'title' =>'Admin DashBoard',
        );

        $datas = array(
            'name' =>'dashboard',
            'info'=>$info
        );

        return view('Admin.Dashboard.index')->with($datas);
    }
}