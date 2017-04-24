<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoCat extends Model
{
    protected $table = 'op_video_cat';

    const STATUS_ACTIVE = 'AC';
    const STATUS_INACTIVE = 'IA';
    const STATUS_DELETE = 'DE';
    public static function getCats()
    {
        $list = VideoCat::where('status',VideoCat::STATUS_ACTIVE)->get()->toArray();

        return $list;
    }
}
