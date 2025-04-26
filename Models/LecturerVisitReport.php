<?php

namespace Models;

use Core\App;
use Core\Database;

class LecturerVisitReport
{
    public static function upload($lecturer_visit_id, $lecturer_id, $company_id, $file, $original_name = 'Company Report', $description = null)
    {
        $db = App::resolve(Database::class);

        // Move uploaded file
        $filename = uniqid('report_') . '.pdf';
        $destination = base_path("public/uploads/reports/{$filename}");

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            throw new \Exception("Failed to upload file.");
        }

        // Insert into reports
        $db->query('INSERT INTO reports(sender_id, subject_id, filename, original_name, description) VALUES (?, ?, ?, ?, ?)', [
            $lecturer_id,
            $company_id,
            $filename,
            $original_name,
            $description
        ]);

        $report_id = $db->getLastInsertedId();

        // Update lecturer_visits with report_id
        $db->query('UPDATE lecturer_visits SET report_id = ? WHERE id = ?', [
            $report_id,
            $lecturer_visit_id
        ]);
    }
}
