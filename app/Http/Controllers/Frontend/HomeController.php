<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\UsersFactory;
use App\News;
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
        $res = News::where('op_news.status', News::STATUS_ACTIVE)
            ->leftJoin('md_users', 'md_users.id', '=', 'op_news.userid')
            ->select('op_news.*', 'md_users.username')
            ->get();
        return View('News.list-news', [
            'listNews' => $res
        ]);
    }
    public function newsDetail($id, $name)
    {
        $res = News::where('op_news.id', $id)
            ->leftJoin('md_users', 'md_users.id', '=', 'op_news.userid')
            ->select('op_news.*', 'md_users.username')
            ->first();
        return View('News.detail-news', [
            'detailNews' => $res
        ]);
    }
    public function postDetail($id, $name)
    {
        return View('Post.detail-post', []);
    }
    public function freePost()
    {
        return View('Post.free-post', []);
    }
}