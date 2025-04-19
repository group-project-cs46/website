<?php

namespace Models;

use Core\App;
use Core\Database;

class companyTechtalk
{
    public static function fetchAll()
    {
        $db = App::resolve(Database::class);
        $techtalks = $db->query('
    SELECT 
        ts.*,t.*,
        TO_CHAR(ts.datetime, \'YYYY-MM-DD\') AS date,   
        TO_CHAR(ts.datetime, \'HH12:MI AM\') AS time 
    FROM techtalk_slots ts LEFT JOIN techtalks t ON ts.id = t.techtalk_slot_id;
', [])->get();
   return $techtalks;
    }

    public static function insertConductorDetails($techtalkSlotId, $companyId, $conductorName, $conductorEmail, $description)
    {
        // Resolve database connection
        $db = App::resolve(Database::class);

        // Insert conductor information into the techtalks table using techtalk_slot_id
        $db->query('INSERT INTO techtalks (techtalk_slot_id, company_id, conductor_name, conductor_email, description) VALUES (?,?,?,?,?)', [
            $techtalkSlotId,
            $companyId,
            $conductorName,
            $conductorEmail,
            $description,
            
            
        ]);
        return true;
    }


}

