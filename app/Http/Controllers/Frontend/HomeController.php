<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Baiviet;
use App\Models\Users;
use App\Models\UsersFactory;
use App\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller {

    public function __construct()
    {

    }
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
        $checkPhone = Users::where('phone', $param['phone'])->first();
        if (count($checkPhone) == 0) {
            UsersFactory::addUser($param);
            return response()->json([
                'status' => true,
                'message' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Số điện thoại này đã đăng ký. Xin vui lòng nhập số điện thoại khác!'
            ]);
        }
    }

    public function userInfo()
    {
        $user = Auth::user();
        $listPost = Baiviet::where('userid', $user->id)->get();
        $totalPost = Baiviet::where('userid', $user->id)->count();
        return View('Users.index', [
            'user' => $user,
            'listPost' => $listPost,
            'totalPost' => $totalPost
        ]);
    }
    public function updateUserInfo()
    {
        $data = Input::all();
        $user = Auth::user();
        Users::where('id', $user->id)->update([
            'username' => $data['username'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'major' => $data['major'],
            'hobby' => $data['hobby']
        ]);
        return response()->json([
            'status' => true,
            'message' => 'update success'
        ]);
    }

    public function changePassword()
    {
        $data = Input::all();
        $user = Auth::user();
        Users::where('id', $user->id)->update([
            'password' => bcrypt($data['newpassword'])
        ]);
        return response()->json([
            'status' => true,
            'message' => 'change password success'
        ]);
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
    public function newsDetail($id)
    {
        $res = News::where('op_news.id', $id)
            ->leftJoin('md_users', 'md_users.id', '=', 'op_news.userid')
            ->select('op_news.*', 'md_users.username')
            ->first();
        $relatedNews = News::where('status', News::STATUS_ACTIVE)
            ->limit(5)
            ->whereNotIn('id', [$res->id])
            ->get();
        return View('News.detail-news', [
            'detailNews' => $res,
            'relatedNews' => $relatedNews
        ]);
    }
    public function postDetail($id)
    {
        return View('Post.detail-post', []);
    }
    public function freePost()
    {
        return View('Post.free-post', []);
    }
}