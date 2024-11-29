<?php

namespace Models;

use Core\App;
use Core\Database;

class Student
{

    public static function findByUserId($id)
    {
        $db = App::resolve(Database::class);


        $cvs = $db->query('SELECT * FROM cvs WHERE user_id = ?', [$id])->get();

        return $cvs;
    }
}