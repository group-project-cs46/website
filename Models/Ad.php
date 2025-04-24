<?php

namespace Models;

use Core\App;
use Core\Database;

class Ad
{
    public static function all()
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT * FROM advertisements', [])->get();
    }

    public static function allWIthCompany()
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT advertisements.*,
       users.name,
       users.id AS user_id,
       companies.building,
         companies.street_name,
            companies.city
       FROM advertisements LEFT JOIN companies ON advertisements.company_id = companies.id
       LEFT JOIN users ON companies.id = users.id', [])->get();
    }

    public static function allWithCompanyByCompanyId($company_id)
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT advertisements.*,
       users.name,
          users.id AS user_id,
       companies.building,
         companies.street_name,
            companies.city FROM advertisements LEFT JOIN companies ON advertisements.company_id = companies.id 
                           LEFT JOIN users ON companies.id = users.id
                           WHERE companies.id = ?', [$company_id])->get();
    }

    public static function byBatchId($batchId) {
        $db = App::resolve(Database::class);

        return $db->query('
            SELECT
                advertisements.*,
                users.name,
                users.id AS user_id,
                companies.building,
                companies.street_name,
                companies.city,
                ir.name AS internship_role_name
            FROM advertisements
            LEFT JOIN companies ON advertisements.company_id = companies.id 
            LEFT JOIN users ON companies.id = users.id
            LEFT JOIN internship_roles ir ON advertisements.internship_role_id = ir.id
            WHERE advertisements.batch_id = ? AND CURRENT_DATE < advertisements.deadline
        ', [$batchId])->get();
    }

    public static function byBatchIdAndComapnyId($batchId, $companyId) {
        $db = App::resolve(Database::class);

        return $db->query('
            SELECT
                advertisements.*,
                users.name,
                users.id AS user_id,
                companies.building,
                companies.street_name,
                companies.city,
                ir.name AS internship_role_name
            FROM advertisements
            LEFT JOIN companies ON advertisements.company_id = companies.id 
            LEFT JOIN users ON companies.id = users.id
            LEFT JOIN internship_roles ir ON advertisements.internship_role_id = ir.id
            WHERE advertisements.batch_id = ? AND companies.id = ? AND CURRENT_DATE < advertisements.deadline
        ', [$batchId, $companyId])->get();
    }

    public static function find($id)
    {
        $db = App::resolve(Database::class);

        return $db->query('
            SELECT 
                *,
                internship_roles.name AS internship_role
            FROM advertisements
            LEFT JOIN internship_roles ON advertisements.internship_role_id = internship_roles.id
            WHERE advertisements.id = ?
        ', [$id])->find();
    }

    public static function getById($id)
    {
        $db = App::resolve(Database::class);

        return $db->query('
            SELECT
                advertisements.*,
                internship_roles.name AS internship_role
            FROM advertisements
            LEFT JOIN internship_roles ON advertisements.internship_role_id = internship_roles.id
            WHERE advertisements.id = ?
        ', [$id])->find();
    }

    public static function findWithCompany($id)
    {
        $db = App::resolve(Database::class);

        return $db->query('
            SELECT
                advertisements.*,
                users.name,
                companies.building,
                companies.street_name,
                companies.address_line_2,
                companies.city,
                ir.name AS internship_role
            FROM advertisements
            LEFT JOIN companies ON advertisements.company_id = companies.id
            LEFT JOIN users ON users.id = companies.id
            LEFT JOIN internship_roles ir ON advertisements.internship_role_id = ir.id
            WHERE advertisements.id = ?
        ', [$id])->find();
    }

    public static function create($job_type, $job_role, $responsibilities, $qualifications_skills, $maxCVs)
    {
        $db = App::resolve(Database::class);

        $db->query('INSERT INTO advertisements(job_type, job_role, responsibilities, qualifications_skills, max_cvs) VALUES (?, ?, ?, ?, ?)', [
            $job_type,
            $job_role,
            $responsibilities,
            $qualifications_skills,
            $maxCVs
        ]);
    }

    public static function getByInternshipRoleId($internshipRoleId)
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT * FROM advertisements WHERE internship_role_id = ?', [$internshipRoleId])->get();
    }

    public static function getByBatchId($batchId)
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT * FROM advertisements WHERE batch_id = ?', [$batchId])->get();
    }

}