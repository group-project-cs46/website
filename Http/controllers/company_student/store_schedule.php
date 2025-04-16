<?php

use Models\companyStudent;

$applicationId = $_POST['application_id'] ?? null;
$venue = $_POST['venue'] ?? null;
$date = $_POST['date'] ?? null;
$fromTime = $_POST['from_time'] ?? null;
$toTime = $_POST['to_time'] ?? null;

// Basic validation
if (!$applicationId || !$venue || !$date || !$fromTime || !$toTime) {
    die("Invalid input data.");
}

// Call the model method to store the interview schedule
companyStudent::scheduleInterview($applicationId, $venue, $date, $fromTime, $toTime);

// Redirect back to the list page
header('location: /company/list');
die();