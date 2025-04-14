<?php

namespace Models;

class Interview
{
    public static function getById($id)
    {
        $db = \Core\App::resolve(\Core\Database::class);

        return $db->query('SELECT * FROM interviews WHERE id = ?', [$id])->find();
    }
}