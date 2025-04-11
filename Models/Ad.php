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
                           WHERE advertisements.round_id = ?', [$roundId])->get();
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
                           WHERE advertisements.round_id = ? AND companies.id = ?', [$roundId, $companyId])->get();
    }

//    public static function find($id)
//    {
//        $db = App::resolve(Database::class);
//
//        return $db->query('SELECT * FROM advertisements WHERE id = ?', [$id])->find();
//    }

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