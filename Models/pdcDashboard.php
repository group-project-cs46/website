<?php

namespace Models;

use Core\App;
use Core\Database;

class pdcDashboard
{
    

    public static function fetchApprovedadds()
    {
        $db = App::resolve(Database::class);
        return $db->query('
            SELECT 
            ad.*, 
            internship_roles.name AS job_role,
            users.name AS company_name,
            users.email AS company_email
        FROM advertisements ad
        JOIN users ON ad.company_id = users.id
        JOIN internship_roles ON ad.internship_role_id = internship_roles.id
            
        ', [])->get();
    }

    public static function countRegisteredcompanies()
    {
        $db = App::resolve(Database::class);

    
        $result = $db->query('SELECT COUNT(*) as count FROM users WHERE role = 4 AND approved = true',[])->find();

        // Return the count (cast to integer for safety)
        return (int) $result['count'];
    }

    public static function countBlacklistedcompanies()
    {
        $db = App::resolve(Database::class);

        
        $result = $db->query('SELECT COUNT(*) as count FROM users WHERE role = 4 AND approved = true AND disabled = true',[])->find();

        // Return the count (cast to integer for safety)
        return (int) $result['count'];
    }

    public static function countRegisteredstudents()
    {
        $db = App::resolve(Database::class);

      
        $result = $db->query('SELECT COUNT(*) as count FROM students',[])->find();

        // Return the count (cast to integer for safety)
        return (int) $result['count'];
    }

    public static function countHiredstudents()
    {
        $db = App::resolve(Database::class);

        
        $result = $db->query('SELECT  COUNT(*) as count FROM applications WHERE selected = true',[])->find();

        // Return the count (cast to integer for safety)
        return (int) $result['count'];
    }
}