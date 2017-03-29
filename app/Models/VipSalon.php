<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VipSalon extends Model
{
    protected $table = 'op_vip_salon';

    const STATUS_ACTIVE = 'AC';
    const STATUS_INACTIVE = 'IA';
    const STATUS_DELETE = 'DE';
    public static function getSalonbyID($id)
    {
        $list = VipSalon::where('status', '<>',City::STATUS_DELETE)->where('id', $id)->get()->toArray();
        if(!empty($list)){
            return $list[0];
        }
        return [];
    }
}
