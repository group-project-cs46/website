<?php

namespace Models;

use Core\App;
use Core\Database;

class storeAd
{
    public static function create($job_role, $responsibilities, $qualifications_skills, $vacancy_count, $maxCVs, $deadline)
    {
        $db = App::resolve(Database::class);

        $db->query('INSERT INTO advertisements(job_role, responsibilities, qualifications_skills, vacancy_count, max_cvs, deadline) VALUES (?,?,?,?,?,?)', [
            $job_role,
            $responsibilities,
            $qualifications_skills,
            $vacancy_count,
            $maxCVs,
            $deadline
            
            
        ]);
    }


    



}