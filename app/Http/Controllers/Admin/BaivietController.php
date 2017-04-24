<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Auth;
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
use App\VipSalon;
use App\City;
use Request;
use DB;
use Validator;

class BaivietController extends Controller
{

    /**
     * Show the profile for the given user.
     *
     * @param  int $id
     * @return Response
     */
    private $THONGSO_TITLE = array(20, 25, 22);
    private $THONGSO_MOTA = 67;
    private $NOT_ALLOW_INDEX_CHAR = array("'", '"', "`", "]", "[", "}", "{", "!", "~", "#", "^", "&", "*", "$", "+", ",", ".", "\xE1", "\xBB", "\x9Bi");
    private $ARR_PHOTO = array("photo1", "photo2", "photo3", "photo4", "photo5");

    public function index()
    {
        if (!Auth::check()) {
            return Redirect::to("admin/login");
        }
        $user = Auth::user();
        if ($user->group != 1) {
            return Redirect::to("/");
        }
        $res = Thongtinxe::join('md_nhom_thongso', 'md_nhom_thongso.parentid', '=', 'md_thongtinxe.id')
            ->join('md_thongso', 'md_thongso.group', '=', 'md_nhom_thongso.id')
            ->select('md_thongso.*', 'md_nhom_thongso.name as nameNhom', 'md_nhom_thongso.id as idNhom',
                'md_thongtinxe.id as idTab', 'md_thongtinxe.name as nameTab', 'md_nhom_thongso.hidden')
            ->where('md_thongtinxe.status', 1)
            ->where('md_nhom_thongso.status', 1)
            ->where('md_thongso.status', 1)
            ->get()->toArray();

//       var_dump($res);exit();
        $info = array(
            'title' => 'Admin DashBoard',
            'content' => 'This is admin dashboard page'
        );
//        $thongtinxe = Thongtinxe::where('status',1)->get();
//        $thongtinxe = $thongtinxe->toArray();
//        $nhomthongso = Nhomthongso::where('status',1)->get();
        $thongtinxe = array();
        foreach ($res as $v) {
            $thongtinxe[$v['idTab']]['ls'][$v['idNhom']]['ls'][] = $v;
            if (!isset($thongtinxe[$v['idTab']]['nameTab'])) {
                $thongtinxe[$v['idTab']]['nameTab'] = $v['nameTab'];
            }
            if (!isset($thongtinxe[$v['idTab']]['ls'][$v['idNhom']]['nameNhom'])) {
                $thongtinxe[$v['idTab']]['ls'][$v['idNhom']]['nameNhom'] = $v['nameNhom'];
                $thongtinxe[$v['idTab']]['ls'][$v['idNhom']]['hidden'] = $v['hidden'];
            }
        }
//        var_dump($thongtinxe[2]);exit();
        $datas = array(
            'name' => 'posts',
            'info' => $info,
            'thongtinxe' => $thongtinxe
        );

        return view('Admin.Baiviet.index')->with($datas);
    }

    public function get_bai_viet()
    {
        $content = '<?xml version="1.0" encoding="iso-8859-1" ?>';
//        $content .=  '<rows total_count="'.$total_rec.'" pos="'.$posStart.'">';
        $content .= '<rows>';
        $content .= '<head>';
        $content .= '<column style="font-weight: bold" type="ro" width="50" sort="int">No</column>';
        $content .= '<column style="font-weight: bold" type="img" width="150" sort="na">Ảnh</column>';
        $content .= '<column style="font-weight: bold" type="ro" width="200" sort="str">Tiêu Đề</column>';


        $needindexs = Thongso::where('status', 1)->where('need_index', 1)->where('id', '<>', $this->THONGSO_MOTA)->get()->toArray();
        $order_thongso_key = array();
        if (!empty($needindexs)) {
            foreach ($needindexs as $v) {
                $content .= '<column id="thongso_' . $v['id'] . '" style="font-weight: bold" type="ro" width="100" sort="str">' . $v['name'] . '</column>';
                $order_thongso_key[] = $v['id'];
            }
        }

        $content .= '<column style="font-weight: bold" type="ro" width="150" sort="int">Published</column>';
        $content .= '<column style="font-weight: bold" type="ro" width="100" sort="int">Status</column>';
        $content .= '</head>';

        $conditions = " status <>'DELETED' ";
        $formData = Request::all();
        if (!empty($formData)) {
            if (!empty($formData['date_fr'])) {
                $conditions .= " AND created_at  >='" . $formData['date_fr'] . " 00:00:00' ";

            }
            if (!empty($formData['date_to'])) {
                $conditions .= " AND created_at  <='" . $formData['date_to'] . " 23:59:59' ";

            }
        }

        $baiviets = Baiviet::whereRaw($conditions)->orderBy('updated_at', 'desc')->get()->toArray();
        $arr_final = array();
        if (!empty($baiviets)) {

            $idarr = array();
            $str_id = "(";
            foreach ($baiviets as $v) {
                $idarr[] = $v['id'];
                $arr_final[$v['id']] = $v;

                $str_id .= "'" . $v['id'] . "',";
            }
            $str_id = substr($str_id, 0, strlen($str_id) - 1);
            $str_id .= ")";

//            var_dump($idarr);exit();
            $baiviet_indexs = Baivietindex::join('md_thongso', 'md_thongso.id', '=', 'op_baiviet_indexs.index_key')
                ->whereIn('op_baiviet_indexs.baivietID', $idarr)->where('op_baiviet_indexs.index_key', '<>', $this->THONGSO_MOTA)->get()->toArray();
//            var_dump($baiviet_indexs);exit();
            if (!empty($baiviet_indexs)) {
                foreach ($baiviet_indexs as $v) {
                    $arr_final[$v['baivietID']][$v['index_key']] = $v['index_value'];
                }

            }

        }
//        var_dump($arr_final);exit();

        $no = 1;
        foreach ($arr_final as $v) {
//            var_dump($v);
            $content .= '<row id="' . $v['id'] . '">';
            $content .= '<cell><![CDATA[' . $no . ']]></cell>';
            $content .= '<cell style="max-height: 60px !important;"><![CDATA[/uploads/baiviet/thumb/m/' . $v['photo1'] . ']]></cell>';
            $mota = str_replace("\"", "", $v['mo_ta']);
//            $content .=  '<cell title="'.$mota.'"><![CDATA['.$v['tieu_de'].']]></cell>';
            $content .= '<cell><![CDATA[' . $v['tieu_de'] . ']]></cell>';
            foreach ($order_thongso_key as $kid) {
                if (isset($v[$kid])) {
                    $content .= '<cell><![CDATA[' . $v[$kid] . ']]></cell>';
                } else {
                    $content .= '<cell><![CDATA[]]></cell>';
                }

            }
            $content .= '<cell><![CDATA[' . $v['published'] . ']]></cell>';
            $content .= '<cell><![CDATA[' . $v['status'] . ']]></cell>';
            $content .= '</row>';
            $no++;
        }
        $content .= '</rows>';

        return response($content)
            ->withHeaders([
                'Content-Type' => 'text/xml'
            ]);
//        return view('Admin\Baiviet.get_bai_viet')->header('Content-Type', 'text/xml')->with($datas);
    }

    public function get_bai_viet_edit()
    {

        $result = array(
            'result' => false,
            'mess' => ''
        );
        $formData = Request::all();
        if (!empty($formData['bvid'])) {

            $bvid = $formData['bvid'];
            $baiviets = Baiviet::where('status', '<>', 'DELETED')->where('id', $bvid)->limit(1)->get()->toArray();
            if (!empty($baiviets)) {
                $result['result'] = true;
                $bv = $baiviets[0];
                $bv['thongso'] = json_decode($bv["thongso"]);
                $bv['token'] = csrf_token();
                $result["data"] = $bv;

            } else {
                $result['mess'] = "Không tìm thấy bài viết";
            }


        } else {
            $result['mess'] = "Không tìm thấy bài viết";
        }

        return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json'
            ]);
    }

    const  POST_PUBLIC = true;

    private function save_bai_viet($formData)
    {


        $result = array(
            'result' => false,
            'mess' => ''
        );
        if (Auth::check()) {
            $tieude = "";
            $bvid = null;
            $mota = "";
            $thongso = array();
            $photo = array();

            foreach ($formData as $k => $dt) {
                $thongso[$k] = $dt;
                $arrk = explode("_", $k);
                if (count($arrk) == 2) {
                    if ($arrk[1] == $this->THONGSO_MOTA) {
                        $mota = $dt;
                    }


                }
                if (in_array($k, $this->ARR_PHOTO)) {
                    $arr = explode("/", $dt);
                    $photo[$k] = $arr[count($arr) - 1];
                }
                if ($k == "id") {
                    $bvid = $dt;
                }

            }

            $tieude = $formData['thongso_20'] . " " . $formData['thongso_75'] . " " . $formData['thongso_22'];
            $tieude = trim($tieude);
            if (!empty($tieude) && !empty($mota)) {
                DB::beginTransaction();
                $bv = new Baiviet;
                if (self::POST_PUBLIC) {
                    $bv->status = "PUBLIC";
                    $bv->published = date("Y-m-d H:i:s");
                } else {
                    $bv->status = "PENDING";
                }

                $bv->tieu_de = $tieude;
                $bv->mo_ta = str_replace("\r\n", "<br>", $mota);
                $bv->loai_tin = $formData['optradio'];
                $bv->hang_xe = $formData['hang_xe'];
                $bv->dong_xe = $formData['dong_xe'];
                $bv->auto_up = $formData['auto_up'];
                $bv->actived_from = $formData['actived_from'];
                $bv->actived_to = $formData['actived_to'];

                $bv->thongso = json_encode($thongso);
                foreach ($photo as $k => $v) {
                    $bv->{$k} = $v;
                }
                $r1 = true;
                if (!empty($bvid)) {
                    $bv->updated_by = Auth::id();
                    $r1 = Baiviet::where('id', $bvid)->update($bv->toArray());
                    $bv->id = $bvid;

                } else {
                    $bv->userid = Auth::id();
                    $r1 = $bv->save();
                }
                if ($r1) {
                    $r2 = true;
                    $needindexs = DB::table('md_thongso')->where('md_thongso.status', 1)->where('md_thongso.need_index', 1)->pluck('id')->toArray();
                    if (!empty($needindexs)) {

                        if (!empty($bvid)) {
                            //update
                            $rd = Baivietindex::where('baivietID', $bv->id)->delete();


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
                    $result['mess'] = 'Đăng bài viết thành công!';
                } else {
                    DB::rollback();
                    $result['mess'] = 'Có lỗi xảy ra, vui lòng thử lại sau ít phút!';
                }
            } else {

                $result['mess'] = 'Vui lòng nhập đầy đủ thông tin bắt buộc (có dấu sao màu đỏ)';

            }

        } else {
            $result['mess'] = 'Vui lòng đăng nhập để sử dụng chức năng này ';
        }
        return $result;

    }

    private function clean($string)
    {
        $string = str_replace($this->NOT_ALLOW_INDEX_CHAR, " ", $string);

        return $string;
    }

    private function convert_vi_to_en($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $str);
        $str = preg_replace("/(đ)/", "d", $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", "A", $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", "E", $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", "I", $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", "O", $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", "U", $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", "Y", $str);
        $str = preg_replace("/(Đ)/", "D", $str);
        return $str;
    }

    public function del_bai_viet()
    {

        $result = array(
            'result' => false,
            'mess' => ''
        );


        if (Auth::check()) {
            $formData = Request::all();
            $bvid = $formData['baivietID'];
            $r = Baiviet::where('id', $bvid)->update(["status" => "DELETED"]);
            if ($r) {
                $result['result'] = true;
                $result['mess'] = "Xóa bài viết thành công";
            } else {
                $result['mess'] = "Xóa không thành công, vui lòng thử lại!!";
            }


        } else {
            $result['mess'] = 'Vui lòng đăng nhập để sử dụng chức năng này ';
        }
        return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json'
            ]);

    }

    public function pub_bai_viet()
    {

        $result = array(
            'result' => false,
            'mess' => ''
        );


        if (Auth::check()) {
            $formData = Request::all();
            $bvid = $formData['baivietID'];
            $ck = Baiviet::where('id', $bvid)->get()->toArray();
            if (!empty($ck)) {
                $bv = $ck[0];
                if ($bv['status'] != "PUBLIC") {
                    $r = Baiviet::where('id', $bvid)->update(["status" => "PUBLIC", "published" => date("Y-m-d H:i:s")]);
                    if ($r) {
                        $result['result'] = true;
                        $result['mess'] = "Public bài viết thành công";
                    } else {
                        $result['mess'] = "Public không thành công, vui lòng thử lại!!";
                    }
                } else {
                    $result['mess'] = "Bài viết này đã public rồi!!!";
                }

            } else {
                $result['mess'] = "Bài viết không tồn tại!!";
            }


        } else {
            $result['mess'] = 'Vui lòng đăng nhập để sử dụng chức năng này ';
        }
        return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json'
            ]);

    }

    public function get_total_news()
    {
        $tt = Baiviet::where('status', '<>', 'DELETED')->count();
        $result = array("tt" => $tt);
        return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json'
            ]);
    }

    public function uploadimg()
    {
        $result = array(
            'result' => false,
            'url' => '',
            'mess' => ''
        );
        if (Auth::check()) {
            $user = Auth::user();
//            var_dump($_FILES);exit();
            if (isset($_FILES["file"]["tmp_name"])) {
                $k = md5_file($_FILES["file"]["tmp_name"]);
                $path = "uploads/baiviet/";
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $path . $k)) {
                    chmod($path . $k, 0666);

                    $result['result'] = true;
                    $pathFinal = HomeController::createWatermark('./' . $path . $k);
                    $result['url'] = $pathFinal . '?' . filemtime($pathFinal);
                    $rtb = $this->makeThumbnails($path, $k);
                    if ($rtb === false) {
                        //retry create thumbnail
                        $rtb = $this->makeThumbnails($path, $k);
                    }

                } else {
                    $result['mess'] = 'Upload failed!';
                }


            } else {
                $result['mess'] = 'Not change';
            }
        } else {
            $result['mess'] = 'You do not have permission!';
        }
        return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json'
            ]);


    }


    private function get_thongso_init()
    {
        $list_thongso = Thongso::where('status', 1)->get()->toArray();

        $dt = array();
        foreach ($list_thongso as $v) {
            $v['arr_options'] = array();
            if ($v['type'] == "combo" && !empty($v['options'])) {
                $v['arr_options'] = $this->convert_option_to_array($v['options']);
            }
            $dt["thongso_" . $v['id']] = $v;
        }
//        var_dump($dt);exit();
        return $dt;
    }

    private function convert_option_to_array($options)
    {
        $options = str_replace("[{", "", $options);
        $result = array();
        if (!empty($options)) {
            $arr_options = explode("},{", $options);
            if (!empty($arr_options)) {
                foreach ($arr_options as $v) {
                    $arr2 = explode(",", $v);

                    if (count($arr2) == 2) {
                        $value = "";
                        $text = "";
                        foreach ($arr2 as $v2) {
                            if (strpos($v2, "value")) {
                                $value = $this->get_string_between($v2, '"', '"');
                            } else {
                                $text = $this->get_string_between($v2, '"', '"');
                            }
                        }
                        if (!empty($value) || !empty($text)) {
                            $result[$value] = $text;
                        }
                    }


                }
            }

        }
        return $result;
    }

    private function get_string_between($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    public function add_bai_viet($id_slug = null)
    {
        if (!Auth::check()) {
            return Redirect::to("admin/login");
        }
        $result = array();
        $user = Auth::user();
        $bv = array();
        $formData = Request::all();
        if (!empty($id_slug)) {

            $arr_pid = explode("-", $id_slug);
            $pid = $arr_pid[0];
            $baiviet = Baiviet::where('status', '<>', 'DELETED')->where('id', '=', $pid)->get()->toArray();

//            var_dump($baiviet);exit();
            if (!empty($baiviet)) {
                $bv = $baiviet[0];

                $bv['thongso'] = json_decode($bv['thongso'], true);
//                    var_dump($bv);exit();
                if (Request::getMethod() == 'POST' && !empty($formData)) {

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
                    $bv['thongso']['thongso_67'] = str_replace("\r\n", "<br>", $formData['thongso_67']);
                    $arr1 = explode("/", $formData['photo1']);
                    $arr2 = explode("/", $formData['photo2']);
                    $arr3 = explode("/", $formData['photo3']);
                    $arr4 = explode("/", $formData['photo4']);
                    $arr5 = explode("/", $formData['photo5']);
                    $bv['thongso']['photo1'] = $arr1[count($arr1) - 1];
                    $bv['thongso']['photo2'] = $arr2[count($arr2) - 1];
                    $bv['thongso']['photo3'] = $arr3[count($arr3) - 1];
                    $bv['thongso']['photo4'] = $arr4[count($arr4) - 1];
                    $bv['thongso']['photo5'] = $arr5[count($arr5) - 1];

                    $upbv['mo_ta'] = str_replace("\r\n", "<br>", $formData['thongso_67']);
                    $upbv['dia_chi'] = $formData['thongso_68'];
                    $upbv['gia_goc'] = str_replace(".","",$formData['thongso_65']);
                    $upbv['gia_sale'] = str_replace(".","",$formData['thongso_65']);
//                        $upbv['status'] = 'PENDING';
                    $upbv['photo1'] = $bv['thongso']['photo1'];
                    $upbv['photo2'] = $bv['thongso']['photo2'];
                    $upbv['photo3'] = $bv['thongso']['photo3'];
                    $upbv['photo4'] = $bv['thongso']['photo4'];
                    $upbv['photo5'] = $bv['thongso']['photo5'];
                    $upbv['slug'] = $bv['id'] . '-' . str_slug($bv['tieu_de'], '-');
                    $upbv['thongso'] = json_encode($bv['thongso']);

                    $needindexs = DB::table('md_thongso')->where('md_thongso.status', 1)->where('md_thongso.need_index', 1)->pluck('id')->toArray();
                    DB::beginTransaction();
                    $r1 = Baiviet::where('id', $bv['id'])->update($upbv);
                    $r2 = true;
                    $mess = "";
                    if (!empty($needindexs)) {
                        foreach ($bv['thongso'] as $k => $v) {
                            $arr = explode("_", $k);
                            if (count($arr) == 2 && in_array($arr[1], $needindexs)) {
                                if ($k == "thongso_67"){
                                    $v = $this->convert_vi_to_en($v);
                                    //$v = $this->clean($v);
                                }
                                $r2 = Baivietindex::where('baivietID', $bv['id'])->where('index_key', $arr[1])->update(array('index_value' => $v));
                                if (!$r2) {
                                    $mess = $k."=".$v;
                                    break;
                                }

                            }

                        }

                    }

                    if ($r2 && $r1) {
                        DB::commit();
                        $result['result'] = true;
                        $result['mess'] = 'Lưu bài viết thành công!';
                        $_POST = array();
                    } else {
                        DB::rollback();

                        $result['mess'] = 'Lưu thất bại!'.$r1.":".$r2.":".$mess;
                    }
                }


            } else {
                $result['result'] = false;
                $result['mess'] = "Không tìm thấy bài viết!";
            }

        } else {
            if (Request::getMethod() == 'POST' && !empty($formData)) {

//                var_dump($formData);exit();
                $rules = [];
                if ($formData['optradio'] == "NORMAL") {
                    $rules = ['nm_captcha' => 'required|captcha'];
                } else {
                    $rules = ['vip_captcha' => 'required|captcha'];
                }
                $validator = Validator::make($formData, $rules);

                if (true) //skip check captch
                {
//                    var_dump($formData);exit();
                    $formData['loai_tin'] = $formData['optradio'];
                    $formData['auto_up'] = $formData['optradio1'];
                    $formData['hang_xe'] = $formData['thongso_20'];
                    $formData['dong_xe'] = $formData['thongso_75'];

                    $getHangXe = Hangxe::where("id", $formData['thongso_20'])->get()->toArray();
                    if (!empty($getHangXe)) {
                        $formData['thongso_20'] = $getHangXe[0]['hang_xe'];
                    }

                    $getHangXe = Dongxe::where("id", $formData['thongso_75'])->get()->toArray();
                    if (!empty($getHangXe)) {
                        $formData['thongso_75'] = $getHangXe[0]['dong_xe'];

                    }
                    $arr_fr = explode("/", $formData['actived_from']);
                    $formData['actived_from'] = $arr_fr[2] . "-" . $arr_fr[1] . "-" . $arr_fr[0] . " 00:00:00";

                    $arr_to = explode("/", $formData['actived_to']);
                    $formData['actived_to'] = $arr_to[2] . "-" . $arr_to[1] . "-" . $arr_to[0] . " 23:59:59";
                    $formData['thongso_67'] = str_replace("\r\n", "<br>", $formData['thongso_67']);

//                    var_dump($formData);exit();
                    $hash = md5(json_encode($formData));
                    $ck = Submittoken::where("token", $hash)->count();
                    if ($ck == 0) {
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


        $listHangXe = Hangxe::where('status', 1)->get()->toArray();
        $hangxes = array();
        if (!empty($listHangXe)) {
            foreach ($listHangXe as $hx) {
                $hangxes[$hx['id']] = $hx['hang_xe'];
            }
        }


        $listCity = City::getCity()->toArray();

        $datas = array(
            'user' => $user,
            'thongso' => $thongso,
            'result' => $result,
            'baiviet' => $bv,
            'hangxes' => $hangxes,
            'listCity' => $listCity

        );
        return View('Admin.Baiviet.add_bai_viet', $datas);
    }

    private $THUMB_FOLDER = "thumb";
    private $THUMB_TYPE = array(
//        'pc'=>array(
//            'folder'=>'pc',
//            'width' =>414,
//            'height'=>282
//        ),
        'tablet'=>array(
            'folder'=>'tablet',
            'width' =>212,
            'height'=>141

        ),
        'mobile' => array(
            'folder' => 'm',
            'width' => 142,
            'height' => 94

        ),
        'share' => array(
            'folder' => 'share',
            'width' => 426,
            'height' => 282

        )
    );

    private function createIMGMaxSize($updir, $fName, $width, $height)
    {


        if (file_exists("$updir" . "$fName")) {
            $arr_image_details = getimagesize("$updir" . "$fName");
            $original_width = $arr_image_details[0];
            $original_height = $arr_image_details[1];
            $wn = floor($original_width / $width);
            $hn = floor($original_height / $height);
            $maxn = $wn;
            if ($hn < $maxn) $maxn = $hn;
            if ($maxn == 0) $maxn = 1;
            $newWidth = $width * $maxn;
            $newHeight = $height * $maxn;
            $top = floor($original_height / 2 - $newHeight / 2);
            $left = floor($original_width / 2 - $newWidth / 2);

            if ($arr_image_details[2] == IMAGETYPE_GIF) {
                $imgt = "ImageGIF";
                $imgcreatefrom = "ImageCreateFromGIF";
            }
            if ($arr_image_details[2] == IMAGETYPE_JPEG) {
                $imgt = "ImageJPEG";
                $imgcreatefrom = "ImageCreateFromJPEG";
            }
            if ($arr_image_details[2] == IMAGETYPE_PNG) {
                $imgt = "ImagePNG";
                $imgcreatefrom = "ImageCreateFromPNG";
            }
            if ($imgt) {
                $result = array(
                    'imgType' => $imgt,
                    'Height' => $newHeight,
                    'Width' => $newWidth,

                );
                $old_image = $imgcreatefrom("$updir" . "$fName");
                if ($original_width > $newWidth && $original_height > $newHeight) {
                    $new_image = @imagecrop($old_image, ['x' => $left, 'y' => $top, 'width' => $newWidth, 'height' => $newHeight]);
                    $result['img'] = $new_image;
                } else {
                    $result['img'] = false;
                }
                imagedestroy($old_image);
                $old_image = null;

                return $result;
            }

        }
        return null;


    }

    private function makeThumbnails($updir, $img)
    {
        if (!empty($img) && !empty($updir)) {
            $result = false;
            foreach ($this->THUMB_TYPE as $type) {
                if (!file_exists("$updir" . "$this->THUMB_FOLDER/" . $type['folder'] . "/")) {
                    mkdir("$updir" . "$this->THUMB_FOLDER/" . $type['folder'], 0777);
                }
                $width = $type['width'];
                $height = $type['height'];
                if (!file_exists("$updir" . "$this->THUMB_FOLDER/" . $type['folder'] . "/" . "$img")) {
                    $er = error_reporting(0);
                    $old_image = $this->createIMGMaxSize($updir, $img, $width, $height);

                    if (!empty($old_image)) {

                        if ($old_image['img'] === false) {
                            copy("$updir" . "$img", "$updir" . "$this->THUMB_FOLDER/" . $type['folder'] . "/" . "$img");
                        } else {
                            $new_image = imagecreatetruecolor($width, $height);
                            @imagecopyresized($new_image, $old_image['img'], 0, 0, 0, 0, $width, $height, $old_image['Width'], $old_image['Height']);
//                    imagecopyresampled($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
                            $imgt = $old_image['imgType'];
                            $imgt($new_image, "$updir" . "$this->THUMB_FOLDER/" . $type['folder'] . "/" . "$img");
//                            imagegif($new_image, "$updir" . "$this->THUMB_FOLDER/".$type['folder']."/" . "$img");
                        }
                        $old_image = null;
                        $result = true;
                    }
                    error_reporting($er);
                }
            }
            return $result;

        }

        return false;
    }
}