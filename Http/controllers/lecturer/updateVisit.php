<?php

use Models\LecturerVisit;
use Core\Redirect;

// Retrieve the visit id from the POST request.
$visitId = $_POST['visit_id'] ?? null;
dd($visitId);
if (!$visitId) {
    // If no visit id is provided, abort or redirect.
    abort(); // or Redirect::to('/lecturers/company-visits');
}

// Optionally, you might load the current visit record to verify its current status.
// $visit = LecturerVisit::getById($visitId);

// Update the status from "pending" to "visited"
LecturerVisit::updateStatus($visitId, 'visited');

// Redirect back to the company visits list (or to a detailed view as needed)
Redirect('/lecturers/Visit');
