<?php

namespace Models;

use Core\App;
use Core\Database;

class Company
{
    public static function all()
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT s.*,u.* FROM companies c JOIN users u on c.id = u.id', [])->get();
        
    }

    public static function allWithUser()
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT companies.*, users.approved, users.email, users.mobile, users.name FROM companies JOIN users ON companies.id = users.id', [])->get();
    }

    public static function approve($id)
    {
        $db = App::resolve(Database::class);

        $db->query('UPDATE users SET approved = ? WHERE id = ?', [1, $id]);
    }

    public static function reject($id)
    {
        $db = App::resolve(Database::class);

        $db->query('UPDATE users SET rejected = ? WHERE id = ?', [1, $id]);
    }

}