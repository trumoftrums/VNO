<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Nhomthongso extends Model
{
    protected $table = 'md_nhom_thongso';

    public function relatedThongso()
    {
        return $this->hasMany('App\Models\Thongso','id','group')->select('id', 'name');

    }
}
