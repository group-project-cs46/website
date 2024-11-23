<?php

namespace Models;

use Core\App;
use Core\Database;

error_log("POST Data: " . print_r($data, true));  // This will print all incoming form data



class editAd
{
    
    
    public static function edit(array $data)
{
    // Resolve the database instance
    $db = App::resolve(Database::class);

    // Validate required fields
    $requiredFields = ['id', 'job_role', 'responsibilities', 'qualifications_skills', 'vacancy_count', 'max_cvs', 'deadline'];
    foreach ($requiredFields as $field) {
        if (!isset($data[$field]) || empty(trim($data[$field]))) {
            throw new \Exception("Field $field is required and cannot be empty.");
        }
    }

    // Sanitize and fetch input data
    $id = intval($data['id']);
    $job_role = trim($data['job_role']);
    $responsibilities = trim($data['responsibilities']);
    $qualifications_skills = trim($data['qualifications_skills']);
    $vacancy_count = intval($data['vacancy_count']);
    $max_cvs = intval($data['max_cvs']);
    $deadline = trim($data['deadline']);

    // Execute the UPDATE query
    $db->query(
        'UPDATE advertisements 
         SET job_role = ?, responsibilities = ?, qualifications_skills = ?, vacancy_count = ?, max_cvs = ?, deadline = ?
         WHERE id = ?',
        [$job_role, $responsibilities, $qualifications_skills, $vacancy_count, $max_cvs, $deadline, $id]
    );
}

}

