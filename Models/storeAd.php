<?php

namespace Models;

use Core\App;
use Core\Database;

class storeAd
{
    public static function create($responsibilities, $qualifications_skills, $vacancy_count, $maxCVs, $deadline, $company_id, $internship_role_id)
    {
        if (!self::isValidCount($vacancy_count) || !self::isValidCount($maxCVs)) {
            return false;
        }

        $db = App::resolve(Database::class);

        // Check if the job_role already exists in internship_roles
//        $existingRole = $db->query('SELECT id FROM internship_roles WHERE name = ?', [$job_role])->find();
//
//        if ($existingRole) {
//            // If the role exists, use its ID
//            $internship_role_id = $existingRole['id'];
//        } else {
//            // If the role doesn't exist, insert it into internship_roles
//            $db->query('INSERT INTO internship_roles (name) VALUES (?)', [$job_role]);
//            // Fetch the newly created role's ID
//            $internship_role_id = $db->query('SELECT id FROM internship_roles WHERE name = ?', [$job_role])->find()['id'];
//        }

        // Insert the advertisement with the internship_role_id and company_id
        $db->query(
            'INSERT INTO advertisements (internship_role_id, responsibilities, qualifications_skills, vacancy_count, max_cvs, deadline, company_id) VALUES (?,?,?,?,?,?,?)',
            [
                $internship_role_id,
                $responsibilities,
                $qualifications_skills,
                $vacancy_count,
                $maxCVs,
                $deadline,
                $company_id
            ]
        );

        return true;
    }

    // Helper function to check if the number is valid (non-negative)
    private static function isValidCount($count)
    {
        return is_numeric($count) && $count >= 0;
    }
}