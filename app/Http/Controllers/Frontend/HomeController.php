<?php namespace App\Http\Controllers;

use App\Http\Controllers\Frontend;
use App\Models\Users;

class HomeController extends Controller {

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        /*$data = Users::where('id', 1)->first();
        echo $data->password;exit();*/
        return View('Home.index', []);
    }

    public function users(){
        return View('Users.index', []);
    }
}