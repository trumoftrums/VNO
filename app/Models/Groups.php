<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Groups extends Authenticatable
{
    const GROUP_VIP_SALON = 3;
    const ADMIN = 1;
    const AUTHOR = 2;
    protected $table = 'md_groups';

}