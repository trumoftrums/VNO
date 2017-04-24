<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Baiviet;
use App\Models\Baivietindex;
use App\Models\Loaibaiviet;
use App\Models\Thongso;
use App\Models\Thongtinxe;
use App\Models\Users;
use App\Models\Hangxe;
use App\Models\Dongxe;
use  App\Models\Submittoken;
use App\Models\UsersFactory;
use App\News;
use App\Video;
use App\VipSalon;
use App\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Mews\Captcha\Facades\Captcha;
use Symfony\Component\Console\Input\InputInterface;
use Validator;
class HomeController extends Controller {

    const POST_PER_PAGE = 18;
    const NEWS_PER_PAGE = 10;
    public function __construct()
    {

    }
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    private $filterParams = array(
        'hangxe'=>'thongso_20',
        'dongxe'=>'thongso_75',
        'dangxe'=>'thongso_25',
        'tinhtrang'=>'thongso_24',
        'namsx'=>'thongso_22',
        'gia'=>'thongso_65',
        'tinh'=>'thongso_62',
        'keyword'=>'keyword',
    );
    private $arrayLogoBranch = [
        'Acura','BMW','Chevrolet','Daewoo','Daihatshu','Fiat','FORD','Honda','Hyundai','Isuzu',
        'Suzuki','Audi','Kia','LandRover','Lexus','Mazda','Mercedes-Benz','Mitsubishi','Nissan',
        'Peugeot','Porsche','Renault','SsangYong','Toyota','Volkswagen'
    ];
    public function index()
    {
        $params = Request::all();
        if(!empty($params) && isset($params['search']) && !empty($params['search'])){

            $result = $this->index_post();
            return View('Home.index', $result);

        }else{
            $branch = Input::get('branch');
            $price = Input::get('price');
            if($price != ''){
                $cond_str_price = "index_key_str = 'thongso_65' and index_value ='$price' ";
                $listPost = Baivietindex::whereRaw($cond_str_price)
                    ->distinct('baivietID')
                    ->where('op_baiviets.status', 'PUBLIC')
                    ->join('op_baiviets', 'op_baiviets.id', '=', 'op_baiviet_indexs.baivietID')
                    ->OrderBy('op_baiviets.id', 'desc')
                    ->paginate(self::POST_PER_PAGE);
            }else{
                if ($branch != '' && $branch != 'all') {
                    if($branch == 'khac'){
                        $branch = 'khác';
                        $cond_str = "index_key_str = 'thongso_20'";
                        $listPost = Baivietindex::whereRaw($cond_str)
                            ->whereNotIn('index_value', $this->arrayLogoBranch)
                            ->distinct('baivietID')
                            ->where('op_baiviets.status', 'PUBLIC')
                            ->join('op_baiviets', 'op_baiviets.id', '=', 'op_baiviet_indexs.baivietID')
                            ->OrderBy('op_baiviets.id', 'desc')
                            ->paginate(self::POST_PER_PAGE)
                            ->setPath('?branch=khac');
                    }else{
                        $cond_str = "index_key_str = 'thongso_20' and index_value ='$branch'";
                        $listPost = Baivietindex::whereRaw($cond_str)
                            ->distinct('baivietID')
                            ->where('op_baiviets.status', 'PUBLIC')
                            ->join('op_baiviets', 'op_baiviets.id', '=', 'op_baiviet_indexs.baivietID')
                            ->OrderBy('op_baiviets.id', 'desc')
                            ->paginate(self::POST_PER_PAGE)
                            ->setPath('?branch=' . $branch);
                    }
                } else {
                    $branch = 'TẤT CẢ CÁC HÃNG XE';
                    $listPost = Baiviet::where('status', 'PUBLIC')
                        ->OrderBy('id', 'desc')
                        ->paginate(self::POST_PER_PAGE);
                }
            }
            $res = $listPost->toArray();
            $totalPage = $res['last_page'];
            $currentPage = $res['current_page'];
            if($totalPage == 0){
                $currentPage = 0;
            }
            foreach ($listPost as $item){
                $item->thongso = json_decode($item->thongso,true);
            }

            return View('Home.index', [
                'listPost' => $listPost,
                'branch' => $branch,
                'totalPage' => $totalPage,
                'currentPage' => $currentPage

            ]);
        }

    }

    public static function createWatermark($file){
        $watermark = imagecreatefrompng('./images/watermark.png');
        $source = getimagesize($file);
        $source_mime = $source['mime'];
        $posx = $source[0] - 155;
        $posy = $source[1] - 155;
        switch ($source_mime){
            case 'image/png':
                $image = imagecreatefrompng($file);
                break;
            case 'image/jpeg':
                $image = imagecreatefromjpeg($file);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($file);
                break;
            default:
                break;

        }
        imagecopy($image, $watermark, $posx, $posy, 0, 0, imagesx($watermark), imagesy($watermark));
        imagepng($image, $file);
        imagedestroy($image);
        imagedestroy($watermark);

        return $file;
    }

    public function resizeAllImages()
    {
        $listNews = News::where('status', News::STATUS_ACTIVE)->get();
        foreach($listNews as $item){
            $file = '.'.$item->thumbnail;
            $output = imagecreatetruecolor(546, 260);
            $source = getimagesize($file);
            $source_mime = $source['mime'];
            switch ($source_mime){
                case 'image/png':
                    $image = imagecreatefrompng($file);
                    break;
                case 'image/jpeg':
                    $image = imagecreatefromjpeg($file);
                    break;
                case 'image/gif':
                    $image = imagecreatefromgif($file);
                    break;
                default:
                    break;

            }
            imagecopyresampled($output, $image, 0, 0, 0, 0, 546, 260, imagesx($image), imagesy($image));
            imagepng($output, $file);
        }
        echo "done";
    }

    private  function getHangXe($id){
        $dt = Hangxe::where('id',$id)->get()->toArray();
        if(!empty($dt)){
            return $dt[0]['hang_xe'];
        }
        return null;
    }
    public function index_post()
    {

        $result = array(
            'result' =>true,
            'mess' =>'',
            'branch' => 'all',
            'totalPage' => 0,
            'currentPage' => 0
        );
        $listPost = null;
        $params = Request::all();
        $urlParams = "?search=1";
        $searchform =array();
        foreach ($this->filterParams as $k=>$v){
            if(isset($params[$k])){
                $urlParams .="&".$k."=".$params[$k];
                $searchform[$v] = $params[$k];
            }
        }
//        var_dump($searchform);exit();
        if(isset($searchform)){

            $have_search = false;
            $array_all_id = array();
            $i =0;
            foreach($searchform as $k => $v){
                $conditions = "";
                if(!empty($v)){
                    $have_search = true;
                    $v = trim($v);
                    switch ($k){
                        case "thongso_20":
                            $vv = $this->getHangXe($v);
                            if(!empty($v)){
                                $conditions ="index_key_str ='$k' and index_value ='$vv' ";
                            }


                            break;
                        case "keyword":
                            $conditions = "(index_key_str ='tieude' or index_key_str ='thongso_67') and index_value like '%$v%' ";
                            break;
                        case "thongso_65":
                            $arr = explode("-",$searchform['thongso_65']);
                            $arr[0] *=1000000;
                            $arr[1] *=1000000;
                            $conditions = "index_key_str ='$k' and REPLACE(index_value,'.','') >= $arr[0]  and REPLACE(index_value,'.','') <= $arr[1] ";
                            break;

                        default:
                            $conditions ="index_key_str ='$k' and index_value ='$v' ";
                            break;
                    }
//                    var_dump($conditions);exit();
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
//                var_dump($arr_idx);exit();
                if(!empty($arr_idx)){
                    $listPost = Baiviet::where('status', 'PUBLIC')->whereIn('id',$arr_idx)->paginate(self::POST_PER_PAGE)->setPath($urlParams);;
                }else{
                    $result['result'] = false;
                    $result['mess'] = "Không tìm thấy bài viết nào !";
                }
            }elseif(!$have_search){
                $listPost = Baiviet::where('status', 'PUBLIC')->paginate(self::POST_PER_PAGE)->setPath($urlParams);

            }



            ##################
        }else{
            $listPost = Baiviet::where('status', 'PUBLIC')->paginate(self::POST_PER_PAGE)->setPath($urlParams);

        }
//        var_dump($listPost);exit();
        if(!empty($listPost)){
            foreach ($listPost as $item){
                $item->thongso = json_decode($item->thongso,true);
            }
            $res = $listPost->toArray();
            $totalPage = $res['last_page'];
            $currentPage = $res['current_page'];
            if($totalPage == 0){
                $currentPage = 0;
            }
            $result['totalPage'] = $totalPage;
            $result['currentPage'] = $currentPage;
        }

        $result['listPost'] = $listPost;

        $listVipSalon = VipSalon::where('status', VipSalon::STATUS_ACTIVE)
            ->limit(10)
            ->get();
//        var_dump($searchform);exit();
        $result['searchform'] = $searchform;

        $result['listVipSalon'] = $listVipSalon;

        return $result;
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
        $listPost = Baiviet::where('userid', $user->id)->where('status','<>' ,'DELETED')->paginate(self::POST_PER_PAGE);;
        foreach ($listPost as $item){
            $item->thongso = json_decode($item->thongso,true);
        }
//        echo '<pre>';print_r($listPost);exit();
        $totalPost = Baiviet::where('userid', $user->id)->where('status','<>' ,'DELETED')->count();
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
            //'phone' => $data['phone'],
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
            ->paginate(self::NEWS_PER_PAGE);
        return View('News.list-news', [
            'listNews' => $res
        ]);
    }
    public function videos()
    {
        $res = Video::where('op_videos.status', Video::STATUS_ACTIVE)
            ->leftJoin('md_users', 'md_users.id', '=', 'op_videos.userID')
            ->leftJoin('md_video_embed', 'md_video_embed.id', '=', 'op_videos.embedID')
            ->OrderBy('op_videos.updated_at','desc')
            ->select('op_videos.*', 'md_users.username','md_video_embed.embedCode')
            ->paginate(self::NEWS_PER_PAGE);
        return View('Videos.list-videos', [
            'listVideos' => $res
        ]);
    }

    public function contact()
    {
        return View('Contact.contact', [

        ]);
    }
    private $EMAIL_CC = array(
        'admin@vietnamoto.net',
        'customerservice@vietnamoto.net',
        'leethong@vietnamoto.net',
        'nghiembao@vietnamoto.net',
        'thangnguyen@vietnamoto.net',
    );
    public function sendEmailContact()
    {
        $result =array(
            'result'=>false,
            'mess' =>''
        );
        $MAIL_USERNAME = env("MAIL_USERNAME", "no-reply@vietnamoto.net");
        $param = Input::all();
        $dt = $param['formData'];
        $inputDT = array();
        foreach ($dt as $v){
            $inputDT[$v['name']] = $v['value'];
        }
//        var_dump($inputDT);exit();
        if(!empty($inputDT["email"]) &&!empty($inputDT["content"]) ){
            $data = array('name' => 'Guest', 'email' => $inputDT["email"], 'content' =>str_replace("\r\n","<br>",$inputDT['content']));
            $header = array(
                'from' =>array(
                    'email' =>$MAIL_USERNAME,
                    'name'=>'VietnamOTO.net'
                ),
                'to'=>array("leethong@vietnamoto.net"),
                'cc' =>$this->EMAIL_CC,
                'bcc'=>array(),
                'subject' =>"[VNO-".date("YmdHis")."] Contact ticket from Guest ".$inputDT["email"]
            );
            try{
                Mail::send('emails.contact', $data, function($message) use ($header)
                {
                    $message->from($header['from']['email'], $header['from']['name']);
                    $message->to($header['to'])->cc($header['cc'])->bcc($header['bcc']);
                    $message->subject($header['subject']);
                });

                $result['result'] = true;
                $result['mess'] = "<span style='color:green;'> Gởi email thành công, Cám ơn bạn đã liên hệ với chúng tôi!</span>";
            }catch (Exception $e){
                $result['mess'] = "<span style='color:red;'> Gởi email thất bại, vui lòng thử lại sau!  </span>";
            }


        }else{
            $result['mess'] = "<span style='color:red;'> Gởi email thất bại, vui lòng nhập đầy đủ thông tin liên hệ  </span>";
        }

        return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json'
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
        $detailPost->thongso = json_decode($detailPost->thongso,true);

        $strFilter = $detailPost->thongso['thongso_20'];
        $cond_str = "index_key_str = 'thongso_20' and index_value ='$strFilter' ";
        $listPostRelatedType = Baivietindex::whereRaw($cond_str)->distinct('baivietID')
            ->where('op_baiviets.status', 'PUBLIC')
            ->join('op_baiviets', 'op_baiviets.id', '=', 'op_baiviet_indexs.baivietID')
            ->OrderBy('op_baiviets.id', 'desc')
            ->limit(6)
            ->whereNotIn('id', [$detailPost->id])
            ->get();
        foreach ($listPostRelatedType as &$item){
            $item->thongso = json_decode($item->thongso,true);
        }
        $strFilterPrice = $detailPost->thongso['thongso_65'];
        $cond_str_price = "index_key_str = 'thongso_65' and index_value ='$strFilterPrice' ";
        $listPostRelatedPrice = Baivietindex::whereRaw($cond_str_price)->distinct('baivietID')
            ->where('op_baiviets.status', 'PUBLIC')
            ->join('op_baiviets', 'op_baiviets.id', '=', 'op_baiviet_indexs.baivietID')
            ->OrderBy('op_baiviets.id', 'desc')
            ->limit(6)
            ->whereNotIn('id', [$detailPost->id])
            ->get();
        foreach ($listPostRelatedPrice as &$item){
            $item->thongso = json_decode($item->thongso,true);
        }
        return View('Post.detail-post', [
            'detailPost' => $detailPost,
            'listPostRelatedType' => $listPostRelatedType,
            'listPostRelatedPrice' => $listPostRelatedPrice,
            'strFilter' => $strFilter,
            'price' => $strFilterPrice
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

    public function freePost($id_slug=null)
    {
        if(!Auth::check()){
            return Redirect::to("admin/login");
        }
        $result =array();
        $user = Auth::user();
        $bv = array();
        $formData =  Request::all();
        if(!empty($id_slug)){

            $arr_pid = explode("-",$id_slug);
            $pid = $arr_pid[0];
            $baiviet = Baiviet::where('status','<>','DELETED')->where('id','=',$pid)->get()->toArray();

//            var_dump($baiviet);exit();
            if(!empty($baiviet)){
                $bv = $baiviet[0];
                if($user->id == $bv['userid']){
                    $bv['thongso'] = json_decode($bv['thongso'],true);
                    if(Request::getMethod() == 'POST' && !empty($formData)){

                        $upbv = array();

                        $upbv['updated_by'] = Auth::id();
                        $bv['thongso']['thongso_35'] = $formData['thongso_35'];
                        $bv['thongso']['thongso_27'] = $formData['thongso_27'];
                        $bv['thongso']['thongso_32'] = $formData['thongso_32'];
                        $bv['thongso']['thongso_34'] = $formData['thongso_34'];
                        $bv['thongso']['thongso_33'] = $formData['thongso_33'];
                        $bv['thongso']['thongso_30'] = $formData['thongso_30'];
                        $bv['thongso']['thongso_29'] = $formData['thongso_29'];
                        $bv['thongso']['thongso_35'] = $formData['thongso_35'];
                        $bv['thongso']['thongso_63'] = $formData['thongso_63'];
                        $bv['thongso']['thongso_68'] = $formData['thongso_68'];
                        $bv['thongso']['thongso_65'] = $formData['thongso_65'];
                        $bv['thongso']['thongso_73'] = $formData['thongso_73'];
                        $bv['thongso']['thongso_67'] = str_replace("\r\n","<br>",$formData['thongso_67']);
                        $arr1 = explode("/",$formData['photo1']);
                        $arr2 = explode("/",$formData['photo2']);
                        $arr3= explode("/",$formData['photo3']);
                        $arr4= explode("/",$formData['photo4']);
                        $arr5 = explode("/",$formData['photo5']);
                        $bv['thongso']['photo1'] = $arr1[count($arr1)-1];
                        $bv['thongso']['photo2'] = $arr2[count($arr2)-1];
                        $bv['thongso']['photo3'] = $arr3[count($arr3)-1];
                        $bv['thongso']['photo4'] = $arr4[count($arr4)-1];
                        $bv['thongso']['photo5'] = $arr5[count($arr5)-1];

                        $upbv['mo_ta'] = str_replace("\r\n","<br>",$formData['thongso_67']);
                        $upbv['dia_chi'] =$formData['thongso_68'];
                        $upbv['gia_goc'] = str_replace(".","",$formData['thongso_65']);
                        $upbv['gia_sale'] = str_replace(".","",$formData['thongso_65']);
                        $upbv['status'] = 'PENDING';
                        $upbv['photo1'] = $bv['thongso']['photo1'];
                        $upbv['photo2'] = $bv['thongso']['photo2'];
                        $upbv['photo3'] = $bv['thongso']['photo3'];
                        $upbv['photo4'] = $bv['thongso']['photo4'];
                        $upbv['photo5'] = $bv['thongso']['photo5'];
                        $upbv['slug'] = $bv['id'].'-'.str_slug($bv['tieu_de'], '-');
                        $upbv['thongso'] = json_encode($bv['thongso']);

                        $needindexs = DB::table('md_thongso')->where('md_thongso.status', 1)->where('md_thongso.need_index', 1)->pluck('id')->toArray();
                        DB::beginTransaction();
                        $r1 = Baiviet::where('id',$bv['id'])->update($upbv);
                        $r2 = true;
                        if(!empty($needindexs)){
                            foreach ($bv['thongso'] as $k => $v){
                                $arr = explode("_",$k);
                                if(count($arr)==2 && in_array($arr[1],$needindexs)){
                                    if($k =="thongso_67"){
                                        $v = $this->convert_vi_to_en($v);
                                        $v = $this->clean($v);
                                    }
                                    $r2 = Baivietindex::where('baivietID',$bv['id'])->where('index_key',$arr[1])->update(array('index_value'=>utf8_encode($v)));
                                    if(!$r2){
                                        break;
                                    }
                                }

                            }
                        }
                        if($r2 && $r1){
                            DB::commit();
                            $result['result'] = true;
                            $result['mess'] = 'Lưu bài viết thành công!, Bài viết của bạn đang được các quản trị viên xử lý...';
                            $_POST = array();
                        }else{
                            DB::rollback();
                        }
                    }

                }else{
                    $result['result'] =false;
                    $result['mess'] = "Bạn không có quyền chỉnh sửa bài viết này!";
                }
            }else{
                $result['result'] =false;
                $result['mess'] = "Không tìm thấy bài viết!";
            }

        }else{
            if(Request::getMethod() == 'POST' && !empty($formData)){

//                var_dump($formData);exit();
                $rules =[];
                if($formData['optradio']=="NORMAL"){
                    $rules = ['nm_captcha' => 'required|captcha'];
                }else{
                    $rules = ['vip_captcha' => 'required|captcha'];
                }
                $validator = Validator::make($formData, $rules);

                if (!$validator->fails())
                {
//                    var_dump($formData);exit();
                    $formData['loai_tin'] = $formData['optradio'];
                    $formData['auto_up'] = $formData['optradio1'];
                    $formData['hang_xe'] = $formData['thongso_20'];
                    $formData['dong_xe'] = $formData['thongso_75'];

                    $getHangXe = Hangxe::where("id",$formData['thongso_20'])->get()->toArray();
                    if(!empty($getHangXe)){
                        $formData['thongso_20'] = $getHangXe[0]['hang_xe'];
                    }

                    $getHangXe = Dongxe::where("id",$formData['thongso_75'])->get()->toArray();
                    if(!empty($getHangXe)){
                        $formData['thongso_75'] = $getHangXe[0]['dong_xe'];

                    }
                    $arr_fr =explode("/",$formData['actived_from']);
                    $formData['actived_from'] = $arr_fr[2]."-".$arr_fr[1]."-".$arr_fr[0]." 00:00:00";

                    $arr_to =explode("/",$formData['actived_to']);
                    $formData['actived_to'] = $arr_to[2]."-".$arr_to[1]."-".$arr_to[0]." 23:59:59";
                    $formData['thongso_67'] = str_replace("\r\n","<br>",$formData['thongso_67']);

//                    var_dump($formData);exit();
                    $hash = md5(json_encode($formData));
                    $ck = Submittoken::where("token",$hash)->count();
                    if($ck==0){
                        $result = $this->save_bai_viet($formData);
                        $tk = new Submittoken;
                        $tk->token = $hash;
                        $tk->userid = $user->id;
                        $tk->save();
                    }
                    $_POST = array();

                }
            }
        }


        $thongso = $this->get_thongso_init();



        $listHangXe =  Hangxe::where('status',1)->get()->toArray();
        $hangxes = array();
        if(!empty($listHangXe)){
            foreach ($listHangXe as $hx){
                $hangxes[$hx['id']]=$hx['hang_xe'];
            }
        }


        $listCity =  City::getCity()->toArray();

        $datas = array(
            'user' => $user,
            'thongso'=>$thongso,
            'result' =>$result,
            'baiviet' =>$bv,
            'hangxes' =>$hangxes,
            'listCity'=>$listCity

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
    private function save_bai_viet($formData){


        $result =array(
            'result'=>false,
            'mess' =>''
        );
        if (Auth::check()) {
            $tieude = "";
            $bvid = null;
            $mota = "";
            $thongso = array();
            $photo =array();

            foreach ($formData as $k=> $dt){
                $thongso[$k] = $dt;
                $arrk = explode("_",$k);
                if(count($arrk)==2){
//                    if(in_array($arrk[1],$this->THONGSO_TITLE)){
//                        $tieude .= $dt." ";
//                    }
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

            $tieude = $formData['thongso_20']." ".$formData['thongso_75']." ".$formData['thongso_22'];
            $tieude = trim($tieude);
//            var_dump($tieude);exit();
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
                $bv->mo_ta = str_replace("\r\n","<br>",$mota);
                $bv->loai_tin = $formData['optradio'];
                $bv->hang_xe = $formData['hang_xe'];
                $bv->dong_xe = $formData['dong_xe'];
                $bv->auto_up = $formData['auto_up'];
                $bv->actived_from = $formData['actived_from'];
                $bv->actived_to = $formData['actived_to'];

                $bv->thongso = json_encode($thongso);
                foreach ($photo as $k =>$v){
                    $bv->{$k} = $v;
                }
                $r1 = true;
//                var_dump($bvid);exit();
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

                        if(!empty($bvid)){
                            //update
                            $rd = Baivietindex::where('baivietID',$bv->id)->delete();


                        }
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
                                $r2 = $save_index->save();

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
                    $result['mess'] = 'Đăng bài viết thành công!, Bài viết của bạn đang được các quản trị viên xử lý...';
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
        return $result;

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

        $dt =array();
        foreach ($list_thongso as $v){
            $v['arr_options'] =  array();
            if($v['type']=="combo" && !empty($v['options']) ){
                $v['arr_options'] = $this->convert_option_to_array($v['options']);
            }
            $dt["thongso_".$v['id']] = $v;
        }
//        var_dump($dt);exit();
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
    public function getLoaiBaiViet(){
        $result =array(
            'result' =>false,
            'mess' =>'',
            'data'=>array()
        );
        $formData =  Request::all();
        if(isset($formData['id']) && !empty($formData['id'])){
            $id = $formData['id'];
            $listLoaiTin =Loaibaiviet::where("status",1)->where("ma_loai_tin",$id)->get()->toArray();
            if(!empty($listLoaiTin)){

                $result['data'] = $listLoaiTin[0];
            }
            $result['result'] = true;
        }else{
            $result['mess'] = "Vui lòng chọn loại tin cần đăng";
        }

        return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json'
            ]);
    }
    public function getdongxe(){
        $result =array(
            'result' =>false,
            'mess' =>'',
            'data'=>array()
        );
        $formData =  Request::all();
//        var_dump($formData);exit();
        if(isset($formData['id']) && !empty($formData['id'])){
            $id = $formData['id'];
            $listDongXe =  Dongxe::where('status',1)->where('hang_xe',$id)->get()->toArray();
            $dongxes = array();
            if(!empty($listDongXe)){
                foreach ($listDongXe as $hx){
                    $dongxes[$hx['id']]=$hx['dong_xe'];
                }
            }
            if(!empty($dongxes)){
                $result['result'] = true;
                $result['data'] = $dongxes;
            }else{
                $result['mess'] = 'Không tìm thấy dòng xe';
            }

        }else{
            $result['mess'] = 'Không tìm thấy hãng xe';
        }
        return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json'
            ]);

    }
    public function changecaptcha(){
        return Captcha::src();
    }


}