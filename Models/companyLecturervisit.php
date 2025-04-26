<?php

namespace Models;

use Core\App;
use Core\Database;

class CompanyLecturerVisit
{
    // Helper method to get the authenticated company_id
    private static function getCompanyId()
    {
        $auth_user = auth_user();
        if (!$auth_user || !isset($auth_user['id'])) {
            throw new \Exception('User not authenticated or company_id not found');
        }
        return $auth_user['id'];
    }

    public static function fetchAll()
    {
        $db = App::resolve(Database::class);
        $company_id = self::getCompanyId();

        $visits = $db->query('
            SELECT 
                lv.id,
                lv.lecturer_id,
                lv.company_id,
                lv.time,
                lv.date,
                lv.approved AS status,
                lv.rejected AS rejected,
                l.title AS lecturer_title,
                u.name AS lecturer_name,
                u.email AS lecturer_email
            FROM lecturer_visits lv
            LEFT JOIN lecturers l ON lv.lecturer_id = l.id
            LEFT JOIN users u ON l.id = u.id
            WHERE u.role = 5
                AND lv.company_id = :company_id;
        ', ['company_id' => $company_id])->get();
        return $visits;
    }

    public static function updateStatus($visitId, $status)
    {
        $db = App::resolve(Database::class);
        $company_id = self::getCompanyId();

        $visit = $db->query('SELECT company_id FROM lecturer_visits WHERE id = ?', [$visitId])->find();
        if (!$visit || $visit['company_id'] != $company_id) {
            throw new \Exception('Unauthorized access to update lecturer visit');
        }

        $db->query('UPDATE lecturer_visits SET approved = ?, rejected = NULL WHERE id = ?', [
            $status,
            $visitId
        ]);
        return true;
    }

    public static function revertStatus($visitId)
    {
        $db = App::resolve(Database::class);
        $company_id = self::getCompanyId();

        $visit = $db->query('SELECT company_id FROM lecturer_visits WHERE id = ?', [$visitId])->find();
        if (!$visit || $visit['company_id'] != $company_id) {
            throw new \Exception('Unauthorized access to revert lecturer visit');
        }

        $db->query('UPDATE lecturer_visits SET approved = NULL WHERE id = ?', [
            $visitId
        ]);
        return true;
    }

    public static function rejectVisit($visitId, $reason)
    {
        $db = App::resolve(Database::class);
        $company_id = self::getCompanyId();

        $visit = $db->query('SELECT company_id FROM lecturer_visits WHERE id = ?', [$visitId])->find();
        if (!$visit || $visit['company_id'] != $company_id) {
            throw new \Exception('Unauthorized access to reject lecturer visit');
        }

        // Update the lecturer_visits table to mark the visit as rejected
        $db->query('UPDATE lecturer_visits SET rejected = TRUE, approved = NULL WHERE id = ?', [
            $visitId
        ]);

        // Insert the rejection reason into the lecturer_visit_rejected_reasons table
        $db->query('INSERT INTO lecturer_visit_rejected_reasons (lecturer_visit_id, reason, created_at) VALUES (?, ?, NOW())', [
            $visitId,
            $reason
        ]);

        return true;
    }
}