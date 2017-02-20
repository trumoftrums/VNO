<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Users extends Authenticatable
{
    use Notifiable;

    const GROUP_VIP_SALON = 3;
    const ADMIN = 1;
    const AUTHOR = 2;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'md_users';
    protected $fillable = [
        'username', 'status', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}