<?php
namespace Models;
use Core\App;
use Core\Database;

class CompanyDashboard
{
    public static function fetchAppliedStudents()
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
            WHERE u.role = 2 AND (app.failed IS NULL) AND (app.shortlisted IS NULL);
        ', [])->get();

        foreach ($students as &$student) {
            $isSelected = filter_var($student['selected'], FILTER_VALIDATE_BOOLEAN);
            $student['status'] = $isSelected ? 'Hired' : 'Not Hired';
        }
        unset($student);

        return $students;
    }
}