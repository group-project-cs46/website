<?php
use Models\companyReport;

$index_number = $_POST['index_number'] ?? null;
$user_id = auth_user()['id'] ?? null;

if (!$index_number || !$user_id) {
    redirect('/company/report?error=Invalid request');
}

// Delete all reports for the student
companyReport::deleteByIndexNumber($index_number, $user_id);

redirect('/company/report?success=All reports for student ' . urlencode($index_number) . ' deleted successfully');