<?php

namespace Models;

use Core\App;
use Core\Database;

error_log("POST Data: " . print_r($data, true));  // This will print all incoming form data



class editAd
{
    
    
    public static function edit($job_role, $responsibilities, $qualifications_skills, $vacancy_count, $max_cvs, $deadline, $id)
{
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

