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

    public static function delete($id)
    {
        $db = App::resolve(Database::class);

        $db->query('DELETE FROM cvs WHERE id = ?', [$id]);
    }

    public static function find($id)
    {
        $db = App::resolve(Database::class);

        $cv = $db->query('SELECT * FROM cvs WHERE id = ?', [$id])->find();

        return $cv;
    }

    public static function create($userId, $fileName, $originalName, $type)
    {
        $db = App::resolve(Database::class);

        $db->query('INSERT INTO cvs (user_id, filename, original_name, type) VALUES (?, ?, ?, ?)', [
            $userId,
            $fileName,
            $originalName,
            $type
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