<?php

use Core\Session;
use Models\AdminComplaint;
use Models\ComplaintMessage;


$complaint_id = $_POST['complaint_id'];
$message = $_POST['message'];

$complaint = AdminComplaint::findById($complaint_id);

$auth_user = auth_user();

// dd([
//     'auth_user_id' => $auth_user['id'],
//     'complainant_id' => $complaint['complainant_id'],
//     'auth_user' => $auth_user
// ]);

// if ($complaint['complainant_id'] != $auth_user['id']) {
// //    Session::flash('toast', 'You are not allowed to send a message to this complaint.');
//     dd("You are not allowed to send a message to this complaint.");
//     redirect(urlBack());
// }

if ($complaint['complainant_id'] != $auth_user['id'] && $auth_user['role'] != 1) {
    dd("You are not allowed to send a message to this complaint.");
    redirect(urlBack());
}


ComplaintMessage::create($complaint_id, $auth_user['id'], $message);

// If current status is "pending" and user is admin, update to "inreview"
// if ($auth_user['role'] == 1 && $complaint['status'] === 'pending')

// // dd($complaint['status']) ;
// {
//     AdminComplaint::updateStatus($complaint_id, 'inreview');

// }


redirect(urlBack());




