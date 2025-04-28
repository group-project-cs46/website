<?php

use Models\pdc_complaints;
use Models\ComplaintMessage;

$complaint_id = $_GET['id'];

// Fetch the complaint using pdc_complaints model
$complaint = pdc_complaints::fetchById($complaint_id);

if (!$complaint) {
    // Redirect if complaint not found
    redirect('/PDC/complaints&feedback');
}

// Fetch the messages for this complaint
$complaint_messages = ComplaintMessage::getAllByComplaintId($complaint_id);

// Render the view
view('PDC/show.view.php', [
    'complaint' => $complaint,
    'complaint_messages' => $complaint_messages,
]);

?>