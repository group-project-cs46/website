<?php

namespace Models;

use Core\App;
use Core\Database;

class Application
{
    public static function create($student_id, $cv_id, $ad_id)
    {
        $db = App::resolve(Database::class);

        $db->query('INSERT INTO applications (student_id, cv_id, ad_id) VALUES (?, ?, ?)', [
            $student_id,
            $cv_id,
            $ad_id
        ]);
    }
}