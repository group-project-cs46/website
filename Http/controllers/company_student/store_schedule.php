<?php

use Core\Response;
use Models\companyStudent;

// Get the POST data
$applicationId = isset($_POST['application_id']) ? (int)$_POST['application_id'] : null;
$venue = isset($_POST['venue']) ? trim($_POST['venue']) : null;
$date = isset($_POST['date']) ? trim($_POST['date']) : null;
$fromTime = isset($_POST['from_time']) ? trim($_POST['from_time']) : null;
$toTime = isset($_POST['to_time']) ? trim($_POST['to_time']) : null;

if (!$applicationId || !$venue || !$date || !$fromTime || !$toTime) {
    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
    exit;
}

try {
    // Schedule the interview using the companyStudent model
    $interviewId = companyStudent::scheduleInterview($applicationId, $venue, $date, $fromTime, $toTime);

    if ($interviewId) {
        echo json_encode(['success' => true, 'interview_id' => $interviewId]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to schedule interview']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'An error occurred: ' . $e->getMessage()]);
}