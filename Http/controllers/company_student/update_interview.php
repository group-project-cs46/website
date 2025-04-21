<?php

use Core\Response;
use Models\companyStudent;

// Get the raw POST data
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Validate required fields
$interviewId = isset($data['interview_id']) ? (int)$data['interview_id'] : null;
$venue = isset($data['venue']) ? trim($data['venue']) : null;
$date = isset($data['date']) ? trim($data['date']) : null;
$fromTime = isset($data['from_time']) ? trim($data['from_time']) : null;
$toTime = isset($data['to_time']) ? trim($data['to_time']) : null;

if (!$interviewId || !$venue || !$date || !$fromTime || !$toTime) {
    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
    exit;
}

try {
    // Update the interview details using the companyStudent model
    $result = companyStudent::updateInterview($interviewId, $venue, $date, $fromTime, $toTime);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Interview updated successfully']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to update interview']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'An error occurred: ' . $e->getMessage()]);
}
