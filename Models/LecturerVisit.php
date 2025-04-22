<?php

namespace Models;

use Core\App;
use Core\Database;

class LecturerVisit
{
    public static function getAll()
    {
        $db = App::resolve(Database::class);

        return $db->query('
            SELECT 
                lecturer_visits.*, 
                lecturer.name AS lecturer_name,
                companies.name AS company_name
            FROM lecturer_visits
            LEFT JOIN companies ON lecturer_visits.company_id = companies.id
        ', [])->get();
    }
}