<?php

use Core\Session;
use Models\Complaint;

$complaint_id = $_POST['id'];

$complaint = Complaint::findById($complaint_id);


if ($complaint['complainant_id'] != auth_user()['id']) {
    Session::flash('errors', 'You are not authorized to delete this complaint.');
    redirect('/students/complaints');
}

if ($complaint['status'] != 'pending') {
    Session::flash('toast', 'You can only delete pending complaints.');
    redirect('/students/complaints');
}

Complaint::deleteById($complaint_id);
Session::flash('toast', 'Complaint deleted successfully!');
redirect('/students/complaints');