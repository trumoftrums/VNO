<?php

namespace App\Providers;

use App\City;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\Baiviet;
use App\Models\Hangxe;
use App\Models\Users;
use App\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\ServiceProvider;
use App\Models\Thongso;
use App\Models\ViewLog;
use Mockery\CountValidator\Exception;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    const COUNTUSER_START = 3000;
    const COUNTVIEW_START = 31200;
    public static function isMobile()
    {
        $uaFull = strtolower($_SERVER['HTTP_USER_AGENT']);
        $uaStart = substr($uaFull, 0, 4);

        $uaPhone = [ // use `= array(` if PHP<5.4
            '(android|bb\d+|meego).+mobile',
            'avantgo',
            'bada\/',
            'blackberry',
            'blazer',
            'compal',
            'elaine',
            'fennec',
            'hiptop',
            'iemobile',
            'ip(hone|od)',
            'iris',
            'kindle',
            'lge ',
            'maemo',
            'midp',
            'mmp',
            'mobile.+firefox',
            'netfront',
            'opera m(ob|in)i',
            'palm( os)?',
            'phone',
            'p(ixi|re)\/',
            'plucker',
            'pocket',
            'psp',
            'series(4|6)0',
            'symbian',
            'treo',
            'up\.(browser|link)',
            'vodafone',
            'wap',
            'windows ce',
            'xda',
            'xiino'
        ]; // use `);` if PHP<5.4

        $uaMobile = [ // use `= array(` if PHP<5.4
            '1207',
            '6310',
            '6590',
            '3gso',
            '4thp',
            '50[1-6]i',
            '770s',
            '802s',
            'a wa',
            'abac|ac(er|oo|s\-)',
            'ai(ko|rn)',
            'al(av|ca|co)',
            'amoi',
            'an(ex|ny|yw)',
            'aptu',
            'ar(ch|go)',
            'as(te|us)',
            'attw',
            'au(di|\-m|r |s )',
            'avan',
            'be(ck|ll|nq)',
            'bi(lb|rd)',
            'bl(ac|az)',
            'br(e|v)w',
            'bumb',
            'bw\-(n|u)',
            'c55\/',
            'capi',
            'ccwa',
            'cdm\-',
            'cell',
            'chtm',
            'cldc',
            'cmd\-',
            'co(mp|nd)',
            'craw',
            'da(it|ll|ng)',
            'dbte',
            'dc\-s',
            'devi',
            'dica',
            'dmob',
            'do(c|p)o',
            'ds(12|\-d)',
            'el(49|ai)',
            'em(l2|ul)',
            'er(ic|k0)',
            'esl8',
            'ez([4-7]0|os|wa|ze)',
            'fetc',
            'fly(\-|_)',
            'g1 u',
            'g560',
            'gene',
            'gf\-5',
            'g\-mo',
            'go(\.w|od)',
            'gr(ad|un)',
            'haie',
            'hcit',
            'hd\-(m|p|t)',
            'hei\-',
            'hi(pt|ta)',
            'hp( i|ip)',
            'hs\-c',
            'ht(c(\-| |_|a|g|p|s|t)|tp)',
            'hu(aw|tc)',
            'i\-(20|go|ma)',
            'i230',
            'iac( |\-|\/)',
            'ibro',
            'idea',
            'ig01',
            'ikom',
            'im1k',
            'inno',
            'ipaq',
            'iris',
            'ja(t|v)a',
            'jbro',
            'jemu',
            'jigs',
            'kddi',
            'keji',
            'kgt( |\/)',
            'klon',
            'kpt ',
            'kwc\-',
            'kyo(c|k)',
            'le(no|xi)',
            'lg( g|\/(k|l|u)|50|54|\-[a-w])',
            'libw',
            'lynx',
            'm1\-w',
            'm3ga',
            'm50\/',
            'ma(te|ui|xo)',
            'mc(01|21|ca)',
            'm\-cr',
            'me(rc|ri)',
            'mi(o8|oa|ts)',
            'mmef',
            'mo(01|02|bi|de|do|t(\-| |o|v)|zz)',
            'mt(50|p1|v )',
            'mwbp',
            'mywa',
            'n10[0-2]',
            'n20[2-3]',
            'n30(0|2)',
            'n50(0|2|5)',
            'n7(0(0|1)|10)',
            'ne((c|m)\-|on|tf|wf|wg|wt)',
            'nok(6|i)',
            'nzph',
            'o2im',
            'op(ti|wv)',
            'oran',
            'owg1',
            'p800',
            'pan(a|d|t)',
            'pdxg',
            'pg(13|\-([1-8]|c))',
            'phil',
            'pire',
            'pl(ay|uc)',
            'pn\-2',
            'po(ck|rt|se)',
            'prox',
            'psio',
            'pt\-g',
            'qa\-a',
            'qc(07|12|21|32|60|\-[2-7]|i\-)',
            'qtek',
            'r380',
            'r600',
            'raks',
            'rim9',
            'ro(ve|zo)',
            's55\/',
            'sa(ge|ma|mm|ms|ny|va)',
            'sc(01|h\-|oo|p\-)',
            'sdk\/',
            'se(c(\-|0|1)|47|mc|nd|ri)',
            'sgh\-',
            'shar',
            'sie(\-|m)',
            'sk\-0',
            'sl(45|id)',
            'sm(al|ar|b3|it|t5)',
            'so(ft|ny)',
            'sp(01|h\-|v\-|v )',
            'sy(01|mb)',
            't2(18|50)',
            't6(00|10|18)',
            'ta(gt|lk)',
            'tcl\-',
            'tdg\-',
            'tel(i|m)',
            'tim\-',
            't\-mo',
            'to(pl|sh)',
            'ts(70|m\-|m3|m5)',
            'tx\-9',
            'up(\.b|g1|si)',
            'utst',
            'v400',
            'v750',
            'veri',
            'vi(rg|te)',
            'vk(40|5[0-3]|\-v)',
            'vm40',
            'voda',
            'vulc',
            'vx(52|53|60|61|70|80|81|83|85|98)',
            'w3c(\-| )',
            'webc',
            'whit',
            'wi(g |nc|nw)',
            'wmlb',
            'wonu',
            'x700',
            'yas\-',
            'your',
            'zeto',
            'zte\-'
        ]; // use `);` if PHP<5.4

        $isPhone = preg_match('/' . implode($uaPhone, '|') . '/i', $uaFull);
        $isMobile = preg_match('/' . implode($uaMobile, '|') . '/i', $uaStart);

        if($isPhone || $isMobile) {
            return true;
        } else {
            return false;
        }
    }

    public function boot()
    {
        if (self::isMobile()) {
            header('Location: http://m.vietnamoto.net/');
            exit;
        }

        view()->composer('Layouts.frontend', function ($view)
        {
            try{
                $this->saveLog();
            }catch ( Exception $e){

            }

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
    private function saveLog(){
        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if(strpos($actual_link,"/uploads/") === false){
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
