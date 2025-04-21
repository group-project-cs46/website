<?php

namespace Models;

use Core\App;
use Core\Database;

class AdminComplaintView
{
    public static function getAll()
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT 
                complaints.*, 
                complaint_messages.*,
                complainant.name AS complainant_name,
                accused.name AS accused_name,
                complaint_messages.id AS message_id,
                complaint_messages.message,
                complaint_messages.created_at AS message_created_at,
                sender.name AS sender_name
            FROM complaints
            LEFT JOIN users AS complainant ON complaints.complainant_id = complainant.id
            LEFT JOIN users AS accused ON complaints.accused_id = accused.id
            LEFT JOIN complaint_messages ON complaints.id = complaint_messages.complaint_id
            LEFT JOIN users AS sender ON complaint_messages.sender_id = sender.id'
            )->get();
    }
}
