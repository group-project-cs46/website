<?php
// Http/controllers/PDC/pdc_create_visit.php

use Models\pdcCompanyvisit;

// Get the POST data
$date = $_POST['date'] ?? null;
$times = $_POST['times'] ?? [];
$companyIds = $_POST['company_ids'] ?? [];

// Validate input
if (!$date || empty($times) || empty($companyIds) || count($times) !== count($companyIds)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid input']);
    exit;
}

try {
    $success = true;
    $results = [];
    
    // Insert visits into the database
    foreach ($companyIds as $index => $companyId) {
        $result = pdcCompanyvisit::create_visit($companyId, $date, $times[$index], 'Scheduled');
        if (!$result) {
            $success = false;
            break;
        }
        $results[] = $result;
    }

    // Respond with success
    echo json_encode(['success' => $success, 'ids' => $results]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Database error: ' . $e->getMessage()]);
}