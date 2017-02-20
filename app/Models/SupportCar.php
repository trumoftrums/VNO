<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportCar extends Model
{
    protected $table = 'op_support_car';

    const STATUS_ACTIVE = 'AC';
    const STATUS_INACTIVE = 'IA';
    const STATUS_DELETE = 'DE';
}
