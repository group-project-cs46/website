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

    public static function create($internship_role_id, $responsibilities, $qualifications_skills, $max_cvs, $deadline, $vacancy_count, $photo_id)
    {
        $db = App::resolve(Database::class);

        $currentBatch = Batch::currentBatch();
        $auth_user = auth_user();

        $db->query('
            INSERT INTO
            advertisements(internship_role_id, responsibilities, qualifications_skills, max_cvs, deadline, vacancy_count, photo_id, batch_id, company_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $internship_role_id,
            $responsibilities,
            $qualifications_skills,
            $max_cvs,
            $deadline,
            $vacancy_count,
            $photo_id,
            $currentBatch['id'],
            $auth_user['id']
        ]);
    }

    public static function getByInternshipRoleIdWithoutAlreadyAppliedInTheFirstRound($internshipRoleId)
    {
        $db = App::resolve(Database::class);

        $auth_user = auth_user();
        $currentBatch = Batch::currentBatch();

        return $db->query('
            SELECT
                *
            FROM advertisements
            WHERE internship_role_id = ?
            AND batch_id = ?
            AND id NOT IN (
                SELECT ad_id
                FROM applications
                WHERE student_id = ?
                AND is_second_round IS null
            )
        ', [$internshipRoleId, $currentBatch['id'], $auth_user['id']])->get();
    }

    public static function getByBatchId($batchId)
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT * FROM advertisements WHERE batch_id = ?', [$batchId])->get();
    }

    public static function getByCompanyId($companyId)
    {
        $db = App::resolve(Database::class);

        return $db->query('
            SELECT
                advertisements.*,
                internship_roles.name AS internship_role
            FROM advertisements
            LEFT JOIN internship_roles ON advertisements.internship_role_id = internship_roles.id
            WHERE company_id = ? ORDER BY created_at DESC
        ', [$companyId])->get();
    }

    public static function update($attributes, $id)
    {
        $db = App::resolve(Database::class);

        // Step 1: Get current advertisement
        $currentAd = $db->query('SELECT * FROM advertisements WHERE id = ?', [$id])->find();

        if (!$currentAd) {
            return null;
        }

        // Step 2: Merge attributes (use existing if not provided)
        $maxCvs              = $attributes['max_cvs']              ?? $currentAd['max_cvs'];
        $responsibilities    = $attributes['responsibilities']     ?? $currentAd['responsibilities'];
        $qualifications      = $attributes['qualifications_skills']?? $currentAd['qualifications_skills'];
        $deadline            = $attributes['deadline']             ?? $currentAd['deadline'];
        $vacancyCount        = $attributes['vacancy_count']        ?? $currentAd['vacancy_count'];
        $internshipRoleId    = $attributes['internship_role_id']   ?? $currentAd['internship_role_id'];
        $photoId             = $attributes['photo_id']             ?? $currentAd['photo_id'];

        // Step 3: Update with merged values
        $db->query('
            UPDATE advertisements
            SET
                max_cvs = ?,
                responsibilities = ?,
                qualifications_skills = ?,
                deadline = ?,
                vacancy_count = ?,
                internship_role_id = ?,
                photo_id = ?
            WHERE id = ?',
            [$maxCvs, $responsibilities, $qualifications, $deadline, $vacancyCount, $internshipRoleId, $photoId, $id]
        );
    }

}