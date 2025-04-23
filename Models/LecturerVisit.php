<?php

namespace Models;

use Core\App;
use Core\Database;

class LecturerVisit
{
    public static function getById($id)
    {
        $db = App::resolve(Database::class);

        return $db->query('
            SELECT
                lecturer_visits.*,
                users.name AS company_name,
                companies.building AS company_building,
                companies.street_name AS company_street_name,
                companies.address_line_2 AS company_address_line_2,
                companies.city AS company_city,
                companies.postal_code AS company_postal_code
            FROM lecturer_visits
            LEFT JOIN companies ON lecturer_visits.company_id = companies.id
            LEFT JOIN users ON lecturer_visits.company_id = users.id
            WHERE lecturer_visits.id = ?
        ', [$id])->find();
    }
    public static function getByLecturerId($lecturerId)
    {
        $db = App::resolve(Database::class);

        return $db->query('
            SELECT 
                lecturer_visits.*,
                company.name AS company_name
            FROM lecturer_visits
            LEFT JOIN users company ON lecturer_visits.company_id = company.id
            WHERE lecturer_visits.lecturer_id = ?
            ORDER BY date, time
        ', [$lecturerId])->get();
    }
}