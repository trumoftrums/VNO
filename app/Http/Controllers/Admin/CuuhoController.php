<?php
namespace App\Http\Controllers\Admin;
use App\City;
use App\DesignCar;
use App\Http\Controllers\Controller;
use App\Models\Thongso;
use App\Models\Users;
use App\News;
use App\SupportCar;
use App\VipSalon;
use Illuminate\Support\Facades\Auth;
use App\Models\Baiviet;
use App\Models\Baivietindex;
use Request;
use App\Models\Thongtinxe;
use DB;
use App\Models\Groups;
class CuuhoController extends Controller {

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
        $content .='<column style="font-weight: bold" type="ro" width="100" sort="str">Last Updated</column>';
        $content .='<column style="font-weight: bold" type="ro" width="100" sort="str">Status</column>';
        $content .= '</head>';


        $arr_final = SupportCar::join('op_city', 'op_city.id', '=', 'op_support_car.cityID')
            ->where('op_support_car.status','<>',SupportCar::STATUS_DELETE)->select('op_support_car.*','op_city.city_name')->orderBy('op_support_car.updated_at', 'desc')->get()->toArray();
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
//            $content .=  '<cell><![CDATA['.$v['description'].']]></cell>';

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
    public function getinfo()
    {

        $result =array(
            'result'=>false,
            'mess' =>''
        );
        $formData =  Request::all() ;
        if(!empty($formData['id'])){

            $bvid = $formData['id'];
            $cuuho = SupportCar::getCuuhobyID($bvid);
            if(!empty($cuuho)){

                $result['result'] = true;
                $result['data'] = $cuuho;

            }else{
                $result['mess'] = "Không tìm thấy thông tin cứu hộ";
            }



        }else{
            $result['mess'] = "Không tìm thấy thông tin cứu hộ";
        }

        return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json'
        ]);
    }

    public function save(){


        $result =array(
            'result'=>false,
            'mess' =>''
        );

        $image_path = "uploads/users/";



            $formData =  Request::all()['formData'] ;

            $bv = new SupportCar();

            $bv->title = $formData['title'];
//            $bv->description = $formData['description'];
            $bv->address = $formData['address'];
            $bv->cityID = $formData['city'];

            $bv->city ="" ;
            $ct = City::getCitybyID($formData['city']);
            if(!empty($ct)){
                $bv->city =str_slug($ct['city_name'], '-');
            }
            $bv->phone = $formData['phone'];
//            $bv->images = $image_path.substr($formData['images'],strlen($formData['images'])-32,32);
            $bv->thumb = $image_path.substr($formData['thumb'],strlen($formData['thumb'])-32,32);

            $bv->status = SupportCar::STATUS_ACTIVE;

            $r = true;
            if(isset($formData['id']) && !empty($formData['id'])){
                $bvid = $formData['id'];
                $r = SupportCar::where('id',$bvid)->update($bv->toArray());
            }else{

                $r = $bv->save();
            }

            if($r){
                $result['result'] = true;
                $result['mess'] ='Lưu thành công!';
            }else{
                $result['mess'] ='Lỗi, vui lòng thử lại!';
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
        $r = SupportCar::where('id',$bvid)->update(["status"=>SupportCar::STATUS_DELETE]);
        if($r){
            $result['result'] = true;
            $result['mess'] = "Xóa thông tin cứu hộ thành công";
        }else{
            $result['mess'] = "Xóa không thành công, vui lòng thử lại!!";
        }



        return response($result)
            ->withHeaders([
            'Content-Type' => 'application/json'
        ]);

    }

}