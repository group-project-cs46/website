<?php

namespace Models;

use Core\App;
use Core\Database;

class editAd
{
    public static function edit($job_role, $responsibilities, $qualifications_skills, $vacancy_count, $max_cvs, $deadline, $id)
    {
        if (!is_numeric($vacancy_count) || !is_numeric($max_cvs) || $vacancy_count < 0 || $max_cvs < 0) {
            throw new \Exception("Vacancy Count and Maximum CV's Count must be non-negative integers.");
        }

        $db = App::resolve(Database::class);

        // Check if the job_role already exists in internship_roles
        $existingRole = $db->query('SELECT id FROM internship_roles WHERE name = ?', [$job_role])->find();

        if ($existingRole) {
            // If the role exists, use its ID
            $internship_role_id = $existingRole['id'];
        } else {
            // If the role doesn't exist, insert it into internship_roles
            $db->query('INSERT INTO internship_roles (name) VALUES (?)', [$job_role]);
            // Fetch the newly created role's ID
            $internship_role_id = $db->query('SELECT id FROM internship_roles WHERE name = ?', [$job_role])->find()['id'];
        }

        // Update the advertisement with the internship_role_id
        return $db->query(
            'UPDATE advertisements 
             SET internship_role_id = ?, responsibilities = ?, qualifications_skills = ?, vacancy_count = ?, max_cvs = ?, deadline = ?
             WHERE id = ?',
            [$internship_role_id, $responsibilities, $qualifications_skills, $vacancy_count, $max_cvs, $deadline, $id]
        );
    }
}