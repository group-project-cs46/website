<?php

namespace Models;

use Core\App;
use Core\Database;

class LecturerVisitRejectedReason
{
    public static function create($lecturerVisitId, $reason)
    {
        $db = App::resolve(Database::class);

        $db->query('
            INSERT INTO lecturer_visit_rejected_reasons (lecturer_visit_id, reason)
            VALUES (?, ?)
        ', [
            $lecturerVisitId,
            $reason
        ]);
    }
}
