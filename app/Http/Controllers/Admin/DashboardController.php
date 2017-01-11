<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Request;
use App\Models\Baiviet;
class DashboardController extends Controller {

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        $data =  array(
            'title' =>'Admin DashBoard',
            'content' =>'This is admin dashboard page'
        );
        return view('Admin\Dashboard.index')->with($data);
    }
}