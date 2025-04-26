<?php

namespace Models;

use Core\App;
use Core\Database;

class LecturerVisit
{
    public static function getByLecturerId($lecturerId)
    {
        $db = App::resolve(Database::class);

        return $db->query('
            SELECT
                lecturer_visits.*,
                companies.*,
                users.name
            FROM lecturer_visits
            INNER JOIN lecture_visit_lecturers ON lecturer_visits.id = lecture_visit_lecturers.lecturer_visit_id
            INNER JOIN companies ON lecturer_visits.company_id = companies.id
            INNER JOIN users ON lecturer_visits.company_id = users.id
            WHERE lecture_visit_lecturers.lecturer_id = ?
        ', [$lecturerId])->get(); // ✅ use get() to fetch all visits
    }   

    public static function getById($companyId)
    {
        $db = App::resolve(Database::class);

        return $db->query('
            SELECT
                lecturer_visits.*,
                companies.*,
                users.name
            FROM lecturer_visits
            INNER JOIN lecture_visit_lecturers ON lecturer_visits.id = lecture_visit_lecturers.lecturer_visit_id
            INNER JOIN companies ON lecturer_visits.company_id = companies.id
            INNER JOIN users ON lecturer_visits.company_id = users.id
            WHERE lecturer_visits.company_id = ?
        ', [$companyId])->find(); // ✅ use get() to fetch all visits
    }   

    public static function updateStatus($visitId, $status)
    {
        $db = App::resolve(Database::class);
        $db->query('UPDATE lecturer_visits SET status = ? WHERE id = ?', [
            $status,
            $visitId
        ]);
    }

    // Existing method for updating report id (if needed)
    // public static function updateReportId($visitId, $reportId)
    // {
    //     $db = App::resolve(Database::class);
    //     $db->query('UPDATE lecturer_visits SET lecturer_company_report_id = ? WHERE id = ?', [
    //         $reportId,
    //         $visitId
    //     ]);
    // }
    // public static function getByLecturerId($lecturerId, $batchId)
    // {
    //     // if (!$batchId) return [];
    //     $db = App::resolve(Database::class);
 
    //     return $db->query('
    //         SELECT 
    //             lecturer_visits.*,
    //             company.name AS company_name
    //         FROM lecturer_visits
    //         LEFT JOIN users company ON lecturer_visits.company_id = company.id
    //         WHERE lecturer_visits.lecturer_id = ?
    //         AND lecturer_visits.batch_id = ?
    //         ORDER BY date, time
    //     ', [$lecturerId, $batchId])->get();
    // }

    public static function updateReportId($visitId, $reportId)
    {
        $db = App::resolve(Database::class);
        $db->query('UPDATE lecturer_visits SET lecturer_company_report_id = ? WHERE id = ?', [
            $reportId,
            $visitId
        ]);   
    }

}