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
        $datas=array();
//        $datas = Baiviet::all()->limit(50);
//        $datas = Baiviet::limit(50)->get();


        $content = '<?xml version="1.0" encoding="iso-8859-1" ?>';
        $content .=  '<rows>';
        $content .=  '<head>
            <column style="font-weight: bold" type="ro" width="50" sort="int">
                No
            </column>
            <column style="font-weight: bold" type="ro" width="300" sort="str">
                Tên bài viết
            </column>
            <column style="font-weight: bold" type="ro" width="*" sort="str">
                Mô tả
            </column>
            <column style="font-weight: bold" type="ro" width="150" sort="str">
                Ngày đăng
            </column>
            <column style="font-weight: bold" type="ro" width="80" sort="str">
                Trạng thái
            </column>
        </head>';
        $no =1;
        foreach ($datas as $v){
            $content .=  '<row id="'.$v->id.'">';
            $content .=  '<cell><![CDATA['.$no.']]></cell>';
            $content .=  '<cell><![CDATA['.$v->tieu_de.']]></cell>';
            $content .=  '<cell><![CDATA['.$v->mo_ta.']]></cell>';
            $content .=  '<cell><![CDATA['.$v->published.']]></cell>';
            $content .=  '<cell><![CDATA['.$v->status.']]></cell>';
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

    public function save_bai_viet(Request $request){


        $result =array(
            'result'=>false,
            'mess' =>''
        );



        if (Auth::check()) {
            // The user is logged in...

            $formData =  Request::all()['formData'] ;
//        var_dump($formData);exit();
            $thongso = array();
            foreach ($formData as $v){
                foreach ($v as $k=> $dt){
                    $thongso[$k] = $dt;
                }
            }
            DB::beginTransaction();
            $bv = new Baiviet;
            $bv->userid = Auth::id();
            $bv->tieu_de = 'Leonardo de Vinci';
            $bv->thongso = json_encode($thongso);
            $r1 = $bv->save();

            //get thongso need index
//            $needindexs = Thongso::select('id','name')->where('md_thongso.status',1)->where('md_thongso.need_index',1)->get()->toArray();
            if($r1){
                $r2 = true;
                $needindexs = DB::table('md_thongso')->where('md_thongso.status',1)->where('md_thongso.need_index',1)->pluck('id')->toArray();
                if(!empty($needindexs)){
                    foreach ($thongso as $k => $v){
                        $arrk = explode("_",$k);
                        if(count($arrk)==2 && in_array($arrk[1],$needindexs)){
                            $save_index = new Baivietindex;
                            $save_index->baivietID = $bv->id;
                            $save_index->author = Auth::id();
                            $save_index->index_key = $arrk[1];
                            $save_index->index_key_str = $k;
                            $save_index->index_value = $v;
                            $r2 = $save_index->save();
                            if(!$r2){
                                DB::rollback();
                                break;
                            }
                        }

                    }
                }
            }
            if($r1 && $r2) {
                DB::commit();
                $result['result'] = true;
            }else{
                DB::rollback();
                $result['mess'] = 'Có lỗi xảy ra, vui lòng thử lại sau ít phút!';
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