<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Thongso;
use App\News;
use Illuminate\Support\Facades\Auth;
use App\Models\Baiviet;
use App\Models\Baivietindex;
use Request;
use App\Models\Thongtinxe;
use DB;
class NewsController extends Controller {

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */

    public function index()
    {
        if(!Auth::check()){
            return Redirect::to("admin/login");
        }

        $info =  array(
            'title' =>'Admin DashBoard',
            'content' =>'This is admin dashboard page'
        );

        $datas = array(
            'name' =>'news',
            'info' => $info,
        );

        return view('Admin\News.index')->with($datas);
    }

    public function get_news()
    {
        $content = '<?xml version="1.0" encoding="iso-8859-1" ?>';
        $content .=  '<rows>';
        $content .=  '<head>';
        $content .='<column style="font-weight: bold" type="ro" width="50" sort="int">No</column>';
        $content .='<column style="font-weight: bold" type="img" width="150" sort="na">Ảnh</column>';
        $content .='<column style="font-weight: bold" type="ro" width="*" sort="str">Tiêu Đề</column>';
        $content .='<column style="font-weight: bold" type="ro" width="*" sort="str">Mô tả</column>';
        $content .='<column style="font-weight: bold" type="ro" width="150" sort="int">Ngày tạo</column>';
        $content .='<column style="font-weight: bold" type="ro" width="150" sort="int">Ngày sửa</column>';
        $content .='<column style="font-weight: bold" type="ro" width="100" sort="int">Status</column>';
        $content .= '</head>';


        $arr_final = News::where('status','<>','DE')->get()->toArray();
        $no =1;
        foreach ($arr_final as $v){
//            var_dump($v);
            $content .=  '<row id="'.$v['id'].'">';
            $content .=  '<cell><![CDATA['.$no.']]></cell>';
            $content .=  '<cell style="max-height: 60px !important;"><![CDATA['.$v['thumbnail'].']]></cell>';
            $content .=  '<cell><![CDATA['.$v['title'].']]></cell>';
            $content .=  '<cell><![CDATA['.$v['summary'].']]></cell>';
            $content .=  '<cell><![CDATA['.$v['created_at'].']]></cell>';
            $content .=  '<cell><![CDATA['.$v['updated_at'].']]></cell>';
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
    public function save_news(){


        $result =array(
            'result'=>false,
            'mess' =>''
        );



        if (Auth::check()) {
            // The user is logged in...

            $formData =  Request::all()['formData'] ;
            debug($formData);exit();
            $bv = new News();

            $bv->status = "AC";
            $bv->userid = Auth::id();
            $r1 = $bv->save();

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
    public function pub_bai_viet(){

        $result =array(
            'result'=>false,
            'mess' =>''
        );



        if (Auth::check()) {
            $formData = Request::all();
            $bvid = $formData['baivietID'];
            $ck =  Baiviet::where('id',$bvid)->get()->toArray();
            if(!empty($ck)){
                $bv = $ck[0];
                if($bv['status']!="PUBLIC"){
                    $r = Baiviet::where('id',$bvid)->update(["status"=>"PUBLIC","published"=>date("Y-m-d H:i:s")]);
                    if($r){
                        $result['result'] = true;
                        $result['mess'] = "Public bài viết thành công";
                    }else{
                        $result['mess'] = "Public không thành công, vui lòng thử lại!!";
                    }
                }else{
                    $result['mess'] = "Bài viết này đã public rồi!!!";
                }

            }else{
                $result['mess'] = "Bài viết không tồn tại!!";
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