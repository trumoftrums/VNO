<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use  App\RaoVat;

class AboutController extends Controller {

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        echo '<pre>';
        $data = RaoVat::where('UserId', 57)
            ->orderBy('RaovatId', 'asc')
            ->take(1)
            ->get();
        var_dump($data);exit();
        return View('About.index', $data);
    }

}