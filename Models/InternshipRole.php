<?php

namespace Models;

use Core\App;
use Core\Database;

class InternshipRole
{
    public static function getAll()
    {
        $db = App::resolve(Database::class);
        return $db->query('SELECT * FROM internship_roles', [])->get();
    }
}