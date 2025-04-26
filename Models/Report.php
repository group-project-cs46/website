<?php

namespace Models;

use Core\App;
use Core\Database;

class Report
{
    public static function create($sender_id, $subject_id, $filename, $original_name, $description)
    {
        $db = App::resolve(Database::class);
        $db->query('INSERT INTO reports (sender_id, subject_id, filename, original_name, description) VALUES (?, ?, ?, ?, ?)', [
            $sender_id,
            $subject_id,
            $filename,
            $original_name,
            $description
        ]);
        return $db->lastInsertId();
    }   

    public static function findById($id)
    {
        $db = App::resolve(Database::class);
        return $db->query('SELECT * FROM reports WHERE id = ?', [$id])->find();

    }

    public static function getBySenderId($sender_id)
    {
        $db = App::resolve(Database::class);
        return $db->query('SELECT * FROM reports WHERE sender_id = ? ORDER BY description', [$sender_id])->get();
    }

    public static function delete($id)
    {
        $db = App::resolve(Database::class);
        $db->query('DELETE FROM reports WHERE id = ?', [$id]);
    }


}


