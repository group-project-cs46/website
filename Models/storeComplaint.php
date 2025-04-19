<?php

namespace Models;

use Core\App;
use Core\Database;
use Exception;

class storeComplaint
{
    public static function create($complaintType, $complaintDescription,$user_id)
    {
        // Validate inputs
        if (!self::isValidComplaintType($complaintType) || empty($complaintDescription)) {
            return false; // invalid complaint data
        }

        $db = App::resolve(Database::class);

        try {
            // Insert the complaint data into the database
            $db->query('INSERT INTO complaints (complaint_type, complaint_description,user_id) VALUES (?, ?,?)', [
                $complaintType,
                $complaintDescription,
                $user_id
            ]);

            return true; // Complaint saved successfully
        } catch (Exception $e) {
            // Log the error or handle it in an appropriate way
            error_log('Error saving complaint: ' . $e->getMessage());
            return false; // Indicate that the complaint could not be saved
        }
    }

    // Helper function to validate complaint type
    private static function isValidComplaintType($complaintType)
    {
        $validComplaintTypes = ['system', 'student'];
        return in_array($complaintType, $validComplaintTypes);
    }
}