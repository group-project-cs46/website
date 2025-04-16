<?php

namespace Models;

use Core\App;
use Core\Database;

class SecondRoundRole
{
    public static function getAllByStudentId($id)
    {
        $db = App::resolve(Database::class);
        return $db->query('SELECT 
            *
        FROM second_round_roles s
        LEFT JOIN internship_roles i ON s.internship_role_id = i.id
        WHERE student_id = ?', [ $id ])->get();
    }

    public static function create($internship_role_id, $student_id, $cv_id)
    {
        $db = App::resolve(Database::class);
        $db->query('INSERT INTO second_round_roles (internship_role_id, student_id, cv_id) VALUES (?, ?, ?)', [
            $internship_role_id,
            $student_id,
            $cv_id
        ]);
    }
}