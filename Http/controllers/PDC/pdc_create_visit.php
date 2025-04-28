<?php

use Models\pdcCompanyvisit;

// Get the POST data
$date = $_POST['date'] ?? null;
$times = json_decode($_POST['times'] ?? '[]', true); // Decode JSON string to array
$companyIds = json_decode($_POST['company_ids'] ?? '[]', true); // Decode JSON string to array
$lecturerId = $_POST['lecturer_id'] ?? null;

// Validate input
if (!$date || empty($times) || empty($companyIds) || !$lecturerId || count($times) !== count($companyIds)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid input: Date, times, company IDs, and lecturer ID are required and times must match company IDs in count']);
    exit;
}

try {
    $success = true;
    $results = [];
    
    // Insert visits into the database
    foreach ($companyIds as $index => $companyId) {
        $result = pdcCompanyvisit::create_visit($companyId, $date, $times[$index], $lecturerId);
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