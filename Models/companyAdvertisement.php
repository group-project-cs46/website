<?php

namespace Models;

use Core\App;
use Core\Database;

class companyAdvertisement
{
    public static function fetchAll()
    {
        $db = App::resolve(Database::class);
        // If you need to filter by company, add the company_id to the query
        // Assuming the logged-in company's ID is available via session or auth
        // $company_id = $_SESSION['user']['company_id'] ?? null;
        $advertisements = $db->query('
            SELECT 
                a.id,
                a.responsibilities,
                a.qualifications,
                a.vacancy_count,
                a.max_cvs,
                a.deadline,
                ir.name AS job_role
            FROM advertisements a
            LEFT JOIN internship_roles ir ON a.internship_role_id = ir.id
            ' . (isset($company_id) ? 'WHERE a.company_id = :company_id' : '') . '
        ', isset($company_id) ? ['company_id' => $company_id] : [])->get();
        return $advertisements;
    }
}