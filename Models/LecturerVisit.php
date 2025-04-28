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
                lecturer_visits.id as leid,
                companies.*,
                users.name
            FROM lecturer_visits
            INNER JOIN lecture_visit_lecturers ON lecturer_visits.id = lecture_visit_lecturers.lecturer_visit_id
            INNER JOIN companies ON lecturer_visits.company_id = companies.id
            INNER JOIN users ON lecturer_visits.company_id = users.id
            WHERE lecture_visit_lecturers.lecturer_id = ?
        ', [$lecturerId])->get(); 
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
        ', [$companyId])->find(); 
    }   

    public static function updateStatus($visitId, $status)
    {
        $db = App::resolve(Database::class);
        $db->query('UPDATE lecturer_visits SET status = ? WHERE id = ?', [
            $status,
            $visitId
        ]);
    }

    public static function updateReportId($visitId, $reportId)
    {
        $db = App::resolve(Database::class);
        $db->query('UPDATE lecturer_visits SET lecturer_company_report_id = ? WHERE id = ?', [
            $reportId,
            $visitId
        ]);
    }

}