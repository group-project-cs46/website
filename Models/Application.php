<?php

namespace Models;

use Core\App;
use Core\Database;

class Application
{
    public static function getByStudentId($student_id)
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT * FROM applications WHERE student_id = ?', [$student_id])->get();
    }

    public static function getByStudentIdWithDetails($student_id)
    {
        $db = App::resolve(Database::class);
    
        return $db->query('
            SELECT 
                applications.id, 
                advertisements.job_role, 
                companies.company_name 
            FROM applications 
            JOIN advertisements ON applications.ad_id = advertisements.id 
            JOIN companies ON advertisements.company_id = companies.id 
            WHERE student_id = ?', [$student_id])->get();
    }
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