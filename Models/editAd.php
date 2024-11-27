<?php

namespace Models;

use Core\App;
use Core\Database;

error_log("POST Data: " . print_r($data, true));  // This will print all incoming form data



class editAd
{
    
    
    public static function edit($job_role, $responsibilities, $qualifications_skills, $vacancy_count, $max_cvs, $deadline, $id)
{
    if (!is_numeric($vacancy_count) || !is_numeric($max_cvs) || $vacancy_count < 0 || $max_cvs < 0) {
        throw new \Exception("Vacancy Count and Maximum CV's Count must be non-negative integers.");
    }
    // Resolve the database instance
    $db = App::resolve(Database::class);

    

    // Execute the UPDATE query
    return $db->query(
        'UPDATE advertisements 
         SET job_role = ?, responsibilities = ?, qualifications_skills = ?, vacancy_count = ?, max_cvs = ?, deadline = ?
         WHERE id = ?',
        [$job_role, $responsibilities, $qualifications_skills, $vacancy_count, $max_cvs, $deadline, $id]
    );
}

}

