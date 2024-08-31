<?php

namespace Models;

use Core\App;
use Core\Database;

class User
{
    public static function find($email)
    {
        $db = App::resolve(Database::class);


        $user = $db->query('SELECT * FROM users WHERE email = ?', [$email])->find();

        return $user;
    }
}