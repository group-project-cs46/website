<?php

namespace Models;

use Core\App;
use Core\Database;

class Complaint
{
    public static function create($complainant_id, $accused_id, $subject, $description)
    {
        $db = App::resolve(Database::class);

        $db->query('INSERT INTO complaints (complainant_id, accused_id, subject, description) VALUES (?, ?, ?, ?)',
            [$complainant_id, $accused_id, $subject, $description]
        );
    }

    public static function findAllByStudentId($student_id)
    {
        $db = App::resolve(Database::class);

        return $db->query('
            SELECT 
                complaints.*, 
                users.name AS accused_name,
                users.id AS accused_id
            FROM complaints
            LEFT JOIN users ON complaints.accused_id = users.id
            WHERE complainant_id = ?
        ', [$student_id])->get();
    }

    public static function findById($id)
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT * FROM complaints WHERE id = ?', [$id])->find();
    }

    public static function deleteById($id)
    {
        $db = App::resolve(Database::class);

        $db->query('DELETE FROM complaints WHERE id = ?', [$id]);

    }
}