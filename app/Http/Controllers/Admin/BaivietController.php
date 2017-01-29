<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Thongso;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Models\Baiviet;
use App\Models\Baivietindex;
use DB;
class BaivietController extends Controller {

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    private $THONGSO_TITLE =array(20,25,22);
    private $THONGSO_MOTA =67;
    private $NOT_ALLOW_INDEX_CHAR = array("'",'"',"`","]","[","}","{","!","~","#","^","&","*","$","+",",",".","\xE1","\xBB","\x9Bi");
    private  $ARR_PHOTO = array("photo1","photo2","photo3","photo4","photo5");
    public function index()
    {
        $data =  array(
            'title' =>'Admin DashBoard',
            'content' =>'This is admin dashboard page'
        );
        return view('Admin\Baiviet.index')->with($data);
    }

    public function get_bai_viet()
    {
        $content = '<?xml version="1.0" encoding="iso-8859-1" ?>';
        $content .=  '<rows>';
        $content .=  '<head>';
        $content .='<column style="font-weight: bold" type="ro" width="50" sort="int">No</column>';
        $content .='<column style="font-weight: bold" type="ro" width="*" sort="int">Tiêu Đề</column>';
        $needindexs = Thongso::where('status',1)->where('need_index',1)->where('id','<>',$this->THONGSO_MOTA)->get()->toArray();
        $order_thongso_key =array();
        if(!empty($needindexs)) {
            foreach ($needindexs as $v) {
                $content .='<column id="thongso_'.$v['id'].'" style="font-weight: bold" type="ro" width="100" sort="int">'.$v['name'].'</column>';
                $order_thongso_key[] = $v['id'];
            }
        }

        $content .='<column style="font-weight: bold" type="ro" width="120" sort="int">Published</column>';
        $content .='<column style="font-weight: bold" type="ro" width="50" sort="int">Status</column>';
        $content .= '</head>';


        $baiviets = Baiviet::where('status','<>','DELETED')->get()->toArray();
        $arr_final =array();
        if(!empty($baiviets)){

            $idarr = array();
            $str_id ="(";
            foreach ($baiviets as $v){
                $idarr[] = $v['id'];
                $arr_final[$v['id']] = $v;

                $str_id .="'".$v['id']."',";
            }
            $str_id = substr($str_id,0,strlen($str_id)-1);
            $str_id .= ")";

//            var_dump($idarr);exit();
            $baiviet_indexs = Baivietindex::join('md_thongso', 'md_thongso.id', '=', 'op_baiviet_indexs.index_key')
                ->whereIn('op_baiviet_indexs.baivietID',$idarr)->where('op_baiviet_indexs.index_key','<>',$this->THONGSO_MOTA)->get()->toArray();
//            var_dump($baiviet_indexs);exit();
            if(!empty($baiviet_indexs)){
                foreach ($baiviet_indexs as $v){
                    $arr_final[$v['baivietID']][$v['index_key']]= $v['index_value'];
                }

            }

        }
//        var_dump($arr_final);exit();

        $no =1;
        foreach ($arr_final as $v){
//            var_dump($v);
            $content .=  '<row id="'.$v['id'].'">';
            $content .=  '<cell><![CDATA['.$no.']]></cell>';
            $mota = str_replace("\"","",$v['mo_ta']);
            $content .=  '<cell title="'.$mota.'"><![CDATA['.$v['tieu_de'].']]></cell>';
            foreach ($order_thongso_key as $kid){
                if(isset($v[$kid])){
                    $content .=  '<cell><![CDATA['.$v[$kid].']]></cell>';
                }else{
                    $content .=  '<cell><![CDATA[]]></cell>';
                }

            }
            $content .=  '<cell><![CDATA['.$v['published'].']]></cell>';
            $content .=  '<cell><![CDATA['.$v['status'].']]></cell>';
            $content .='</row>';
            $no++;
        }
        $content .=  '</rows>';

        return response($content)
            ->withHeaders([
                'Content-Type' => 'text/xml'
            ]);
//        return view('Admin\Baiviet.get_bai_viet')->header('Content-Type', 'text/xml')->with($datas);
    }
    public function get_bai_viet_edit()
    {

        $result =array(
            'result'=>false,
            'mess' =>''
        );
        $formData =  Request::all() ;
        if(!empty($formData['bvid'])){

            $bvid = $formData['bvid'];
            $baiviets = Baiviet::where('status','<>','DELETED')->where('id',$bvid)->limit(1)->get()->toArray();
            if(!empty($baiviets)){
                $result['result'] = true;
                $bv = $baiviets[0];
                $bv['thongso'] = json_decode($bv["thongso"]);
                $bv['token'] = csrf_token();
                $result["data"] = $bv;

            }else{
                $result['mess'] = "Không tìm thấy bài viết";
            }



        }else{
            $result['mess'] = "Không tìm thấy bài viết";
        }

        return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json'
        ]);
    }
    public function save_bai_viet(){


        $result =array(
            'result'=>false,
            'mess' =>''
        );



        if (Auth::check()) {
            // The user is logged in...

            $formData =  Request::all()['formData'] ;
            //var_dump($formData);exit();
            $tieude = "";
            $bvid = null;
            $mota = "";
            $thongso = array();
            $photo =array();
            foreach ($formData as $v){
                foreach ($v as $k=> $dt){
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
                        $photo[$k] = $dt;
                    }
                    if($k=="id"){
                        $bvid = $dt;
                    }

                }
            }

            $tieude = trim($tieude);
            if(!empty($tieude) && !empty($mota)){
                DB::beginTransaction();
                $bv = new Baiviet;

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
                    $result['mess'] = 'Đăng bài viết thành công!';
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
        return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json'
            ]);

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

    public function del_bai_viet(){

        $result =array(
            'result'=>false,
            'mess' =>''
        );



        if (Auth::check()) {
            $formData = Request::all();
            $bvid = $formData['baivietID'];
            $r = Baiviet::where('id',$bvid)->update(["status"=>"DELETED"]);
            if($r){
                $result['result'] = true;
                $result['mess'] = "Xóa bài viết thành công";
            }else{
                $result['mess'] = "Xóa không thành công, vui lòng thử lại!!";
            }


        }else{
            $result['mess'] ='Vui lòng đăng nhập để sử dụng chức năng này ';
        }
        return response($result)
            ->withHeaders([
            'Content-Type' => 'application/json'
        ]);

    }
}