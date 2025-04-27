<?php

use Models\LecturerVisitRejectedReason;
use Models\LecturerVisit;

// Get form data
// $lecturer_visit_id = $_GET['leid'] ?? null;
// dd($lecturer_visit_id);
$visitId = $_POST['id'] ;

// $visitId = $_POST['leid'];
// dd(value:$visitId);

$reason = $_POST['venue'];
// dd(value:$reason);
// Insert reject reason
LecturerVisitRejectedReason::create($visitId, $reason);

// Update lecturer_visits to rejected = true
LecturerVisit::setRejected($visitId);

// Redirect after success (example: back to a list page)
header('Location: /Visit');
exit();
