<?php

namespace Models;

use Core\App;
use Core\Database;

class PdcAdvertisements
{
    public static function fetchAll()
    {
        $db = App::resolve(Database::class);
        return $db->query('
            SELECT 
                ad.*, 
                users.name AS company_name,users.email AS company_email
            FROM advertisements ad
            JOIN users ON ad.company_id = users.id
            WHERE ad.approved IS NULL
        ', [])->get();
    }

    public static function fetchApproved()
    {
        $db = App::resolve(Database::class);
        return $db->query('
            SELECT 
                ad.*, 
                users.name AS company_name,users.email AS company_email
            FROM advertisements ad
            JOIN users ON ad.company_id = users.id
            WHERE ad.approved = TRUE
        ', [])->get();
    }

    public static function fetchById($id)
    {
        $db = App::resolve(Database::class);
        return $db->query('
            SELECT 
                advertisements.*, 
                users.name AS company_name
            FROM advertisements 
            JOIN users ON advertisements.company_id = users.id
            WHERE advertisements.id = ?
        ', [$id])->find();
    }

    public static function reject($id)
    {
        $db = App::resolve(Database::class);
        $db->query('UPDATE advertisements SET approved = FALSE WHERE id = ?', [$id]);
    }

    public static function approve($id)
    {
        $db = App::resolve(Database::class);
        $db->query('UPDATE advertisements SET approved = TRUE WHERE id = ?', [$id]);
    }
}