<?php namespace App\Http\Controllers\Frontend;

use App\DesignCar;
use App\Http\Controllers\Controller;
use App\Models\Baiviet;
use App\Models\Users;
use  App\RaoVat;
use App\SupportCar;
use App\VipSalon;
use Illuminate\Support\Facades\Input;

class ServiceController extends Controller {

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {

    }

    public function supportCar($city)
    {
        $listSupportCar = SupportCar::where('status', SupportCar::STATUS_ACTIVE)
            ->OrderBy('id', 'desc')
            ->paginate(16);
        if ($city) {
            if($city != 'all'){
                $listSupportCar = SupportCar::where('status', SupportCar::STATUS_ACTIVE)
                    ->OrderBy('id', 'desc')
                    ->where('city', $city)
                    ->paginate(16);
            }
        }

        return View('Service.list-support-car', [
            'listSupportCar' => $listSupportCar,
            'city' => $city
        ]);
    }

    public function designCar($city)
    {
        $listDesignCar = DesignCar::where('status', DesignCar::STATUS_ACTIVE)
            ->OrderBy('id', 'desc')
            ->paginate(16);
        if ($city) {
            if($city != 'all'){
                $listDesignCar = DesignCar::where('status', DesignCar::STATUS_ACTIVE)
                    ->OrderBy('id', 'desc')
                    ->where('city', $city)
                    ->paginate(16);
            }
        }
        return View('Service.list-design-car', [
            'listDesignCar' => $listDesignCar,
            'city' => $city
        ]);
    }

    public function designCarDetail($id)
    {
        $res = DesignCar::where('op_design_car.id', $id)->first();
        return View('Service.detail-design-car', [
            'detailDesignCar' => $res
        ]);
    }

    public function vipSalon($city)
    {
        $listVipSalon = VipSalon::where('status', VipSalon::STATUS_ACTIVE)
            ->OrderBy('id', 'desc')
            ->paginate(16);
        if ($city) {
            if($city != 'all'){
                $listVipSalon = VipSalon::where('status', VipSalon::STATUS_ACTIVE)
                    ->OrderBy('id', 'desc')
                    ->where('city', $city)
                    ->paginate(16);
            }
        }
        return View('Service.list-salon-car', [
            'listVipSalon' => $listVipSalon,
            'city' => $city
        ]);
    }

    public function vipSalonDetail($id)
    {
        $active_tab2 = Input::get('page', '');
        $res = VipSalon::where('op_vip_salon.id', $id)->first();
        $listPost = Baiviet::where('userid', $res->user_id)->paginate(HomeController::POST_PER_PAGE);;
        foreach ($listPost as $item){
            $item->thongso = json_decode($item->thongso,true);
        }
        return View('Service.detail-vip-salon', [
            'detailVipSalon' => $res,
            'listPost' => $listPost,
            'activeTab' => $active_tab2
        ]);
    }

}