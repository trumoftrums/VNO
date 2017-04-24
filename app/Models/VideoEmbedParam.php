<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoEmbedParam extends Model
{
    protected $table = 'md_embed_params';

    const STATUS_ACTIVE = 'AC';
    const STATUS_INACTIVE = 'IA';
    const STATUS_DELETE = 'DE';
    public static function getCodesbyEmbedID($id)
    {
        $list = VideoEmbedParam::where('status',VideoEmbedParam::STATUS_ACTIVE)->where('embedID',$id)
            ->get()->toArray();
        if(!empty($list)){
            return $list[0];
        }
        return $list;
    }
}
