<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoEmbed extends Model
{
    protected $table = 'md_video_embed';

    const STATUS_ACTIVE = 'AC';
    const STATUS_INACTIVE = 'IA';
    const STATUS_DELETE = 'DE';
    public static function getEmbeds()
    {
        $list = VideoEmbed::where('status',VideoEmbed::STATUS_ACTIVE)->get()->toArray();

        return $list;
    }
}
