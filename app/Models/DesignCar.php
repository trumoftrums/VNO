<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesignCar extends Model
{
    protected $table = 'op_design_car';

    const STATUS_ACTIVE = 'AC';
    const STATUS_INACTIVE = 'IA';
    const STATUS_DELETE = 'DE';
    public static function getSuaxebyID($id)
    {
        $list = DesignCar::where('status', '<>',DesignCar::STATUS_DELETE)->where('id', $id)->get()->toArray();
        if(!empty($list)){
            return $list[0];
        }
        return [];
    }
}
