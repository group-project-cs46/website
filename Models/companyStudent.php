<?php

namespace Models;

use Core\App;
use Core\Database;

class companyStudent
{
    public static function fetchAllStudents()
    {
        $db = App::resolve(Database::class);
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
            LEFT JOIN advertisements a ON app.ad_id = a.id
            LEFT JOIN internship_roles ir ON a.internship_role_id = ir.id
            LEFT JOIN cvs c ON app.cv_id = c.id
            WHERE u.role = 2 AND (app.failed IS NULL) AND (app.shortlisted IS NULL);
        ', [])->get();

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
            WHERE u.role = 2 AND app.shortlisted = TRUE AND (app.failed IS NULL) AND (app.selected IS NULL);
        ', [])->get();

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

    public static function fetchSelectedStudents()
    {
        $db = App::resolve(Database::class);
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
                AND (app.failed IS NULL);
        ', [])->get();

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
        $interview = $db->query('
            SELECT venue, start_time, end_time, date
            FROM interviews
            WHERE id = ?
        ', [$interviewId])->find();

        return $interview;
    }

    public static function updateInterview($interviewId, $venue, $date, $fromTime, $toTime)
    {
        $db = App::resolve(Database::class);

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
}