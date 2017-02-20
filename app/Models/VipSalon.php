<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VipSalon extends Model
{
    protected $table = 'op_vip_salon';

    const STATUS_ACTIVE = 'AC';
    const STATUS_INACTIVE = 'IA';
    const STATUS_DELETE = 'DE';
}
