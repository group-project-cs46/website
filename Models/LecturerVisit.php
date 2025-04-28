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

    public static function getByLecturerIdOnlyApproved($lecturerId)
    {
        $db = App::resolve(Database::class);
        return $db->query('
            SELECT
                lv.*,
                u.name as company_name
            FROM lecturer_visits lv
            INNER JOIN lecture_visit_lecturers lvl ON lv.id = lvl.lecturer_visit_id
            LEFT JOIN companies c ON lv.company_id = c.id
            LEFT JOIN users u ON lv.company_id = u.id
            WHERE lvl.lecturer_id = ? AND lv.approved = TRUE
        ', [$lecturerId])->get();
    }

    public static function updateVisitedById($visited, $id)
    {
        $db = App::resolve(Database::class);

        return $db->query('
            UPDATE lecturer_visits
            SET visited = ?
            WHERE id = ?
        ', [$visited, $id])->get();
    }

    public static function getByIdWithDetails($companyId)
    {
        $db = App::resolve(Database::class);

        return $db->query('
            SELECT
                lecturer_visits.*,
                lecturer_visits.id as leid,
                c.building as company_building,
                c.street_name as company_street_name,
                c.address_line_2 as company_address_line_2,
                c.city as company_city,
                c.postal_code as company_postal_code,
                users.name as company_name,
                f.original_name as report_file_name
            FROM lecturer_visits
            LEFT JOIN lecture_visit_lecturers lvl ON lecturer_visits.id = lvl.lecturer_visit_id
            LEFT JOIN companies c ON lecturer_visits.company_id = c.id
            LEFT JOIN users ON lecturer_visits.company_id = users.id
            LEFT JOIN files f ON lecturer_visits.report_file_id = f.id
            WHERE lecturer_visits.id = ?
        ', [$companyId])->find();
    }

    public static function getById($companyId)
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

    public static function updateReportId($lecturerVisitId, $reportFileId)
    {
        $db = App::resolve(Database::class);
        $db->query('UPDATE lecturer_visits SET report_file_id = ? WHERE id = ?', [
            $reportFileId,
            $lecturerVisitId
        ]);
    }


    public static function setRejected($visitId)
    {
        $db = App::resolve(Database::class);

        $db->query('UPDATE lecturer_visits SET rejected = true WHERE id = ?', [
            $visitId
        ]);
    }

}