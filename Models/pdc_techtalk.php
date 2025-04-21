<?php

namespace Models;

use Core\App;
use Core\Database;

class pdc_techtalk
{
    public static function fetchAll()
    {
        $db = App::resolve(Database::class);
        return $db->query('
            SELECT 
                ts.*, 
                TO_CHAR(ts.datetime, \'YYYY-MM-DD\') AS date,   
                TO_CHAR(ts.datetime, \'HH12:MI AM\') AS time 
            FROM techtalk_slots ts;
        ', [])->get();
    }

    public static function create_techtalk($date, $time, $venue)
    {
        $db = App::resolve(Database::class);
        $datetime = $date . ' ' . $time;

        $pdcID = auth_user()['id'];

        $result = $db->query('INSERT INTO techtalk_slots (datetime, pdc_id, venue) VALUES (?, ? , ?)', [
            $datetime,
            $pdcID,
            $venue
        ]);

        return $result !== false;
    }

    public static function edit_techtalks($id, $date, $time, $venue)
    {
        $db = App::resolve(Database::class);
        $datetime = $date . ' ' . $time;

        return $db->query('UPDATE techtalk_slots SET datetime = ?, venue = ? WHERE id = ?', [
            $datetime,
            $venue,
            $id
        ]);
    }

    public static function delete_techtalk($id)
    {
        $db = App::resolve(Database::class);
        
        return $db->query('DELETE FROM techtalk_slots WHERE id = ?', [
            $id
        ]);
    }
}
