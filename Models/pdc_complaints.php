<?php

namespace Models;

use Core\App;
use Core\Database;

class pdc_complaints
{
    public static function fetchAll()
    {
        $db = App::resolve(Database::class);
        return $db->query('
            SELECT 
                c.*, 
                u1.name AS complainant_name, 
                u2.name AS accused_name,
                TO_CHAR(c.created_at, \'YYYY-MM-DD\') AS created_date
            FROM complaints c
            JOIN users u1 ON c.complainant_id = u1.id
            JOIN users u2 ON c.accused_id = u2.id
        ', [])->get();
    }

    public static function fetchById($id)
    {
        $db = App::resolve(Database::class);
        return $db->query('
            SELECT 
                c.*, 
                u1.name AS complainant_name, 
                u2.name AS accused_name
            FROM complaints c
            JOIN users u1 ON c.complainant_id = u1.id
            JOIN users u2 ON c.accused_id = u2.id
            WHERE c.id = ?
        ', [$id])->find();
    }

    public static function rejectcomplaint($id)
    {
        $db = App::resolve(Database::class);
        $db->query('
            UPDATE complaints 
            SET status =  \'rejected\'  
            WHERE id = ?
        ', [$id]);
    }

    public static function complaintsolved($id)
    {
        $db = App::resolve(Database::class);
        $db->query('
            UPDATE complaints 
            SET status =  \'resolved\'  
            WHERE id = ?
        ', [$id]);
    }

    
}
