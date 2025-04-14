<?php

namespace Models;

use Core\App;
use Core\Database;

class Application
{
    public static function getByAdId($ad_id)
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT * FROM applications WHERE ad_id = ?', [$ad_id])->get();

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

        return $db->query('SELECT companies.* FROM applications
         LEFT JOIN advertisements ON applications.ad_id = advertisements.id
         LEFT JOIN companies ON advertisements.company_id = companies.id
         WHERE student_id = ? AND selected = TRUE', [$student_id])->find();
    }

    public static function getByStudentIdWithDetails($student_id)
    {
        $db = App::resolve(Database::class);

        return $db->query('
            SELECT 
                applications.id, 
                advertisements.job_role,
                users.name,
                interviews.datetime AS interview_date,
                interviews.complete AS interview_complete,
                selected,
                failed,
                cvs.original_name AS cv_name
            FROM applications 
            LEFT JOIN advertisements ON applications.ad_id = advertisements.id 
            LEFT JOIN companies ON advertisements.company_id = companies.id
            LEFT JOIN users ON companies.id = users.id
            LEFT JOIN interviews ON applications.interview_id = interviews.id
            LEFT JOIN cvs ON applications.cv_id = cvs.id
            WHERE applications.student_id = ?
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

    public static function delete($id)
    {
        $db = App::resolve(Database::class);

        $db->query('DELETE FROM applications WHERE id = ?', [$id]);
    }
}