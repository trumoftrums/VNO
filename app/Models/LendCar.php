<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LendCar extends Model
{
    protected $table = 'op_lend_car';

    const STATUS_ACTIVE = 'AC';
    const STATUS_INACTIVE = 'IA';
    const STATUS_DELETE = 'DE';
    public static function getCuuhobyID($id)
    {
        $list = LendCar::where('status', '<>',LendCar::STATUS_DELETE)->where('id', $id)->get()->toArray();
        if(!empty($list)){
            return $list[0];
        }
        return [];
    }
}
