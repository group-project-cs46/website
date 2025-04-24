<?php

use Core\Session;
use Models\Complaint;
use Models\ComplaintMessage;


$complaint_id = $_POST['complaint_id'];
$message = $_POST['message'];

$complaint = Complaint::findById($complaint_id);

$auth_user = auth_user();


if ($complaint['complainant_id'] != $auth_user['id']) {
//    Session::flash('toast', 'You are not allowed to send a message to this complaint.');
    dd("You are not allowed to send a message to this complaint.");
    redirect(urlBack());
}

ComplaintMessage::create($complaint_id, $auth_user['id'], $message);

redirect(urlBack());

