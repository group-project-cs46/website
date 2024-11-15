<?php

namespace Models;

use Core\App;
use Core\Database;

class Cv
{
    public static function findByUserId($id)
    {
        $db = App::resolve(Database::class);


        $cvs = $db->query('SELECT * FROM cvs WHERE user_id = ?', [$id])->get();

        return $cvs;
    }

    public static function create($userId, $fileName, $originalName)
    {
        $db = App::resolve(Database::class);

        $db->query('INSERT INTO cvs (user_id, filename, original_name) VALUES (?, ?, ?)', [
            $userId,
            $fileName,
            $originalName,
        ]);
    }

    public static function update($id, $fileName)
    {
        $db = App::resolve(Database::class);

        $db->query('UPDATE cvs SET filename = ? WHERE id = ?', [
            $fileName,
            $id,
        ]);
    }
}