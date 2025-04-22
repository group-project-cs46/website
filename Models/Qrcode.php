<?php

namespace Models;

use Core\App;
use Core\Database;

class Qrcode
{
    public static function create($data, $filename)
    {
        $db = App::resolve(Database::class);

        return $db->query('INSERT INTO qrcodes (data, filename) VALUES (?, ?) RETURNING id', [
            $data,
            $filename
        ])->fetchColumn();
    }

    public static function find($id)
    {
        $db = App::resolve(Database::class);

        return $db->query('
            SELECT
                qrcodes.*,
                training_sessions.name AS training_session_name
            FROM qrcodes
            LEFT JOIN training_sessions ON training_sessions.qrcode_id = qrcodes.id
            WHERE qrcodes.id = ?
        ', [$id])->find();
    }

}