<?php

namespace Models;

use Core\App;
use Core\Database;

class Cv
{
    public static function findByUserId($id)
    {
        $db = App::resolve(Database::class);


        $cv = $db->query('SELECT * FROM cvs WHERE user_id = ?', [$id])->find();

        return $cv;
    }

    public static function create($userId, $fileName)
    {
        $db = App::resolve(Database::class);

        $db->query('INSERT INTO cvs (user_id, filename) VALUES (?, ?)', [
            $userId,
            $fileName,
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