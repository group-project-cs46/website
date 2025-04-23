<?php

namespace Models;

use Core\App;
use Core\Database;

class AdminComplaint
{
    public static function getall()
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT 
                complaints.*, 
                complainant.name AS complainant_name,
                accused.name AS accused_name
            FROM complaints
            LEFT JOIN users AS complainant ON complaints.complainant_id = complainant.id
            LEFT JOIN users AS accused ON complaints.accused_id = accused.id',[]
            )->get();
    }

    public static function findById($id)
    {
        $db = App::resolve(Database::class);

        return $db->query('
            SELECT 
                complaints.*, 
                complainant.name AS complainant_name,
                accused.name AS accused_name
            FROM complaints
            LEFT JOIN users AS complainant ON complaints.complainant_id = complainant.id
            LEFT JOIN users AS accused ON complaints.accused_id = accused.id
            WHERE complaints.id = ?
        ', [$id])->find();
    }

}
