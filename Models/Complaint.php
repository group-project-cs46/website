<?php

namespace Models;

use Core\App;
use Core\Database;

class Complaint
{
    public static function getAll()
    {
        $db = App::resolve(Database::class);

        return $db->query('
            SELECT 
                complaints.*, 
                accused.name AS accused_name,
                accused.id AS accused_id,
                complainant.name AS complainant_name
            FROM complaints
            LEFT JOIN users accused ON complaints.accused_id = accused.id
            LEFT JOIN users complainant ON complaints.complainant_id = complainant.id
        ')->get();

    }
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
                accused.name AS accused_name,
                accused.id AS accused_id
            FROM complaints
            LEFT JOIN users accused ON complaints.accused_id = accused.id
            WHERE complainant_id = ?
        ', [$student_id])->get();
    }

    public static function findById($id)
    {
        $db = App::resolve(Database::class);

        return $db->query('
            SELECT
                complaints.*,
                accused.name AS accused_name,
                accused.id AS accused_id,
                complainant.name AS complainant_name
            FROM complaints
            LEFT JOIN users accused ON complaints.accused_id = accused.id
            LEFT JOIN users complainant ON complaints.complainant_id = complainant.id
            WHERE complaints.id = ?
        ', [$id])->find();
    }

    public static function deleteById($id)
    {
        $db = App::resolve(Database::class);

        $db->query('DELETE FROM complaints WHERE id = ?', [$id]);

    }
}