<?php

use Core\Session;
use Models\pdc_complaints;
use Models\ComplaintMessage;

$complaint_id = $_POST['complaint_id'];
$message = $_POST['message'];

// Verify the complaint exists
$complaint = pdc_complaints::fetchById($complaint_id);

if (!$complaint) {
    redirect('/PDC/complaints&feedback');
}

// Get the authenticated PDC user
$auth_user = auth_user();

if (!$auth_user || !isset($auth_user['id'])) {
    redirect('/PDC/complaints&feedback');
}

// Store the message
ComplaintMessage::create($complaint_id, $auth_user['id'], $message);

// Redirect back to the complaint show page
redirect("/PDC/show?id=$complaint_id");

?>