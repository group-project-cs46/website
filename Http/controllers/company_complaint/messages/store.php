<?php

use Core\Session;
use Models\companyComplaint;
use Models\ComplaintMessage;

$complaint_id = $_POST['complaint_id'];
$message = $_POST['message'];

$complaint = companyComplaint::getUserComplaints(auth_user()['id']);
$complaint = array_filter($complaint, fn($c) => $c['id'] == $complaint_id);
$complaint = reset($complaint);

$auth_user = auth_user();

if (!$complaint || $complaint['complainant_id'] != $auth_user['id']) {
    redirect('/company/complaint');
}

ComplaintMessage::create($complaint_id, $auth_user['id'], $message);

redirect("/company/complaint/show?id=$complaint_id");