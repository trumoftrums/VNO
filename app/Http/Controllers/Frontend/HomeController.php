<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Baiviet;
use App\Models\Baivietindex;
use App\Models\Thongso;
use App\Models\Thongtinxe;
use App\Models\Users;
use App\Models\UsersFactory;
use App\News;
use App\VipSalon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Request;
use DB;
use Illuminate\Support\Facades\Redirect;
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
        $listPost = Baiviet::where('status', 'PUBLIC')
            ->OrderBy('id','desc')
            ->paginate(18);
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

        $result = array(
            'result' =>true,
            'mess' =>''
        );
        $listPost = array();
//        var_dump(Request::all());exit();
        if(isset(Request::all()['searchform'])){

            $searchform =  Request::all()['searchform'] ;
            ##################

            $have_search = false;
            $array_all_id = array();
            $i =0;
            foreach($searchform as $k => $v){
                $conditions = "";
                if(!empty($v)){
                    $have_search = true;
                    $v = trim($v);
                    switch ($k){
                        case "keyword":
                            $conditions = "(index_key_str ='tieude' or index_key_str ='thongso_67') and index_value like '%$v%' ";
                            break;
                        case "thongso_65":
                            $v0 = substr($v,0,1);
                            $v1 = substr($v,1);
                            $conditions = "index_key_str ='$k' and index_value $v0 $v1 ";
                            break;

                        default:
                            $conditions ="index_key_str ='$k' and index_value ='$v' ";
                            break;
                    }
//                    var_dump($conditions);
                    $result['searchform'][$k] = $v;
                    $posts_idx = Baivietindex::whereRaw($conditions)->distinct('baivietID')->get()->toArray();
//                    var_dump($conditions);var_dump($posts_idx);exit();
//                    $arr_idx = array();
                    $array_all_id[$i] =array();
                    foreach ($posts_idx as $vid){
                        $array_all_id[$i][] = $vid['baivietID'];
                    }

                    $i++;
                }


            }

//            var_dump($array_all_id);exit();

            $arr_idx = array();
            if(!empty($array_all_id)){

                $ttarr = count($array_all_id);
                foreach ($array_all_id[0] as $pid){
                    $can = true;
                    for($i=1;$i<$ttarr;$i++){
                        if(!in_array($pid,$array_all_id[$i])){
                            $can = false;
                            break;
                        }
                    }
                    if($can){
                        $arr_idx[] = $pid;
                    }

                }
                if(!empty($arr_idx)){
                    $listPost = Baiviet::where('status', 'PUBLIC')->whereIn('id',$arr_idx)->paginate(self::POST_PER_PAGE);
                }else{
                    $result['result'] = false;
                    $result['mess'] = "Không tìm thấy bài viết nào !";
                }
            }elseif(!$have_search){
                $listPost = Baiviet::where('status', 'PUBLIC')->paginate(self::POST_PER_PAGE);

            }



            ##################
        }else{
            $listPost = Baiviet::where('status', 'PUBLIC')->paginate(self::POST_PER_PAGE);

        }
        foreach ($listPost as $item){
            $item->thongso = json_decode($item->thongso,true);
        }
        $result['listPost'] = $listPost;

        $listVipSalon = VipSalon::where('status', VipSalon::STATUS_ACTIVE)
            ->limit(10)
            ->get();


        $result['listVipSalon'] = $listVipSalon;

        return View('Home.index', $result);
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
            ->OrderBy('op_news.id','desc')
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
            ->OrderBy('op_news.id','desc')
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
            ->OrderBy('op_baiviets.id','desc')
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
        if(!Auth::check()){
            return Redirect::to("admin/login");
        }
        $res = Thongtinxe::join('md_nhom_thongso', 'md_nhom_thongso.parentid', '=', 'md_thongtinxe.id')
            ->join('md_thongso', 'md_thongso.group', '=', 'md_nhom_thongso.id')
            ->select('md_thongso.*','md_nhom_thongso.name as nameNhom', 'md_nhom_thongso.id as idNhom',
                'md_thongtinxe.id as idTab', 'md_thongtinxe.name as nameTab','md_nhom_thongso.hidden')
            ->where('md_thongtinxe.status',1)
            ->where('md_nhom_thongso.status',1)
            ->where('md_thongso.status',1)
            ->get()->toArray();

        $info =  array(
            'title' =>'Admin DashBoard',
            'content' =>'This is admin dashboard page'
        );
        $thongtinxe = array();
        foreach ($res as $v){
            $thongtinxe[$v['idTab']]['ls'][$v['idNhom']]['ls'][] = $v;
            if(!isset($thongtinxe[$v['idTab']]['nameTab'])){
                $thongtinxe[$v['idTab']]['nameTab'] = $v['nameTab'];
            }
            if(!isset($thongtinxe[$v['idTab']]['ls'][$v['idNhom']]['nameNhom'])){
                $thongtinxe[$v['idTab']]['ls'][$v['idNhom']]['nameNhom'] = $v['nameNhom'];
                $thongtinxe[$v['idTab']]['ls'][$v['idNhom']]['hidden'] = $v['hidden'];
            }
        }
//        var_dump($thongtinxe[2]);exit();
        $user = Auth::user();

        $thongso = $this->get_thongso_init();
        $datas = array(
            'user' => $user,
            'info' => $info,
            'thongtinxe' =>$thongtinxe,
            'thongso'=>$thongso
        );
        return View('Post.free-post',$datas);
    }
    private function search_post($searchform =array()){
        $conditions = "";
        $kw = "";
        foreach($searchform as $k => $v){
            if(!empty($v)){
                if($v!="keyword"){
                    $conditions .="index_key_str ='$k' and index_value ='$v' and ";

                }else{
                    $kw = strtolower($v);
                }


            }


        }
        if(!empty($conditions)){
            $conditions = substr($conditions,0,strlen($conditions)-4);
            $posts_idx = Baivietindex::whereRaw($conditions)->distinct('baivietID')->get()->toArray();
            $arr_idx = array();
            foreach ($posts_idx as $vid){
                $arr_idx[] = $vid['baivietID'];
            }
//            var_dump($arr_idx);
//            var_dump($posts_idx);
//            exit();
            $finaldata =array();
            if(!empty($posts_idx)){
                $listPost = Baiviet::where('status', 'PUBLIC')->whereIn('id',$arr_idx)->paginate(self::POST_PER_PAGE);
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

        }
        return $finaldata;

    }
    private $THONGSO_TITLE =array(20,25,22);
    private $THONGSO_MOTA =67;
    private $NOT_ALLOW_INDEX_CHAR = array("'",'"',"`","]","[","}","{","!","~","#","^","&","*","$","+",",",".","\xE1","\xBB","\x9Bi");
    private  $ARR_PHOTO = array("photo1","photo2","photo3","photo4","photo5");
    public function save_bai_viet(){


        $result =array(
            'result'=>false,
            'mess' =>''
        );



        if (Auth::check()) {
            // The user is logged in...

            $formData =  Request::all();
//            var_dump($formData);exit();
            $tieude = "";
            $bvid = null;
            $mota = "";
            $thongso = array();
            $photo =array();

            foreach ($formData as $k=> $dt){
                $thongso[$k] = $dt;
                $arrk = explode("_",$k);
                if(count($arrk)==2){
                    if(in_array($arrk[1],$this->THONGSO_TITLE)){
                        $tieude .= $dt." ";
                    }
                    if($arrk[1]==$this->THONGSO_MOTA){
                        $mota = $dt;
                    }


                }
                if(in_array($k,$this->ARR_PHOTO)){
                    $arr = explode("/",$dt);
                    $photo[$k] = $arr[count($arr)-1];
                }
                if($k=="id"){
                    $bvid = $dt;
                }

            }

            $tieude = $formData['thongso_20']." ".$formData['thongso_25']." ".$formData['thongso_22'];
            $tieude = trim($tieude);
            if(!empty($tieude) && !empty($mota)){
                DB::beginTransaction();
                $bv = new Baiviet;
                $pub =false;
                if($pub){
                    $bv->status = "PUBLIC";
                    $bv->published = date("Y-m-d H:i:s");
                }else{
                    $bv->status = "PENDING";
                }

                $bv->tieu_de = $tieude;
                $bv->mo_ta = $mota;

                $bv->thongso = json_encode($thongso);
                foreach ($photo as $k =>$v){
                    $bv->{$k} = $v;
                }
                $r1 = true;
                if(!empty($bvid)){
//                    var_dump($bv->toArray());exit();
                    $bv->updated_by = Auth::id();
                    $r1 = Baiviet::where('id',$bvid)->update($bv->toArray());
                    $bv->id = $bvid;

                }else{
                    $bv->userid = Auth::id();
                    $r1 = $bv->save();
                }


                //get thongso need index
//            $needindexs = Thongso::select('id','name')->where('md_thongso.status',1)->where('md_thongso.need_index',1)->get()->toArray();
                if ($r1) {
                    $r2 = true;
                    $needindexs = DB::table('md_thongso')->where('md_thongso.status', 1)->where('md_thongso.need_index', 1)->pluck('id')->toArray();
                    if (!empty($needindexs)) {
                        // index title post
                        $save_index = new Baivietindex;
                        $save_index->baivietID = $bv->id;
                        $save_index->author = Auth::id();
                        $save_index->index_key = 0;
                        $save_index->index_key_str = 'tieude';
                        $save_index->index_value = $tieude;
                        $r2 = $save_index->save();

                        foreach ($thongso as $k => $v) {
                            $arrk = explode("_", $k);
                            if (count($arrk) == 2 && in_array($arrk[1], $needindexs)) {
                                $save_index = new Baivietindex;
                                $save_index->baivietID = $bv->id;
                                $save_index->author = Auth::id();
                                $save_index->index_key = $arrk[1];
                                $save_index->index_key_str = $k;
                                $save_index->index_value = $v;
                                if ($arrk[1] == $this->THONGSO_MOTA) {

                                    $save_index->index_value = $this->convert_vi_to_en($v);
                                    $save_index->index_value = $this->clean($save_index->index_value);
                                }
                                $rd = true;
                                if(!empty($bvid)){
                                    //update
                                    $rd = Baivietindex::where('baivietID',$bv->id)->where('index_key',$arrk[1])->delete();


                                }

                                if($rd){
                                    $r2 = $save_index->save();
                                }else{
                                    $r2 = false;
                                }

                                if (!$r2) {
                                    DB::rollback();
                                    break;
                                }
                            }

                        }
                    }
                }
                if ($r1 && $r2) {
                    DB::commit();
                    $result['result'] = true;
                    $result['mess'] = 'Đăng bài viết thành công!, Bài viết của bạn đang được các quản trị viên kiểm tra và xác thực...';
                } else {
                    DB::rollback();
                    $result['mess'] = 'Có lỗi xảy ra, vui lòng thử lại sau ít phút!';
                }
            }else {

                $result['mess'] ='Vui lòng nhập đầy đủ thông tin bắt buộc (có dấu sao màu đỏ)';

            }

        }else{
            $result['mess'] ='Vui lòng đăng nhập để sử dụng chức năng này ';
        }
        return Redirect::to("/dang-tin-free");

    }
    private function clean($string) {
        $string = str_replace($this->NOT_ALLOW_INDEX_CHAR, " ", $string);

        return $string;
    }
    private  function convert_vi_to_en($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $str);
        $str = preg_replace("/(đ)/", "d", $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", "A", $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", "E", $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/","I", $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", "O", $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", "U", $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", "Y", $str);
        $str = preg_replace("/(Đ)/","D", $str);
        return $str;
    }
    private function get_thongso_init(){
        $list_thongso = Thongso::where('status',1)->get()->toArray();
        //var_dump($list_thongso);exit();
        $dt =array();
        foreach ($list_thongso as $v){
            $v['arr_options'] =  array();
            if($v['type']=="combo" && !empty($v['options']) ){
                $v['arr_options'] = $this->convert_option_to_array($v['options']);
            }
            $dt["thongso_".$v['id']] = $v;
        }
        return $dt;
    }
    private  function convert_option_to_array($options){
        $options = str_replace("[{","",$options);
        $result = array();
        if(!empty($options)){
            $arr_options = explode("},{",$options);
            if(!empty($arr_options)){
                foreach ($arr_options as  $v){
                    $arr2 = explode(",",$v);

                    if(count($arr2)==2){
                        $value = "";
                        $text ="";
                        foreach ($arr2 as $v2){
                            if(strpos($v2,"value")){
                                $value = $this->get_string_between($v2,'"','"');
                            }else{
                                $text = $this->get_string_between($v2,'"','"');
                            }
                        }
                        if(!empty($value) || !empty($text)){
                           $result[$value]  =$text;
                        }
                    }



                }
            }

        }
        return $result;
    }
    private function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
}