<?php
namespace Models;

use Core\App;
use Core\Database;

class companyReport
{
    public static function findBySenderId($senderId)
    {
        $db = App::resolve(Database::class);
        return $db->query('
            SELECT r.*, s.index_number 
            FROM reports r 
            LEFT JOIN students s ON r.subject_id = s.id 
            WHERE r.sender_id = ? 
            ORDER BY r.description', 
            [$senderId]
        )->get();
    }

    public static function delete($id)
    {
        $db = App::resolve(Database::class);
        $db->query('DELETE FROM reports WHERE id = ?', [$id]);
    }

    public static function find($id)
    {
        $db = App::resolve(Database::class);
        return $db->query('SELECT * FROM reports WHERE id = ?', [$id])->find();
    }

    public static function create($senderId, $subjectId, $fileName, $originalName, $description)
    {
        $db = App::resolve(Database::class);
        $db->query(
            'INSERT INTO reports (sender_id, subject_id, filename, original_name, description, created_at) 
             VALUES (?, ?, ?, ?, ?, NOW())',
            [
                $senderId,
                $subjectId,
                $fileName,
                $originalName,
                $description
            ]
        );
    }

    public static function getSubjectIdByIndexNumber($indexNumber)
    {
        $db = App::resolve(Database::class);
        $student = $db->query('SELECT id FROM students WHERE index_number = ?', [$indexNumber])->find();
        return $student ? $student['id'] : null;
    }

    public static function findByIndexNumber($indexNumber, $senderId)
    {
        $db = App::resolve(Database::class);
        return $db->query('
            SELECT r.*, s.index_number 
            FROM reports r 
            LEFT JOIN students s ON r.subject_id = s.id 
            WHERE s.index_number = ? AND r.sender_id = ?', 
            [$indexNumber, $senderId]
        )->get();
    }

    // Fixed method to delete all reports for a student by index number (PostgreSQL compatible)
    public static function deleteByIndexNumber($indexNumber, $senderId)
    {
        $db = App::resolve(Database::class);
        $db->query('
            DELETE FROM reports 
            USING students 
            WHERE reports.subject_id = students.id 
            AND students.index_number = ? 
            AND reports.sender_id = ?', 
            [$indexNumber, $senderId]
        );
    }
}