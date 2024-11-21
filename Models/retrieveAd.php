<?php

namespace Models;

use Core\App;
use Core\Database;

class retrieveAd
{
    // Retrieve specific columns from advertisements
    public static function getSelectedColumns()
    {
        $db = App::resolve(Database::class);

        // Execute the query to get specific columns
        $results = $db->query('SELECT job_role, responsibilities, qualifications_skills, deadline, max_cvs FROM advertisements');

        // Return the fetched results
        return $results->fetchAll(); // Use fetchAll() to get an array of all rows
    }
}
