<?php
use Models\companyReport;

$index_number = $_POST['index_number'] ?? null;
$user_id = auth_user()['id'] ?? null;

if (!$index_number || !$user_id) {
    redirect('/company/report?error=Invalid request');
}

// Delete the report for the student
companyReport::deleteByIndexNumber($index_number, $user_id);

redirect('/company/report?success=Report for student ' . urlencode($index_number) . ' deleted successfully');