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
                ts.id AS slot_id, ts.pdc_id, ts.datetime, ts.venue, 
                t.id AS techtalk_id, t.techtalk_slot_id, t.company_id, t.host_name, t.host_email, t.description,
                TO_CHAR(ts.datetime, \'YYYY-MM-DD\') AS date,   
                TO_CHAR(ts.datetime, \'HH12:MI AM\') AS time 
            FROM techtalk_slots ts 
            LEFT JOIN techtalks t ON ts.id = t.techtalk_slot_id;
        ', [])->get();
        return $techtalks;
    }

    public static function insertHostDetails($techtalkSlotId, $companyId, $hostName, $hostEmail, $description)
    {
        $db = App::resolve(Database::class);
        $db->query('INSERT INTO techtalks (techtalk_slot_id, company_id, host_name, host_email, description) VALUES (?,?,?,?,?)', [
            $techtalkSlotId,
            $companyId,
            $hostName,
            $hostEmail,
            $description,
        ]);
        return true;
    }


    public static function updateHostDetails($techtalkId, $hostName, $hostEmail, $description)
    {
        $db = App::resolve(Database::class);
        $db->query('UPDATE techtalks SET host_name = ?, host_email = ?, description = ? WHERE id = ?', [
            $hostName,
            $hostEmail,
            $description,
            $techtalkId,
        ]);
        return true;
    }

    public static function deleteHostDetails($techtalkId)
    {
        $db = App::resolve(Database::class);
        $db->query('DELETE FROM techtalks WHERE id = ?', [
            $techtalkId,
        ]);
        return true;
    }
}
?>