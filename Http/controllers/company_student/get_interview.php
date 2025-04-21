<?php

use Core\Response;
use Models\companyStudent;

// Get the interview_id from the query string
$interviewId = isset($_GET['interview_id']) ? (int)$_GET['interview_id'] : null;

if (!$interviewId) {
    echo json_encode(['success' => false, 'error' => 'Invalid interview ID']);
    exit;
}

try {
    // Fetch interview details using the companyStudent model
    $interview = companyStudent::getInterviewDetails($interviewId);

    if ($interview) {
        $interview['id'] = $interviewId; // Include the interview_id in the response
        echo json_encode(['success' => true, 'interview' => $interview]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Interview not found']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'An error occurred: ' . $e->getMessage()]);
}