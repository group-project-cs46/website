<?php

use Models\companyComplaint;
use Models\ComplaintMessage;

$complaint_id = $_GET['id'];

$userId = auth_user()['id'];

// Fetch the complaint
$complaint = companyComplaint::getUserComplaints($userId);
$complaint = array_filter($complaint, fn($c) => $c['id'] == $complaint_id);
$complaint = reset($complaint);

if (!$complaint || $complaint['complainant_id'] != $userId) {
    redirect('/company/complaint');
}

// Fetch the messages for this complaint
$complaint_messages = ComplaintMessage::getAllByComplaintId($complaint_id);

// Render the view
view('company/show.view.php', [
    'complaint' => $complaint,
    'complaint_messages' => $complaint_messages,
]);