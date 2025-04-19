<?php
namespace Models;

use Core\App;
use Core\Database;
use Exception;

class storeReport
{
    public static function create($companyId, $studentName, $indexNumber, $studentEmail, $reportFiles)
    {
        $db = App::resolve(Database::class);

        try {
            $db->query(
                'INSERT INTO company_student_reports (company_id, student_name, index_number, student_email, report1, report2, report3, report4, report5, report6) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [
                    $companyId,
                    $studentName,
                    $indexNumber,
                    $studentEmail,
                    $reportFiles[0] ?? null,
                    $reportFiles[1] ?? null,
                    $reportFiles[2] ?? null,
                    $reportFiles[3] ?? null,
                    $reportFiles[4] ?? null,
                    $reportFiles[5] ?? null
                ]
            );

            return true;
        } catch (Exception $e) {
            error_log('Error saving report: ' . $e->getMessage());
            return false;
        }
    }
}
?>
