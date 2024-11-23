<?php

namespace Models;

use Core\App;
use Core\Database;

class Company
{
    public static function all()
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT * FROM companies', [])->get();
    }

}