<?php
namespace Models;
use Core\App;
use Core\Database;

class CompanyDashboard
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

    public static function fetchAppliedStudents()
    {
        $db = App::resolve(Database::class);
        $company_id = self::getCompanyId();

        $students = $db->query('
            SELECT 
                u.name AS student_name,
                s.index_number AS index_no,
                u.email,
                s.course,
                ir.name AS job_role,
                c.filename AS cv_filename,
                c.original_name AS cv_original_name,
                app.selected,
                app.shortlisted,
                app.id AS application_id
            FROM users u
            INNER JOIN students s ON u.id = s.id
            INNER JOIN applications app ON s.id = app.student_id
            INNER JOIN advertisements a ON app.ad_id = a.id
            INNER JOIN internship_roles ir ON a.internship_role_id = ir.id
            LEFT JOIN cvs c ON app.cv_id = c.id
            WHERE u.role = 2 
                AND (app.failed IS NULL) 
                AND (app.shortlisted IS NULL)
                AND a.company_id = :company_id;
        ', ['company_id' => $company_id])->get();

        foreach ($students as &$student) {
            $isSelected = filter_var($student['selected'], FILTER_VALIDATE_BOOLEAN);
            $student['status'] = $isSelected ? 'Hired' : 'Not Hired';
        }
        unset($student);

        return $students;
    }

    public static function fetchNextTechTalk()
    {
        $db = App::resolve(Database::class);
        $company_id = self::getCompanyId();
        date_default_timezone_set('UTC');
        $currentDate = date('Y-m-d H:i:s'); // Current date (e.g., 2025-04-24 00:00:00)

        $techTalks = $db->query('
            SELECT ts.datetime, ts.venue
            FROM techtalks t
            INNER JOIN techtalk_slots ts ON t.techtalk_slot_id = ts.id
            WHERE t.company_id = :company_id 
                AND ts.datetime > :current_date
            ORDER BY ts.datetime ASC
            LIMIT 1
        ', [
            'company_id' => $company_id,
            'current_date' => $currentDate
        ])->find();

        // Enhanced debugging
        if (!$techTalks) {
            error_log("No tech talks found for company_id: $company_id, current_date: $currentDate");
            // Log all tech talks for this company to diagnose the issue
            $allTechTalks = $db->query('
                SELECT ts.datetime, ts.venue, t.id AS techtalk_id, t.techtalk_slot_id, t.company_id, t.host_name, t.host_email, t.description
                FROM techtalks t
                INNER JOIN techtalk_slots ts ON t.techtalk_slot_id = ts.id
                WHERE t.company_id = :company_id
            ', ['company_id' => $company_id])->get();
            error_log("All tech talks for company_id $company_id: " . json_encode($allTechTalks));
        } else {
            error_log("Tech talk found: " . json_encode($techTalks));
        }

        return $techTalks ?: null; // Return null if no future tech talk is found
    }

    public static function fetchNextCompanyVisit()
    {
        $db = App::resolve(Database::class);
        $company_id = self::getCompanyId();
        date_default_timezone_set('UTC');
        $currentDate = date('Y-m-d'); // Current date (e.g., 2025-04-24)

        $visits = $db->query('
            SELECT lv.date, lv.time
            FROM lecturer_visits lv
            WHERE lv.approved = TRUE 
                AND lv.date > :current_date
                AND lv.company_id = :company_id
            ORDER BY lv.date ASC, lv.time ASC
            LIMIT 1
        ', [
            'current_date' => $currentDate,
            'company_id' => $company_id
        ])->find();

        return $visits ?: null; // Return null if no future visit is found
    }
}