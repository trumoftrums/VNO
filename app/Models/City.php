<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'op_city';

    const STATUS_ACTIVE = 'AC';
    const STATUS_INACTIVE = 'IA';
    const STATUS_DELETE = 'DE';

    public static function getCity()
    {
        $listCity = City::where('status', City::STATUS_ACTIVE)->get();
        return $listCity;
    }
    public static function getCitybyID($id)
    {
        $listCity = City::where('status', City::STATUS_ACTIVE)->where('id', $id)->get()->toArray();
        if(!empty($listCity)){
            return $listCity[0];
        }
        return [];
    }
}
