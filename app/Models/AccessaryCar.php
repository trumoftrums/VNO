<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessaryCar extends Model
{
    protected $table = 'op_accessary_car';

    const STATUS_ACTIVE = 'AC';
    const STATUS_INACTIVE = 'IA';
    const STATUS_DELETE = 'DE';
    public static function getAccessarybyID($id)
    {
        $list = AccessaryCar::where('status', '<>',AccessaryCar::STATUS_DELETE)->where('id', $id)->get()->toArray();
        if(!empty($list)){
            return $list[0];
        }
        return [];
    }
}
