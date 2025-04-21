<?php

namespace Models;

use Core\App;
use Core\Database;

class PdcAdvertisements
{
    public static function fetchAll()
    {
        $db = App::resolve(Database::class);
        return $db->query('
            SELECT 
            ad.*, 
            internship_roles.name AS job_role,
            users.name AS company_name,
            users.email AS company_email
        FROM advertisements ad
        JOIN users ON ad.company_id = users.id
        JOIN internship_roles ON ad.internship_role_id = internship_roles.id
            WHERE ad.approved IS NULL
        ', [])->get();
    }

    public static function fetchApproved()
    {
        $db = App::resolve(Database::class);
        return $db->query('
            SELECT 
            ad.*, 
            internship_roles.name AS job_role,
            users.name AS company_name,
            users.email AS company_email
        FROM advertisements ad
        JOIN users ON ad.company_id = users.id
        JOIN internship_roles ON ad.internship_role_id = internship_roles.id
            WHERE ad.approved = TRUE
        ', [])->get();
    }

    public static function fetchById($id)
{
    $db = App::resolve(Database::class);
    return $db->query('
        SELECT 
            ad.*, 
            internship_roles.name AS job_role,
            users.name AS company_name,
            users.email AS company_email
        FROM advertisements ad
        JOIN users ON ad.company_id = users.id
        JOIN internship_roles ON ad.internship_role_id = internship_roles.id
        WHERE ad.id = ?
    ', [$id])->find();
}

    public static function reject($id)
    {
        $db = App::resolve(Database::class);
        $db->query('UPDATE advertisements SET approved = FALSE WHERE id = ?', [$id]);
    }

    public static function approve($id)
    {
        $db = App::resolve(Database::class);
        $db->query('UPDATE advertisements SET approved = TRUE WHERE id = ?', [$id]);
    }

    public static function fetchappliedstudents($id)
{
    $db = App::resolve(Database::class);
    return $db->query('
        SELECT
            a.*, ad.*,
            users.name,
            s.registration_number,
            users.email
        FROM applications a
        JOIN students s ON a.student_id = s.id
        JOIN users ON s.id = users.id
        JOIN advertisements ad ON a.ad_id = ad.id
        WHERE a.ad_id = ?
    ', [$id])->get();
}

}