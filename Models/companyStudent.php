<?php

namespace Models;

use Core\App;
use Core\Database;

class companyStudent
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

    public static function fetchAllStudents()
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
                app.id AS application_id,
                app.student_id
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

        // Collect all student IDs to check for selected applications
        $studentIds = array_unique(array_column($students, 'student_id'));

        // Debug: Log the student IDs and the query
        error_log('Student IDs: ' . print_r($studentIds, true));

        // Query to check if each student has any selected application
        $selectedStudents = [];
        if (!empty($studentIds)) {
            $placeholders = implode(',', array_fill(0, count($studentIds), '?'));
            $query = "SELECT DISTINCT student_id FROM applications WHERE student_id IN ($placeholders) AND selected = TRUE";
            error_log('Second Query: ' . $query);
            error_log('Parameters: ' . print_r($studentIds, true));

            // Use the query method with proper parameter binding
            $selectedResult = $db->query($query, array_values($studentIds))->get();

            // Create a set of student IDs who have at least one selected application
            $selectedStudents = array_column($selectedResult, 'student_id');
        }

        // Update the status for each application
        foreach ($students as &$student) {
            // If the student has any selected application, mark all their applications as "Hired"
            $student['status'] = in_array($student['student_id'], $selectedStudents) ? 'Hired' : 'Not Hired';
        }
        unset($student);

        return $students;
    }

    public static function shortedlistStudent($applicationId)
    {
        $db = App::resolve(Database::class);
        $company_id = self::getCompanyId();

        // Verify that the application belongs to this company
        $application = self::getApplicationById($applicationId);
        if (!$application || !self::canAccessApplication($applicationId, $company_id)) {
            throw new \Exception('Unauthorized access to application');
        }

        $result = $db->query('
            UPDATE applications
            SET shortlisted = TRUE
            WHERE id = ?
        ', [$applicationId]);

        return true;
    }

    public static function nonShortedlistStudent($applicationId)
    {
        $db = App::resolve(Database::class);
        $company_id = self::getCompanyId();

        // Verify that the application belongs to this company
        $application = self::getApplicationById($applicationId);
        if (!$application || !self::canAccessApplication($applicationId, $company_id)) {
            throw new \Exception('Unauthorized access to application');
        }

        $result = $db->query('
            UPDATE applications
            SET failed = TRUE
            WHERE id = ?
        ', [$applicationId]);

        return true;
    }

    public static function fetchShortlitedStudents()
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
                app.failed,
                app.id AS application_id,
                app.interview_id,
                app.student_id
            FROM users u
            INNER JOIN students s ON u.id = s.id
            INNER JOIN applications app ON s.id = app.student_id
            INNER JOIN advertisements a ON app.ad_id = a.id
            INNER JOIN internship_roles ir ON a.internship_role_id = ir.id
            LEFT JOIN cvs c ON app.cv_id = c.id
            WHERE u.role = 2 
                AND app.shortlisted = TRUE 
                AND (app.failed IS NULL) 
                AND (app.selected IS NULL)
                AND a.company_id = :company_id;
        ', ['company_id' => $company_id])->get();

        // Collect all student IDs to check for selected applications
        $studentIds = array_unique(array_column($students, 'student_id'));

        // Query to check if each student has any selected application
        $selectedStudents = [];
        if (!empty($studentIds)) {
            $placeholders = implode(',', array_fill(0, count($studentIds), '?'));
            $selectedResult = $db->query("
                SELECT DISTINCT student_id
                FROM applications
                WHERE student_id IN ($placeholders) AND selected = TRUE
            ", array_values($studentIds))->get();

            // Create a set of student IDs who have at least one selected application
            $selectedStudents = array_column($selectedResult, 'student_id');
        }

        // Update the status for each application
        foreach ($students as &$student) {
            // If the student has any selected application, mark all their applications as "Hired"
            $student['status'] = in_array($student['student_id'], $selectedStudents) ? 'Hired' : 'Not Hired';
        }
        unset($student);

        return $students;
    }
    public static function nonShortlistedFromShortlist($applicationId)
{
    $db = App::resolve(Database::class);
    $company_id = self::getCompanyId();

    // Verify that the application belongs to this company
    $application = self::getApplicationById($applicationId);
    if (!$application || !self::canAccessApplication($applicationId, $company_id)) {
        throw new \Exception('Unauthorized access to application');
    }

    // Check if the application is shortlisted
    $isShortlisted = $db->query('
        SELECT shortlisted
        FROM applications
        WHERE id = ?
    ', [$applicationId])->find();

    if (!$isShortlisted || !filter_var($isShortlisted['shortlisted'], FILTER_VALIDATE_BOOLEAN)) {
        throw new \Exception('Application is not shortlisted');
    }

    // Update the applications table to mark as failed
    $db->query('
        UPDATE applications
        SET failed = TRUE, shortlisted = FALSE
        WHERE id = ?
    ', [$applicationId]);


    return true;
}

    public static function fetchSelectedStudents()
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
                AND app.selected = TRUE 
                AND app.shortlisted = TRUE 
                AND (app.failed IS NULL)
                AND a.company_id = :company_id;
        ', ['company_id' => $company_id])->get();

        foreach ($students as &$student) {
            // Check the selected status for this specific application
            $isSelected = filter_var($student['selected'], FILTER_VALIDATE_BOOLEAN);
            $student['status'] = $isSelected ? 'Hired' : 'Not Hired';
        }
        unset($student);

        return $students;
    }

    public static function scheduleInterview($applicationId, $venue, $date, $fromTime, $toTime)
    {
        $db = App::resolve(Database::class);
        $company_id = self::getCompanyId();

        // Verify that the application belongs to this company
        $application = self::getApplicationById($applicationId);
        if (!$application || !self::canAccessApplication($applicationId, $company_id)) {
            throw new \Exception('Unauthorized access to application');
        }

        // Combine date and time for start_time and end_time
        $startTime = "$date $fromTime";
        $endTime = "$date $toTime";

        // Insert into interviews table and return the inserted ID
        $result = $db->query('
            INSERT INTO interviews (venue, start_time, end_time, date)
            VALUES (?, ?, ?, ?)
            RETURNING id
        ', [$venue, $startTime, $endTime, $date])->get();

        // Extract the interview_id from the result
        $interviewId = $result[0]['id'];

        // Update the applications table with the interview_id
        $db->query('
            UPDATE applications
            SET interview_id = ?
            WHERE id = ?
        ', [$interviewId, $applicationId]);

        return $interviewId; // Return the interview_id
    }

    public static function getInterviewDetails($interviewId)
    {
        $db = App::resolve(Database::class);
        $company_id = self::getCompanyId();

        $interview = $db->query('
            SELECT i.venue, i.start_time, i.end_time, i.date
            FROM interviews i
            INNER JOIN applications app ON i.id = app.interview_id
            INNER JOIN advertisements a ON app.ad_id = a.id
            WHERE i.id = :interview_id 
                AND a.company_id = :company_id;
        ', [
            'interview_id' => $interviewId,
            'company_id' => $company_id
        ])->find();

        if (!$interview) {
            throw new \Exception('Interview not found or unauthorized access');
        }

        return $interview;
    }

    public static function updateInterview($interviewId, $venue, $date, $fromTime, $toTime)
    {
        $db = App::resolve(Database::class);
        $company_id = self::getCompanyId();

        // Verify that the interview belongs to this company
        $interview = self::getInterviewDetails($interviewId); // This will throw an exception if unauthorized

        // Combine date and time for start_time and end_time
        $startTime = "$date $fromTime";
        $endTime = "$date $toTime";

        $db->query('
            UPDATE interviews
            SET venue = ?, start_time = ?, end_time = ?, date = ?
            WHERE id = ?
        ', [$venue, $startTime, $endTime, $date, $interviewId]);

        return true;
    }

    public static function deleteInterview($applicationId, $interviewId)
    {
        $db = App::resolve(Database::class);
        $company_id = self::getCompanyId();

        // Verify that the application and interview belong to this company
        $application = self::getApplicationById($applicationId);
        if (!$application || !self::canAccessApplication($applicationId, $company_id)) {
            throw new \Exception('Unauthorized access to application');
        }

        // Verify that the interview belongs to this company
        $interview = self::getInterviewDetails($interviewId); // This will throw an exception if unauthorized

        // First, remove the interview_id from the applications table
        $db->query('
            UPDATE applications
            SET interview_id = NULL
            WHERE id = ?
        ', [$applicationId]);

        // Then, delete the interview from the interviews table
        $db->query('
            DELETE FROM interviews
            WHERE id = ?
        ', [$interviewId]);

        return true;
    }

    public static function getApplicationById($applicationId)
    {
        $db = App::resolve(Database::class);
        $application = $db->query('
            SELECT app.id, app.cv_id, app.ad_id, app.student_id
            FROM applications app
            WHERE app.id = ?
        ', [$applicationId])->find();

        return $application;
    }

    public static function canAccessApplication($applicationId, $companyId)
    {
        $db = App::resolve(Database::class);
        $result = $db->query('
            SELECT 1
            FROM applications app
            INNER JOIN advertisements ad ON app.ad_id = ad.id
            WHERE app.id = ? AND ad.company_id = ?
        ', [$applicationId, $companyId])->find();

        return !empty($result);
    }
}