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

    public static function byRoundId($roundId) {
        $db = App::resolve(Database::class);

        return $db->query('SELECT advertisements.*,
       users.name,
          users.id AS user_id,
       companies.building,
         companies.street_name,
            companies.city FROM advertisements LEFT JOIN companies ON advertisements.company_id = companies.id 
                           LEFT JOIN users ON companies.id = users.id
<<<<<<< HEAD
                           WHERE advertisements.round_id = ?', [$roundId])->get();
=======
                           WHERE advertisements.round_id = ? AND CURRENT_DATE < advertisements.deadline', [$roundId])->get();
>>>>>>> 8b4d7493ee0f8e085c8141bffdabd5fb387be66c
    }

    public static function byRoundIdAndComapnyId($roundId, $companyId) {
        $db = App::resolve(Database::class);

        return $db->query('SELECT advertisements.*,
       users.name,
          users.id AS user_id,
       companies.building,
         companies.street_name,
            companies.city FROM advertisements LEFT JOIN companies ON advertisements.company_id = companies.id 
                           LEFT JOIN users ON companies.id = users.id
<<<<<<< HEAD
                           WHERE advertisements.round_id = ? AND companies.id = ?', [$roundId, $companyId])->get();
=======
                           WHERE advertisements.round_id = ? AND companies.id = ? AND CURRENT_DATE < advertisements.deadline', [$roundId, $companyId])->get();
>>>>>>> 8b4d7493ee0f8e085c8141bffdabd5fb387be66c
    }

    public static function find($id)
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT * FROM advertisements WHERE id = ?', [$id])->find();
    }

    public static function getById($id)
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT * FROM advertisements WHERE id = ?', [$id])->find();
    }

    public static function findWithCompany($id)
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT advertisements.*, users.name, companies.building,
         companies.street_name,
         companies.address_line_2,
            companies.city FROM advertisements
                LEFT JOIN companies ON advertisements.company_id = companies.id
                           LEFT JOIN users ON users.id = companies.id
                           WHERE advertisements.id = ?', [$id])->find();
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

}