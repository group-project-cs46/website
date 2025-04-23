<?php

use Models\PdcAdvertisements;

try {
    // Get the advertisement ID from query parameters
    $advertisementId = $_GET['id'] ?? null;

    if ($advertisementId) {
        // Fetch applied students for the specific advertisement
        $appliedStudents = PdcAdvertisements::fetchAppliedStudents($advertisementId);
        echo json_encode([
            'success' => true,
            'data' => $appliedStudents
        ]);
    } else {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Advertisement ID is missing.'
        ]);
    }
} catch (\Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error fetching applied students: ' . $e->getMessage()
    ]);
}

exit;