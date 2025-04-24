<?php
namespace Models;

use Core\App;
use Core\Database;

class companyReport
{
    // Helper method to get the authenticated company_id
    private static function getCompanyId()
    {
        $auth_user = auth_user();
        if (!$auth_user || !isset($auth_user['id'])) {
            throw new \Exception('User not authenticated or company_id not found');
        }
        return $auth_user['id'];
    }

    public static function findBySenderId($senderId)
    {
        $company_id = self::getCompanyId();
        if ($senderId != $company_id) {
            throw new \Exception('Unauthorized: Sender ID does not match the authenticated company.');
        }

        $db = App::resolve(Database::class);
        return $db->query('
            SELECT r.*, s.index_number 
            FROM reports r 
            LEFT JOIN students s ON r.subject_id = s.id 
            WHERE r.sender_id = ? 
            ORDER BY r.created_at DESC', 
            [$senderId]
        )->get();
    }

    public static function delete($id)
    {
        $db = App::resolve(Database::class);

        // Verify that the report belongs to the authenticated company
        $company_id = self::getCompanyId();
        $report = $db->query('SELECT * FROM reports WHERE id = ?', [$id])->find();
        if (!$report) {
            throw new \Exception("Report with ID '$id' not found.");
        }
        if ($report['sender_id'] != $company_id) {
            throw new \Exception("Unauthorized: You can only delete your own reports.");
        }

        $db->query('DELETE FROM reports WHERE id = ?', [$id]);
    }

    public static function find($id)
    {
        $db = App::resolve(Database::class);

        // Verify that the report belongs to the authenticated company
        $company_id = self::getCompanyId();
        $report = $db->query('SELECT * FROM reports WHERE id = ?', [$id])->find();
        if (!$report) {
            throw new \Exception("Report with ID '$id' not found.");
        }
        if ($report['sender_id'] != $company_id) {
            throw new \Exception("Unauthorized: You can only view your own reports.");
        }

        return $report;
    }

    public static function create($senderId, $subjectId, $fileName, $originalName, $description)
    {
        $company_id = self::getCompanyId();
        if ($senderId != $company_id) {
            throw new \Exception('Unauthorized: Sender ID does not match the authenticated company.');
        }

        $db = App::resolve(Database::class);

        // Check if a report already exists for this student and company
        $existingReport = $db->query(
            'SELECT * FROM reports WHERE subject_id = ? AND sender_id = ?',
            [$subjectId, $senderId]
        )->find();

        if ($existingReport) {
            // Delete the existing report file
            $existingFilePath = base_path('storage/reports/' . $existingReport['filename']);
            if (file_exists($existingFilePath)) {
                unlink($existingFilePath);
            }
            // Delete the existing report record
            $db->query('DELETE FROM reports WHERE id = ?', [$existingReport['id']]);
        }

        // Insert the new report
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
        $company_id = self::getCompanyId();
        if ($senderId != $company_id) {
            throw new \Exception('Unauthorized: Sender ID does not match the authenticated company.');
        }

        $db = App::resolve(Database::class);
        return $db->query('
            SELECT r.*, s.index_number 
            FROM reports r 
            LEFT JOIN students s ON r.subject_id = s.id 
            WHERE s.index_number = ? AND r.sender_id = ?', 
            [$indexNumber, $senderId]
        )->get();
    }

    public static function deleteByIndexNumber($indexNumber, $senderId)
    {
        $company_id = self::getCompanyId();
        if ($senderId != $company_id) {
            throw new \Exception('Unauthorized: Sender ID does not match the authenticated company.');
        }

        $db = App::resolve(Database::class);
        $reports = $db->query('
            SELECT r.* 
            FROM reports r 
            JOIN students s ON r.subject_id = s.id 
            WHERE s.index_number = ? AND r.sender_id = ?', 
            [$indexNumber, $senderId]
        )->get();

        foreach ($reports as $report) {
            $filePath = base_path('storage/reports/' . $report['filename']);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

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