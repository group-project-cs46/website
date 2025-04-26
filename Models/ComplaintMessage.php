<?php

namespace Models;

use Core\App;
use Core\Database;

class ComplaintMessage
{
    public static function getAllByComplaintId($complaint_id)
    {
        $db = App::resolve(Database::class);

        return $db->query('
            SELECT 
                complaint_messages.*, 
                users.name AS sender_name
            FROM complaint_messages
            LEFT JOIN users ON complaint_messages.sender_id = users.id
            WHERE complaint_id = ?
            ORDER BY created_at
        ', [$complaint_id])->get();
    }

    public static function create($complaint_id, $sender_id, $message)
    {
        $db = App::resolve(Database::class);

        $db->query('
            INSERT INTO complaint_messages (complaint_id, sender_id, message)
            VALUES (?, ?, ?)
        ', [$complaint_id, $sender_id, $message]);
    }
}