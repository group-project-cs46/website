<?php

namespace Models;

use Core\App;
use Core\Database;

class CompanyLecturerVisit
{
    public static function fetchAll()
    {
        $db = App::resolve(Database::class);
        $visits = $db->query('
            SELECT 
                lv.id,
                lv.lecturer_id,
                lv.company_id,
                lv.time,
                lv.lecturer_company_report_id,
                lv.date,
                lv.status,
                l.title AS lecturer_title,
                u.name AS lecturer_name,
                u.email AS lecturer_email
            FROM lecturer_visits lv
            LEFT JOIN lecturers l ON lv.lecturer_id = l.id
            LEFT JOIN users u ON lv.lecturer_id = u.id
            WHERE u.role = 5
        ', [])->get();
        return $visits;
    }

    public static function updateStatus($visitId, $status)
    {
        $db = App::resolve(Database::class);
        $db->query('UPDATE lecturer_visits SET status = ? WHERE id = ?', [
            $status,
            $visitId
        ]);
        return true;
    }

    public static function revertStatus($visitId)
    {
        $db = App::resolve(Database::class);
        $db->query('UPDATE lecturer_visits SET status = NULL WHERE id = ?', [
            $visitId
        ]);
        return true;
    }
}