<?php

use Models\AdminComplaint;
use Models\ComplaintMessage;

$id = $_GET['id'] ?? null;

if (!$id) {
    // Redirect or show error
    die("Complaint ID is required.");
}

$complaint = AdminComplaint::findById($id); // You’ll add this new method below
$messages = ComplaintMessage::getAllByComplaintId($id);

view("admin/complaintView.view.php", [
    'COMPLAINT' => $complaint,
    'MESSAGES' => $messages
]);
