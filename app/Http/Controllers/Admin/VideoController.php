<?php
namespace App\Http\Controllers\Admin;
use App\BaiXe;
use App\City;
use App\Http\Controllers\Controller;
use App\Video;
use App\VideoCat;
use App\VideoEmbed;
use App\VideoEmbedParam;
use Illuminate\Support\Facades\Auth;
use Request;
use DB;

class VideoController extends Controller {

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    private $user ;
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
        if(empty($user) || $user->group!=1){
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
        $content .='<column style="font-weight: bold" type="ro" width="150" sort="na">Category</column>';
        $content .='<column style="font-weight: bold" type="ro" width="150" sort="str">Source</column>';
        $content .='<column style="font-weight: bold" type="ro" width="150" sort="str">URL</column>';
        $content .='<column style="font-weight: bold" type="ro" width="100" sort="str">Title</column>';
        $content .='<column style="font-weight: bold" type="ro" width="150" sort="str">Description</column>';
        $content .='<column style="font-weight: bold" type="ro" width="100" sort="str">Uploaded by</column>';
        $content .='<column style="font-weight: bold" type="ro" width="100" sort="str">Uploaded Datetime</column>';
        $content .='<column style="font-weight: bold" type="ro" width="100" sort="str">Status</column>';
        $content .= '</head>';


        $arr_final = DB::table("op_videos")->join('op_video_cat', 'op_videos.catID', '=', 'op_video_cat.id')
            ->join('md_video_embed', 'op_videos.embedID', '=', 'md_video_embed.id')
            ->where('op_videos.status',Video::STATUS_ACTIVE)
            ->where('op_video_cat.status',VideoCat::STATUS_ACTIVE)
            ->where('md_video_embed.status',VideoEmbed::STATUS_ACTIVE)
            ->select('op_videos.id as videoID','op_videos.*','op_video_cat.*','md_video_embed.*')->orderBy('op_videos.updated_at', 'desc')->get()->toArray();
//        var_dump($arr_final);exit();

        $no =1;
        foreach ($arr_final as $v){
//            var_dump($v);
            $content .=  '<row id="'.$v->videoID.'">';
            $content .=  '<cell><![CDATA['.$no.']]></cell>';
            $content .=  '<cell><![CDATA['.$v->catName.']]></cell>';
            $content .=  '<cell><![CDATA['.$v->name.']]></cell>';
            $content .=  '<cell><![CDATA['.$v->url.']]></cell>';
            $content .=  '<cell><![CDATA['.$v->title.']]></cell>';
            $content .=  '<cell><![CDATA['.$v->description.']]></cell>';
            $content .=  '<cell><![CDATA['.$v->userID.']]></cell>';
            $content .=  '<cell><![CDATA['.$v->updated_at.']]></cell>';
            $content .=  '<cell><![CDATA['.$v->status.']]></cell>';
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

            $id = $formData['id'];
            $bx = Video::getVideobyID($id);
            if(!empty($bx)){

                $result['result'] = true;
                $result['data'] = $bx;

            }else{
                $result['mess'] = "Không tìm thấy video";
            }



        }else{
            $result['mess'] = "Không tìm thấy video";
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

        $formData =  Request::all()['formData'] ;

        $bv = new Video();

        $bv->title = $formData['title'];
        $bv->description = $formData['description'];
        $bv->catID = $formData['catID'];
        $bv->embedID = $formData['embedID'];
        if(!empty($formData['vID'])){
            $bv->vID = $formData['vID'];
        }else{
            $arrurl = explode("?v=",$formData['url']);
            if(count($arrurl)==2){
                $bv->vID = substr($arrurl[1],0,11);
            }
        }

        $bv->url = $formData['url'];
        $bv->keyword = $formData['keyword'];
        $bv->status = Video::STATUS_ACTIVE;
        $user = Auth::user();
        $bv->userID =$user->id;
        if($bv->embedID == 1) {//YOUTUBE
            $arr = array(
                'WIDTH'=>'90%',
                'HEIGHT' =>'90%',
                'VID' =>$bv->vID
            );
            $bv->embedParams = json_encode($arr);


        }

        $r = true;


        if(isset($formData['id']) && !empty($formData['id'])){
            $id = $formData['id'];
            $r = Video::where('id',$id)->update($bv->toArray());
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
        $r = Video::where('id',$bvid)->update(["status"=>Video::STATUS_DELETE]);
        if($r){
            $result['result'] = true;
            $result['mess'] = "Xóa video thành công";
        }else{
            $result['mess'] = "Xóa không thành công, vui lòng thử lại!!";
        }



        return response($result)
            ->withHeaders([
            'Content-Type' => 'application/json'
        ]);

    }

}