<?php

namespace Models;

use Core\App;
use Core\Database;

class LecturerVisitLecturer
{
    public static function getByLecturerVisitId($lecturerVisitId)
    {
        $db = App::resolve(Database::class);

        return $db->query('
        SELECT
            *
        FROM lecture_visit_lecturers
        WHERE lecturer_visit_id = ?
        ', [$lecturerVisitId])->get();

    }

}