<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportCar extends Model
{
    protected $table = 'op_support_car';

    const STATUS_ACTIVE = 'AC';
    const STATUS_INACTIVE = 'IA';
    const STATUS_DELETE = 'DE';
    public static function getCuuhobyID($id)
    {
        $list = SupportCar::where('status', '<>',SupportCar::STATUS_DELETE)->where('id', $id)->get()->toArray();
        if(!empty($list)){
            return $list[0];
        }
        return [];
    }
}
