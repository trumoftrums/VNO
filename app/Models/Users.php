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
    public static function getUsers()
    {
        $list = Users::where('status','Actived')->get()->toArray();

        return $list;
    }
    public static function getUserbyPhone($phone)
    {
        $list = Users::where('status','Actived')->where('phone',$phone)->get()->toArray();
        if(!empty($list)){
            return $list[0];
        }
        return [];
    }
    public static function setPassword($phone,$password)
    {
        $list = Users::where('phone',$phone)->update(['password'=>$password]);
        return $list;
    }
}