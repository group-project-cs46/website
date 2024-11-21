<?php

namespace Models;

use Core\App;
use Core\Database;

class storeAd
{
    public static function create($job_role, $responsibilities, $qualifications_skills, $deadline, $maxCVs)
    {
        $db = App::resolve(Database::class);

        $db->query('INSERT INTO advertisements(job_role, responsibilities, qualifications_skills, deadline, max_cvs) VALUES (?, ?, ?, ?,?)', [
            $job_role,
            $responsibilities,
            $qualifications_skills,
            $deadline,
            $maxCVs
            
        ]);
    }


    



}