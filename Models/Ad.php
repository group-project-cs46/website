<?php

namespace Models;

use Core\App;
use Core\Database;

class Ad
{
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