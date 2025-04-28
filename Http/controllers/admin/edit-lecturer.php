<?php

use Models\AddLecturer;
use Core\App;
use Core\Mail;

$name = $_POST['name'];
$email = $_POST['email'];
$employee_id = $_POST['employee-no'];
$title = $_POST['title'];
$contact = $_POST['contact'];
$id = $_POST['id'];
$password = $_POST['password'];

try {
    AddLecturer::update($id, $name, $email, $employee_id, $contact, $title, $password);

    // Send welcome email
    $mailer = App::resolve(Mail::class);
    $mailer->send(
        $email,
        'Welcome to PDC Admin Panel',
        "Hi $name,<br><br>Your Lecturer account has been updated.<br><strong>Username:</strong> $email<br><strong>Password:</strong> $password<br><br>You can now log in to the system.<br><br>- Admin Team"
    );

    // Set success message
    $_SESSION['success_message'] = 'Lecturer Account edited successfully!';

} catch (\Exception $e) {
    die($e->getMessage());
}

redirect('/lecturerManage');


