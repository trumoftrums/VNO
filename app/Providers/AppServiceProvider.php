<?php

namespace App\Providers;

use App\BaiXe;
use App\City;
use App\DesignCar;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\Baiviet;
use App\Models\Hangxe;
use App\Models\Users;
use App\News;
use App\SupportCar;
use App\VipSalon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\ServiceProvider;
use App\Models\Thongso;
use App\Models\ViewLog;
use Mockery\CountValidator\Exception;
use App\Models\Groups;
use App\Models\AdminPermission;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    const COUNTUSER_START = 3000;
    const COUNTVIEW_START = 31200;
    public function boot()
    {
        view()->composer('Layouts.frontend', function ($view)
        {
            try{
                $this->saveLog();
            }catch ( Exception $e){

            }

            $listNewsHome = News::where('status', News::STATUS_ACTIVE)
                ->orderBy('id', 'desc')
                ->limit(20)
                ->get();
            $totalPost = 0;
            $user = [];
            if(Auth::check()){
                $user = Auth::user();
                $totalPost = Baiviet::where('userid', $user->id)->where('status','<>','DELETED')->count();
            }
            $list_thongso = Thongso::where('filter',1)->get()->toArray();
            $arr_listts = array();
            foreach($list_thongso as $v){
                $arr_listts["thongso_".$v['id']] = $v;
            }
//            var_dump($arr_listts);exit();

            $listHangXe =  Hangxe::where('status',1)->get()->toArray();
            $hangxes = array();
            if(!empty($listHangXe)){
                foreach ($listHangXe as $hx){
                    $hangxes[$hx['id']]=$hx['hang_xe'];
                }
            }
            //list city
            $listCity =  City::getCity()->toArray();

            $countUser = self::COUNTUSER_START + Users::where("status","Actived")->count();
            $countView = self::COUNTVIEW_START + ViewLog::count();
            $view->with([
                'listNewsHome' => $listNewsHome,
                'user' => $user,
                'totalPost' => $totalPost,
                'list_thongso'=>$arr_listts,
                'hangxes' =>$hangxes,
                'listCity'=>$listCity,
                'countUser'=>$countUser,
                'countView'=>$countView
            ]);
        });
        view()->composer('Layouts.backend', function ($view)
        {

            $user = [];
            if(Auth::check()){
                $user = Auth::user();

            }

            $tt = $this->get_total_baiviet();
            $ttn = $this->get_total_news();
            $view->with([
                'user' => $user,
                'tt_baiviet' => $tt,
                'tt_news'=>$ttn
            ]);
        });
        view()->composer('Admin.Dashboard.index', function ($view)
        {

            $user = [];
            if(Auth::check()){
                $user = Auth::user();

            }
            $listHangXe =  Hangxe::where('status',1)->get()->toArray();
            $hangxes = array();
            if(!empty($listHangXe)){
                foreach ($listHangXe as $hx){
                    $hangxes[$hx['id']]=$hx['hang_xe'];
                }
            }
            //list city
            $listCity =  City::getCity()->toArray();
            $tt = $this->get_total_baiviet();
            $ttn = $this->get_total_news();
            $ttsl = $this->get_total_salons();
            $ttch = $this->get_total_cuuho();
            $ttgx = $this->get_total_giuxe();
            $ttsx = $this->get_total_suaxe();
            $listUsers = Users::getUsers();

            $menuPermission = array();
            $arr_permission = AdminPermission::getPerbyUser($user->id);
            if(!empty($arr_permission)){
                $menuPermission = json_decode($arr_permission['menuID'],true);
            }
//            var_dump($listUsers);exit();
            $groups = Groups::where("status","=","Actived")->get()->toArray();
            $view->with([
                'user' => $user,
                'tt_baiviet' => $tt,
                'tt_news'=>$ttn,
                'tt_salons'=>$ttsl,
                'tt_cuuhos'=>$ttch,
                'tt_giuxes'=>$ttgx,
                'tt_suaxes'=>$ttsx,
                'hangxes' =>$hangxes,
                'listCity'=>$listCity,
                'groups'=>$groups,
                'listUsers' =>$listUsers,
                'menuPermission'=>$menuPermission
            ]);
//            var_dump($menuPermission);exit();
        });
    }
    private  function get_total_baiviet(){
        $tt = Baiviet::where('status','<>','DELETED')->count();
        return $tt;
    }
    private  function get_total_news(){
        $tt = News::where('status','<>','DE')->count();
        return $tt;
    }
    private  function get_total_salons(){
        $tt = VipSalon::where('status','<>','DE')->count();
        return $tt;
    }
    private  function get_total_cuuho(){
        $tt = SupportCar::where('status','<>','DE')->count();
        return $tt;
    }
    private  function get_total_suaxe(){
        $tt = DesignCar::where('status','<>','DE')->count();
        return $tt;
    }
    private  function get_total_giuxe(){
        $tt = BaiXe::where('status','<>','DE')->count();
        return $tt;
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
    private $SKIP_LOG =array(".js",".png",".gif",".jpg",".css",".map");
    private function saveLog(){
        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $last3 = strtolower(substr($actual_link,strlen($actual_link)-3,3));
        $last4 = strtolower(substr($actual_link,strlen($actual_link)-4,4));

        if(strpos($actual_link,"/uploads/") === false && !in_array($last3,$this->SKIP_LOG) && !in_array($last4,$this->SKIP_LOG)){
            $l =  new ViewLog;
            $l->ip =$this->get_client_ip();

            $l->url = $actual_link;
            if(isset($_SERVER['HTTP_REFERER'])){
                $l->refer_url = $_SERVER['HTTP_REFERER'];
            }
            if(isset($_SERVER['HTTP_USER_AGENT'])){
                $l->user_agent = $_SERVER['HTTP_USER_AGENT'];
            }

            $l->save();
        }

    }
    protected function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}
