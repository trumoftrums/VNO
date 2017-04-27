<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Baiviet extends Model
{
    protected $table = 'op_baiviets';
    protected $primaryKey = "id";
    public static function getListNew(){
        $list = Baiviet::where("status","<>","DELETED")->where("status","<>","PUBLIC")
            ->get()->select("id","photo1","photo2","photo3","photo4","photo5");
        return $list;
    }
}
