<?php

namespace Models;

use Core\App;
use Core\Database;
use Exception;

class companyComplaint
{
    // Helper method to get the authenticated company_id
    private static function getCompanyId()
    {
        $auth_user = auth_user();
        if (!$auth_user || !isset($auth_user['id'])) {
            throw new Exception('User not authenticated or company_id not found');
        }
        return $auth_user['id'];
    }

    public static function create($complaintType, $subject, $complaintDescription, $complainantId, $indexNo = null)
    {
        date_default_timezone_set('Asia/Colombo');

        if (!self::isValidComplaintType($complaintType)) {
            throw new Exception("Invalid complaint type. Must be 'system' or 'student'.");
        }
        if (empty($subject)) {
            throw new Exception("Subject of complaint is required.");
        }
        if (empty($complaintDescription)) {
            throw new Exception("Complaint description is required.");
        }

        // Verify that the complainantId matches the authenticated company
        $company_id = self::getCompanyId();
        if ($complainantId != $company_id) {
            throw new Exception("Unauthorized: Complainant ID does not match the authenticated company.");
        }

        $db = App::resolve(Database::class);

        try {
            $accusedId = 1;
            if ($complaintType === 'student') {
                if (empty($indexNo)) {
                    throw new Exception("Student index number is required for student complaints.");
                }
                $student = $db->query('SELECT id FROM students WHERE index_number = ?', [$indexNo])->find();
                if ($student) {
                    $accusedId = $student['id'];
                } else {
                    throw new Exception("Student with index number '$indexNo' not found.");
                }
            }

            $db->query(
                'INSERT INTO complaints (complainant_id, accused_id, subject, description, complaint_type, created_at) VALUES (?, ?, ?, ?, ?, CURRENT_TIMESTAMP)',
                [
                    $complainantId,
                    $accusedId,
                    $subject,
                    $complaintDescription,
                    $complaintType
                ]
            );

            return true;
        } catch (Exception $e) {
            error_log('Error saving complaint: ' . $e->getMessage());
            throw new Exception($e->getMessage());
        }
    }

    public static function getUserComplaints($userId)
    {
        $db = App::resolve(Database::class);

        // Verify that the userId matches the authenticated company
        $company_id = self::getCompanyId();
        if ($userId != $company_id) {
            throw new Exception("Unauthorized: User ID does not match the authenticated company.");
        }

        try {
            $complaints = $db->query(
                'SELECT c.*, s.index_number 
                 FROM complaints c 
                 LEFT JOIN students s ON c.accused_id = s.id 
                 WHERE c.complainant_id = ? 
                 ORDER BY c.created_at DESC',
                [$userId]
            )->get();

            return $complaints;
        } catch (Exception $e) {
            error_log('Error fetching user complaints: ' . $e->getMessage());
            throw new Exception('Failed to fetch complaints');
        }
    }

    public static function update($id, $complaintType, $subject, $complaintDescription, $indexNo = null)
    {
        date_default_timezone_set('Asia/Colombo');

        if (!self::isValidComplaintType($complaintType)) {
            throw new Exception("Invalid complaint type. Must be 'system' or 'student'.");
        }
        if (empty($subject)) {
            throw new Exception("Subject of complaint is required.");
        }
        if (empty($complaintDescription)) {
            throw new Exception("Complaint description is required.");
        }

        $db = App::resolve(Database::class);

        // Fetch the existing complaint and verify ownership
        $company_id = self::getCompanyId();
        $existingComplaint = $db->query('SELECT * FROM complaints WHERE id = ?', [$id])->find();
        if (!$existingComplaint) {
            throw new Exception("Complaint with ID '$id' not found.");
        }
        if ($existingComplaint['complainant_id'] != $company_id) {
            throw new Exception("Unauthorized: You can only update your own complaints.");
        }

        try {
            $accusedId = 1;
            if ($complaintType === 'student') {
                if (empty($indexNo)) {
                    throw new Exception("Student index number is required for student complaints.");
                }
                $student = $db->query('SELECT id FROM students WHERE index_number = ?', [$indexNo])->find();
                if ($student) {
                    $accusedId = $student['id'];
                } else {
                    throw new Exception("Student with index number '$indexNo' not found.");
                }
            }

            // Remove updated_at from the query
            $db->query(
                'UPDATE complaints 
                 SET complaint_type = ?, subject = ?, description = ?, accused_id = ? 
                 WHERE id = ?',
                [
                    $complaintType,
                    $subject,
                    $complaintDescription,
                    $accusedId,
                    $id
                ]
            );

            return true;
        } catch (Exception $e) {
            error_log('Error updating complaint: ' . $e->getMessage());
            throw new Exception($e->getMessage());
        }
    }

    public static function delete($id)
    {
        $db = App::resolve(Database::class);

        // Verify that the complaint belongs to the authenticated company
        $company_id = self::getCompanyId();
        $existingComplaint = $db->query('SELECT * FROM complaints WHERE id = ?', [$id])->find();
        if (!$existingComplaint) {
            throw new Exception("Complaint with ID '$id' not found.");
        }
        if ($existingComplaint['complainant_id'] != $company_id) {
            throw new Exception("Unauthorized: You can only delete your own complaints.");
        }

        try {
            $db->query('DELETE FROM complaints WHERE id = ?', [$id]);
            return true;
        } catch (Exception $e) {
            error_log('Error deleting complaint: ' . $e->getMessage());
            throw new Exception('Failed to delete complaint');
        }
    }

    private static function isValidComplaintType($complaintType)
    {
        $validComplaintTypes = ['system', 'student'];
        return in_array($complaintType, $validComplaintTypes);
    }
}