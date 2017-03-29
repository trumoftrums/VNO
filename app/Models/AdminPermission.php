<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminPermission extends Model
{
    protected $table = 'op_admin_permission';
    const STATUS_ACTIVE = 'AC';
    const STATUS_INACTIVE = 'IA';

    public static function getPerbyUser($id)
    {
        $list = AdminPermission::where('status',AdminPermission::STATUS_ACTIVE)->where('userid', $id)->get()->toArray();
        if(!empty($list)){
            return $list[0];
        }
        return [];
    }
}
