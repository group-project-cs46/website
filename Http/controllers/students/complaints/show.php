<?php

use Models\Complaint;
use Models\ComplaintMessage;

$complaint_id = $_GET['id'];

$complaint = Complaint::findById($complaint_id);

if ($complaint['complainant_id'] != auth_user()['id']) {
    redirect('/students/complaints');
}

$complaint_messages = ComplaintMessage::getAllByComplaintId($complaint['id']);

//dd($complaint);

view('students/complaints/show.view.php', [
    'complaint' => $complaint,
    'complaint_messages' => $complaint_messages,
]);