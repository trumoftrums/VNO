<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesignCar extends Model
{
    protected $table = 'op_design_car';

    const STATUS_ACTIVE = 'AC';
    const STATUS_INACTIVE = 'IA';
    const STATUS_DELETE = 'DE';
}
