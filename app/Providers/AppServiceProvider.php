<?php

namespace App\Providers;

use App\City;
use App\Models\Baiviet;
use App\Models\Hangxe;
use App\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Models\Thongso;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('Layouts.frontend', function ($view)
        {
            $listNewsHome = News::where('status', News::STATUS_ACTIVE)
                ->orderBy('id', 'desc')
                ->limit(10)
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

//            var_dump($hangxes);exit();
            $view->with([
                'listNewsHome' => $listNewsHome,
                'user' => $user,
                'totalPost' => $totalPost,
                'list_thongso'=>$arr_listts,
                'hangxes' =>$hangxes,
                'listCity'=>$listCity
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
    }
    private  function get_total_baiviet(){
        $tt = Baiviet::where('status','<>','DELETED')->count();
        return $tt;
    }
    private  function get_total_news(){
        $tt = News::where('status','<>','DE')->count();
        return $tt;
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
