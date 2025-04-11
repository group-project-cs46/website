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

        return $db->query('SELECT * FROM companies LEFT JOIN users ON users.id = companies.id', [])->get();
    }

    public static function byRoundId($roundId)
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT companies.*, users.name FROM companies JOIN advertisements ON companies.id = advertisements.company_id LEFT JOIN users ON users.id = companies.id WHERE advertisements.round_id = ?', [$roundId])->get();
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