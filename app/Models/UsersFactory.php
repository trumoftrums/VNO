<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/27/2016
 * Time: 10:43 AM
 */
abstract class UsersFactory extends Model
{
    public static function addUser($params)
    {
        $dataUser = [
            'username' => $params['phone'],
            'phone' => $params['phone'],
            'email' => null,
            'status' => 'Actived',
            'password' => bcrypt($params['password']),
            'group' => 2
        ];
        Users::insert($dataUser);
    }
}