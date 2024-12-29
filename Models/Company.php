<?php

namespace Models;

use Core\App;
use Core\Database;

class Company
{
    public static function all()
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT * FROM companies', [])->get();
    }

    public static function allWithUser()
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT companies.*, users.approved, users.email, users.mobile FROM companies JOIN users ON companies.id = users.id', [])->get();
    }

    public static function approve($id)
    {
        $db = App::resolve(Database::class);

        $db->query('UPDATE users SET approved = ? WHERE id = ?', [1, $id]);
    }

}