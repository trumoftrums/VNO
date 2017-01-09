<?php
namespace App\Models;

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/27/2016
 * Time: 10:41 AM
 */
class Users extends UsersFactory
{
    protected $table = 'md_users';
    protected $primaryKey = 'id';
}