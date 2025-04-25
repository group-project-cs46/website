<?php

namespace Models;

use Core\App;
use Core\Database;

class File
{
    static function create($filename, $originalName, $description)
    {
        $db = App::resolve(Database::class);

        $auth_user = auth_user();

        return $db->query('INSERT INTO files (filename, original_name, description, user_id) VALUES (?, ?, ?, ?) RETURNING id', [
            $filename,
            $originalName,
            $description,
            $auth_user['id']
        ])->fetchColumn();
    }

    static function getById($id)
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT * FROM files WHERE id = ?', [$id])->find();
    }
}