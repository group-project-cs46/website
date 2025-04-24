<?php

namespace Models;

use Core\App;
use Core\Database;

class Company
{
    public static function getById($id)
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT * FROM companies WHERE id = ?', [$id])->find();
    }
    public static function all()
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT c.*,users.disabled FROM companies c LEFT JOIN users ON users.id = c.id NOT IN users.disabled = true', [])->get();
    }
    
    public static function fetchapprovedcompanies()
{
    $db = App::resolve(Database::class);

    return $db->query('
        SELECT 
            companies.*, 
            companies.id AS company_id,  -- Explicitly alias companies.id as company_id
            users.name AS company_name,
            users.mobile,
            users.email,
            users.disabled
        FROM companies 
        INNER JOIN users ON users.id = companies.id 
        WHERE users.approved = true 
        
    ', [])->get();
}


    public static function byRoundId($roundId)
    {
        $db = App::resolve(Database::class);

        return $db->query(
            'SELECT DISTINCT companies.*, users.name FROM companies
            LEFT JOIN advertisements ON companies.id = advertisements.company_id
            LEFT JOIN users ON users.id = companies.id WHERE advertisements.round_id = ?',
            [$roundId]
        )->get();
    }

    public static function allWithUser()
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT companies.*, users.approved,users.rejected, users.email, users.mobile, users.name FROM companies JOIN users ON companies.id = users.id', [])->get();
    }

    public static function approve($id)
    {
        $db = App::resolve(Database::class);

        $db->query('UPDATE users SET approved = ? WHERE id = ?', [1, $id]);
    }

    public static function update($id, $attributes)
    {
        $db = App::resolve(Database::class);

        $db->query('UPDATE companies SET website = ?, building = ?, street_name = ?, address_line_2 = ?, city = ?, postal_code = ? WHERE id = ?', [
            $attributes['website'],
            $attributes['building'],
            $attributes['street_name'],
            $attributes['address_line_2'],
            $attributes['city'],
            $attributes['postal_code'],
            $id
        ]);
    }

    public static function reject($id)
    {
        $db = App::resolve(Database::class);

        $db->query('UPDATE users SET rejected = ? WHERE id = ?', [1, $id]);

        
    }
}
