<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Baiviet;
use App\Models\Baivietindex;
use App\Models\Thongso;
use App\Models\Users;
use App\Models\UsersFactory;
use App\News;
use App\VipSalon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Request;

class HomeController extends Controller {

    const POST_PER_PAGE = 9;
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
        $listPost = Baiviet::where('status', 'PUBLIC')->paginate(self::POST_PER_PAGE);
        foreach ($listPost as $item){
            $item->thongso = json_decode($item->thongso,true);
        }
        $listVipSalon = VipSalon::where('status', VipSalon::STATUS_ACTIVE)
            ->limit(10)
            ->get();
//        $listPost =$listPost->toArray();
//        var_dump($listPost);exit();
        //get list filter fields
        $list_thongso = Thongso::where('filter',1)->get()->toArray();

        return View('Home.index', [
            'listPost' => $listPost,
            'listVipSalon' => $listVipSalon,
//            'list_thongso'=>$list_thongso
        ]);
    }
    public function index_post()
    {
        $listPost = array();
//        var_dump(Request::all());exit();
//        if(isset(Request::all()['searchform'])){
//
//            $formData =  Request::all()['searchform'] ;
//            $listPost = $this->search_post($formData);
//        }else{
//            $listPost = Baiviet::where('status', 'PUBLIC')->get();
//            foreach ($listPost as $item){
//                $item->thongso = json_decode($item->thongso,true);
//            }
//        }

        $listPost = Baiviet::where('status', 'PUBLIC')->paginate(self::POST_PER_PAGE);
        foreach ($listPost as $item){
            $item->thongso = json_decode($item->thongso,true);
        }


        return View('Home.index', [
            'listPost' => $listPost,
        ]);
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
        $active_tab2 = Input::get('page', '');
        $user = Auth::user();
        $listPost = Baiviet::where('userid', $user->id)->paginate(self::POST_PER_PAGE);;
        foreach ($listPost as $item){
            $item->thongso = json_decode($item->thongso,true);
        }
        $totalPost = Baiviet::where('userid', $user->id)->count();
        return View('Users.index', [
            'user' => $user,
            'listPost' => $listPost,
            'totalPost' => $totalPost,
            'activeTab' => $active_tab2
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
        $checkPhone = Users::where('id', $user->id)
            ->where('phone', $data['phone'])->first();
        if (count($checkPhone) == 0) {
            return response()->json([
                'status' => false,
                'message' => 'wrong_phone'
            ]);
        } else {
            $dataCheck = [
                'phone' => $data['phone'],
                'password' => $data['password']
            ];
            if (Auth::attempt($dataCheck)) {
                Users::where('id', $user->id)->update([
                    'password' => bcrypt($data['newpassword'])
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'change password success'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'wrong_pass'
                ]);
            }
        }
    }
    public function news()
    {
        $res = News::where('op_news.status', News::STATUS_ACTIVE)
            ->leftJoin('md_users', 'md_users.id', '=', 'op_news.userid')
            ->select('op_news.*', 'md_users.username')
            ->paginate(self::POST_PER_PAGE);
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
        $detailPost = Baiviet::where('op_baiviets.id', $id)
            ->leftJoin('md_users', 'md_users.id', '=', 'op_baiviets.userid')
            ->select('op_baiviets.*', 'md_users.username')
            ->first();
        $listPostRelated = Baiviet::where('status', 'PUBLIC')
            ->limit(5)
            ->whereNotIn('id', [$detailPost->id])
            ->get();
        foreach ($listPostRelated as $item){
            $item->thongso = json_decode($item->thongso,true);
        }
        $detailPost->thongso = json_decode($detailPost->thongso,true);
        $list_thongso = Thongso::where('filter',1)->get()->toArray();
        return View('Post.detail-post', [
            'detailPost' => $detailPost,
            'listPostRelated' => $listPostRelated,
            'list_thongso'=>$list_thongso
//            'list_thongso'=>$list_thongso
        ]);
    }

    public function uploadAvatar()
    {
        $user = Auth::user();
        if ($_FILES["userfile"]["name"] != '') {
            $k = md5($_FILES["userfile"]["name"]);
            $path = "uploads/users/";
            $path .= $k;
            move_uploaded_file($_FILES["userfile"]["tmp_name"], $path);
            Users::where('id', $user->id)->update([
                'avatar' => $path
            ]);
            return $path;
        } else {
            return 'NO_CHANGE';
        }

    }

    public function freePost()
    {
        if(Auth::check()){
            $user = Auth::user();
            return View('Post.free-post', [
                'user' => $user
            ]);
        }else{
            return redirect('/');
        }
    }
    private function search_post($searchform =array()){
        $conditions = array();
        $kw = "";
        foreach($searchform as $k => $v){
            if(!empty($v)){
                if($v!="keyword"){
                    $conditions[] = array(
                        array('index_key_str','=',$k),
                        array('index_value',"=",$v)

                    );
                }else{
                    $kw = strtolower($v);
                }


            }


        }
        $posts_idx = Baivietindex::where($conditions)->distinct('baivietID')->get()->toArray();
        $finaldata =array();
        if(!empty($posts_idx)){
            $listPost = Baiviet::where('status', 'PUBLIC')->whereIn($posts_idx)->get();
            foreach ($listPost as $item){
                $item->thongso = json_decode($item->thongso,true);
                if(!empty($kw)){
                    $tieude = $item->thongso['thongso_20']." ".$item->thongso['thongso_25']." ".$item->thongso['thongso_22'];
                    $tieude = strtolower($tieude);
                    if(strpos($tieude,$kw) !== false){
                        $finaldata[] = $item;
                    }
                }else{
                    $finaldata[] = $item;
                }
            }

        }
        return $finaldata;

    }
}