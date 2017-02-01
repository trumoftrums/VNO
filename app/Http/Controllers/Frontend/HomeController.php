<?php namespace App\Http\Controllers;

use App\Http\Controllers\Frontend;
use App\Models\Users;
use App\Models\UsersFactory;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller {

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        return View('Home.index', []);
    }

    public function users(){
        return View('Users.index', []);
    }

    public function register()
    {
        $param = Input::all();
        UsersFactory::addUser($param);
        return response()->json([
            'status' => true,
            'message' => 'success'
        ]);
    }

    public function userInfo()
    {
        return View('Users.index', []);
    }
    public function news()
    {
        return View('News.list-news', []);
    }
    public function newsDetail($id, $name)
    {
        return View('News.detail-news', []);
    }
    public function postDetail($id, $name)
    {
        return View('Post.detail-post', []);
    }
}