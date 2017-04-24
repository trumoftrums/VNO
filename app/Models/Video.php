<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'op_videos';

    const STATUS_ACTIVE = 'AC';
    const STATUS_INACTIVE = 'IA';
    const STATUS_DELETE = 'DE';
    public $timestamps = true;
    public static function getVideobyID($id)
    {
        $list = Video::where('status', '<>',Video::STATUS_DELETE)->where('id', $id)->select('op_videos.*','op_videos.id as videoID')->get()->toArray();
        if(!empty($list)){
            return $list[0];
        }
        return [];
    }
}
