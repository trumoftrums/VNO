<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaiXe extends Model
{
    protected $table = 'op_bai_giu_xe';

    const STATUS_ACTIVE = 'AC';
    const STATUS_INACTIVE = 'IA';
    const STATUS_DELETE = 'DE';
    public static function getBaixebyID($id)
    {
        $list = BaiXe::where('status', '<>',BaiXe::STATUS_DELETE)->where('id', $id)->get()->toArray();
        if(!empty($list)){
            return $list[0];
        }
        return [];
    }
}
