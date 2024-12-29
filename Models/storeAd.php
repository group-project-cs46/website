<?php

namespace Models;

use Core\App;
use Core\Database;

class storeAd
{
    public static function create($job_role, $responsibilities, $qualifications_skills, $vacancy_count, $maxCVs, $deadline)
    {
        if (!self::isValidCount($vacancy_count) || !self::isValidCount($maxCVs)) {
            return false;
        }
        $db = App::resolve(Database::class);

        $db->query('INSERT INTO advertisements(job_role, responsibilities, qualifications_skills, vacancy_count, max_cvs, deadline) VALUES (?,?,?,?,?,?)', [
            $job_role,
            $responsibilities,
            $qualifications_skills,
            $vacancy_count,
            $maxCVs,
            $deadline
            
            
        ]);
        return true;
    }
    // Helper function to check if the number is between 0 and 10
    private static function isValidCount($count)
    {
        return is_numeric($count) && $count >= 0;
    }


    



}