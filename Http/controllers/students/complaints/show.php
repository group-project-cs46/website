<?php

$complaint_id = $_GET['id'];

$complaint = \Models\Complaint::findById($complaint_id);

if ($complaint['complainant_id'] != auth_user()['id']) {
    redirect('/students/complaints');
}

view('students/complaints/show.view.php', [
    'complaint' => $complaint,
]);