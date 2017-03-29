<?php
namespace App\Http\Controllers\Admin;
use App\City;
use App\Http\Controllers\Controller;
use App\Models\Thongso;
use App\Models\Users;
use App\News;
use App\VipSalon;
use Illuminate\Support\Facades\Auth;
use App\Models\Baiviet;
use App\Models\Baivietindex;
use Request;
use App\Models\Thongtinxe;
use DB;
use App\Models\Groups;
class SalonController extends Controller {

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */

    public function __construct()
    {
        if(!Auth::check()){
            $result =array(
                'result' =>false,
                'mess' =>'Please login to use this function'
            );
            return response($result)
                ->withHeaders([
                    'Content-Type' => 'application/json'
                ]);
        }
        $user = Auth::user();
        if($user->group!=1){
            $result =array(
                'result' =>false,
                'mess' =>'You do not have permission to access this function'
            );
            return response($result)
                ->withHeaders([
                    'Content-Type' => 'application/json'
                ]);
        }
    }
    public function get()
    {
        $content = '<?xml version="1.0" encoding="iso-8859-1" ?>';
        $content .=  '<rows>';
        $content .=  '<head>';
        $content .='<column style="font-weight: bold" type="ro" width="50" sort="int">No</column>';
        $content .='<column style="font-weight: bold" type="img" width="150" sort="na">Thumbnail</column>';
        $content .='<column style="font-weight: bold" type="ro" width="150" sort="str">Name</column>';
        $content .='<column style="font-weight: bold" type="ro" width="150" sort="str">Address</column>';
        $content .='<column style="font-weight: bold" type="ro" width="100" sort="str">City</column>';
        $content .='<column style="font-weight: bold" type="ro" width="150" sort="str">Phone</column>';
        $content .='<column style="font-weight: bold" type="ro" width="*" sort="str">Description</column>';

        $content .='<column style="font-weight: bold" type="ro" width="100" sort="str">Last Updated</column>';
        $content .='<column style="font-weight: bold" type="ro" width="100" sort="str">Status</column>';
        $content .= '</head>';


        $arr_final = VipSalon::join('op_city', 'op_city.id', '=', 'op_vip_salon.cityID')
            ->where('op_vip_salon.status','<>','DE')->select('op_vip_salon.*','op_city.city_name')->orderBy('op_vip_salon.updated_at', 'desc')->get()->toArray();
//        var_dump($arr_final);exit();

        $no =1;
        foreach ($arr_final as $v){
//            var_dump($v);
            $content .=  '<row id="'.$v['id'].'">';
            $content .=  '<cell><![CDATA['.$no.']]></cell>';
            $content .=  '<cell style="max-height: 60px !important;"><![CDATA[../'.$v['thumb'].']]></cell>';
            $content .=  '<cell><![CDATA['.$v['title'].']]></cell>';
            $content .=  '<cell><![CDATA['.$v['address'].']]></cell>';
            $content .=  '<cell><![CDATA['.$v['city_name'].']]></cell>';
            $content .=  '<cell><![CDATA['.$v['phone'].']]></cell>';
            $content .=  '<cell><![CDATA['.$v['description'].']]></cell>';

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
    }
    public function getsaloninfo()
    {

        $result =array(
            'result'=>false,
            'mess' =>''
        );
        $formData =  Request::all() ;
        if(!empty($formData['id'])){

            $bvid = $formData['id'];
            $salon = VipSalon::getSalonbyID($bvid);
            if(!empty($salon)){

                $result['result'] = true;
                $result['data'] = $salon;

            }else{
                $result['mess'] = "Không tìm thấy salon";
            }



        }else{
            $result['mess'] = "Không tìm thấy salon";
        }

        return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json'
        ]);
    }

    public function save_salon(){


        $result =array(
            'result'=>false,
            'mess' =>''
        );

        $image_path = "uploads/users/";

        if (Auth::check()) {
            // The user is logged in...

            $formData =  Request::all()['formData'] ;

            $bv = new VipSalon();

            $bv->user_id = $formData['user_id'];
            $bv->title = $formData['title'];
            $bv->description = $formData['description'];
            $bv->address = $formData['address'];
            $bv->cityID = $formData['city'];

            $bv->city ="" ;
            $ct = City::getCitybyID($formData['city']);
            if(!empty($ct)){
                $bv->city =str_slug($ct['city_name'], '-');
            }
            $bv->phone = $formData['phone'];
            $bv->images = $image_path.substr($formData['images'],strlen($formData['images'])-32,32);
            $bv->thumb = $image_path.substr($formData['thumb'],strlen($formData['thumb'])-32,32);

            $bv->status = "AC";

            $r = true;
            if(isset($formData['id']) && !empty($formData['id'])){
                $bvid = $formData['id'];
                $r = VipSalon::where('id',$bvid)->update($bv->toArray());
            }else{

                $r = $bv->save();
            }

            if($r){
                $result['result'] = true;
                $result['mess'] ='Lưu thành công!';
            }else{
                $result['mess'] ='Lỗi, vui lòng thử lại!';
            }



        }else{
            $result['mess'] ='Vui lòng đăng nhập để sử dụng chức năng này ';
        }
        return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json'
            ]);

    }


    public function delete(){

        $result =array(
            'result'=>false,
            'mess' =>''
        );




        $formData = Request::all();
        $bvid = $formData['id'];
        $r = VipSalon::where('id',$bvid)->update(["status"=>VipSalon::STATUS_DELETE]);
        if($r){
            $result['result'] = true;
            $result['mess'] = "Xóa salon thành công";
        }else{
            $result['mess'] = "Xóa không thành công, vui lòng thử lại!!";
        }



        return response($result)
            ->withHeaders([
            'Content-Type' => 'application/json'
        ]);

    }

}