<?php

namespace Models;

use Core\App;
use Core\Database;

class TechTalk
{
    public static function findForCurrentMonth()
    {
        $db = App::resolve(Database::class);

        $techtalks = $db->query('SELECT * FROM techtalk_slots ts
LEFT JOIN techtalks t ON ts.id = t.techtalk_slot_id
         LEFT JOIN companies c ON t.company_id = c.id
         LEFT JOIN users u ON c.id = u.id
WHERE EXTRACT(MONTH FROM time) = EXTRACT(MONTH FROM CURRENT_DATE) 
AND EXTRACT(YEAR FROM time) = EXTRACT(YEAR FROM CURRENT_DATE);', [])->get();

        return $techtalks;
    }
}