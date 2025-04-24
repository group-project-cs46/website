<?php

namespace Models;

use Core\App;
use Core\Database;

class Application
{
    public static function getApplicationsWithoutSelectedStudents($ad_id)
    {
        $db = App::resolve(Database::class);

        return $db->query('
            SELECT a.*
            FROM applications a
            WHERE a.ad_id = ? AND NOT EXISTS (
                SELECT 1
                FROM applications a2
                WHERE a2.student_id = a.student_id
                AND a2.selected = true
                AND a2.id != a.id
            )
        ', [$ad_id])->get();
    }
    public static function getByAdId($ad_id)
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT * FROM applications WHERE ad_id = ?', [$ad_id])->get();

    }

    public static function thatHasInterviewForMonthAndYearByStudentId(int $month, int $year, int $student_id)
    {
        $db = App::resolve(Database::class);

        return $db->query('
            SELECT
                applications.*,
                interviews.date,
                interviews.start_time,
                interviews.end_time,
                users.name AS company_name,
                interviews.venue,
                ir.name AS internship_role,
                users.email AS company_email
            FROM applications
            LEFT JOIN interviews ON applications.interview_id = interviews.id
            LEFT JOIN advertisements ON applications.ad_id = advertisements.id
            LEFT JOIN users ON users.id = advertisements.company_id
            LEFT JOIN internship_roles ir ON ir.id = advertisements.internship_role_id 
            WHERE EXTRACT(MONTH FROM interviews.date) = ? AND EXTRACT(YEAR FROM interviews.date) = ? AND student_id = ?
        ', [$month, $year, $student_id])->get();

    }
    public static function getByStudentId($student_id)
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT * FROM applications WHERE student_id = ?', [$student_id])->get();
    }

    public static function getByCvId($id)
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT * FROM applications WHERE cv_id = ?', [$id])->get();
    }

    public static function findByStudentIdAndAdId($student_id, $ad_id)
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT * FROM applications WHERE student_id = ? AND ad_id = ?', [$student_id, $ad_id])->find();
    }

    public static function isSelectedByStudentId($student_id)
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT * FROM applications WHERE student_id = ? AND selected = TRUE', [$student_id])->get();
    }

    public static function selectedCompanyByStudentId($student_id)
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT companies.*, users.name FROM applications
         LEFT JOIN advertisements ON applications.ad_id = advertisements.id
         LEFT JOIN companies ON advertisements.company_id = companies.id
         LEFT JOIN users ON companies.id = users.id
         WHERE student_id = ? AND selected = TRUE', [$student_id])->find();
    }

    public static function getByStudentIdWithDetails($student_id)
    {
        $db = App::resolve(Database::class);

        return $db->query('
            SELECT 
                applications.id,
                applications.created_at,
                internship_roles.name AS internship_role,
                users.name,
                interviews.date AS interview_date,
                interviews.start_time AS interview_start_time,
                interviews.end_time AS interview_end_time,
                selected,
                failed,
                cvs.original_name AS cv_name,
                cvs.id AS cv_id,
                users.name AS company_name
            FROM applications 
            LEFT JOIN advertisements ON applications.ad_id = advertisements.id 
            LEFT JOIN companies ON advertisements.company_id = companies.id
            LEFT JOIN users ON companies.id = users.id
            LEFT JOIN interviews ON applications.interview_id = interviews.id
            LEFT JOIN cvs ON applications.cv_id = cvs.id
            LEFT JOIN internship_roles ON advertisements.internship_role_id = internship_roles.id
            WHERE applications.student_id = ?
            ORDER BY created_at
        ', [$student_id])->get();
    }

    public static function updateCvId($id, $cv_id)
    {
        $db = App::resolve(Database::class);

        $db->query('UPDATE applications SET cv_id = ? WHERE id = ?', [$cv_id, $id]);
    }

    public static function getById($id)
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT * FROM applications WHERE id = ?', [$id])->find();
    }

    public static function create($student_id, $cv_id, $ad_id)
    {
        $db = App::resolve(Database::class);

        $db->query('INSERT INTO applications (student_id, cv_id, ad_id) VALUES (?, ?, ?)', [
            $student_id,
            $cv_id,
            $ad_id
        ]);
    }

    public static function createWithIsSecondRound($student_id, $cv_id, $ad_id, $is_second_round)
    {
        $db = App::resolve(Database::class);

        $db->query('INSERT INTO applications (student_id, cv_id, ad_id, is_second_round) VALUES (?, ?, ?, ?)', [
            $student_id,
            $cv_id,
            $ad_id,
            $is_second_round
        ]);
    }

    public static function delete($id)
    {
        $db = App::resolve(Database::class);

        return $db->query('DELETE FROM applications WHERE id = ?', [$id])->get();
    }
}