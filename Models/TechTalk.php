<?php

namespace Models;

use Core\App;
use Core\Database;

class TechTalk
{
    public static function findForCurrentMonth()
    {
        $db = App::resolve(Database::class);

        $techtalks = $db->query('SELECT * FROM techtalks t
LEFT JOIN techtalk_slots ts ON ts.id = t.techtalk_slot_id
         LEFT JOIN companies c ON t.company_id = c.id
         LEFT JOIN users u ON c.id = u.id
WHERE EXTRACT(MONTH FROM datetime) = EXTRACT(MONTH FROM CURRENT_DATE) 
AND EXTRACT(YEAR FROM datetime) = EXTRACT(YEAR FROM CURRENT_DATE);', [])->get();

        return $techtalks;
    }
}