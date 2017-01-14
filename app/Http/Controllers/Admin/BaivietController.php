<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Request;
use App\Models\Baiviet;
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
                'Content-Type' => 'text/xml',
                'X-Header-One' => 'Header Value',
                'X-Header-Two' => 'Header Value',
            ]);
//        return view('Admin\Baiviet.get_bai_viet')->header('Content-Type', 'text/xml')->with($datas);
    }
}