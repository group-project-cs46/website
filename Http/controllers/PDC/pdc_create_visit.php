<?php
// Http/controllers/PDC/pdc_create_visit.php

use Models\pdcCompanyvisit;

// Get the POST data
$date = $_POST['date'] ?? null;
$times = json_decode($_POST['times'] ?? '[]', true); // Decode JSON string to array
$companyIds = json_decode($_POST['company_ids'] ?? '[]', true); // Decode JSON string to array

// Validate input
if (!$date || empty($times) || empty($companyIds) || count($times) !== count($companyIds)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid input: Date, times, and company IDs are required and must match in count']);
    exit;
}

try {
    $success = true;
    $results = [];
    
    // Insert visits into the database
    foreach ($companyIds as $index => $companyId) {
        $result = pdcCompanyvisit::create_visit($companyId, $date, $times[$index]);
        if (!$result) {
            $success = false;
            break;
        }
        $results[] = $result;
    }

    if ($success) {
        // Respond with success
        echo json_encode([
            'success' => true,
            'message' => 'Visits created successfully',
            'ids' => $results
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'Failed to create one or more visits']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Database error: ' . $e->getMessage()]);
}