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

<<<<<<< HEAD
    public static function create_techtalk($date, $time, $venue)
=======
    public static function create_techtalk($date, $time)
>>>>>>> 8b4d7493ee0f8e085c8141bffdabd5fb387be66c
    {
        $db = App::resolve(Database::class);
        $datetime = $date . ' ' . $time;

<<<<<<< HEAD
        $pdcID = auth_user()['id'];

        $result = $db->query('INSERT INTO techtalk_slots (datetime, pdc_id, venue) VALUES (?, ? , ?)', [
            $datetime,
            $pdcID,
            $venue
=======
        $result = $db->query('INSERT INTO techtalk_slots (datetime) VALUES (?)', [
            $datetime
>>>>>>> 8b4d7493ee0f8e085c8141bffdabd5fb387be66c
        ]);

        return $result !== false;
    }

<<<<<<< HEAD
    public static function edit_techtalks($id, $date, $time, $venue)
=======
    public static function edit_techtalks($id, $date, $time)
>>>>>>> 8b4d7493ee0f8e085c8141bffdabd5fb387be66c
    {
        $db = App::resolve(Database::class);
        $datetime = $date . ' ' . $time;

<<<<<<< HEAD
        return $db->query('UPDATE techtalk_slots SET datetime = ?, venue = ? WHERE id = ?', [
            $datetime,
            $venue,
=======
        return $db->query('UPDATE techtalk_slots SET datetime = ? WHERE id = ?', [
            $datetime,
>>>>>>> 8b4d7493ee0f8e085c8141bffdabd5fb387be66c
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
