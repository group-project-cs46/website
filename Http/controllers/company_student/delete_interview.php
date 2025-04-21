<?php

use Core\Response;
use Models\companyStudent;

// Get the raw DELETE data
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Validate required fields
$applicationId = isset($data['application_id']) ? (int)$data['application_id'] : null;
$interviewId = isset($data['interview_id']) ? (int)$data['interview_id'] : null;

if (!$applicationId || !$interviewId) {
    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
    exit;
}

try {
    // Delete the interview using the companyStudent model
    $result = companyStudent::deleteInterview($applicationId, $interviewId);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Interview deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to delete interview']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'An error occurred: ' . $e->getMessage()]);
}
