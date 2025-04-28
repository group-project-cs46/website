<?php

use Models\AddLecturer;
use Core\App;
use Core\Mail;

$name = $_POST['name'];
$email = $_POST['email'];
$employee_id = $_POST['employee_no'];
$title = $_POST['title'];
$contact = $_POST['contact'];
$password = $_POST['password'];

try {
    // Save Lecturer user to database
    AddLecturer::create($employee_id, $title, $email, $name, $contact, $password);

    // Send welcome email
    $mailer = App::resolve(Mail::class);
    $mailer->send(
        $email,
        'Welcome to Lecturer Admin Panel',
        "Hi $name,<br><br>Your PDC account has been created.<br><strong>Username:</strong> $email<br><strong>Password:</strong> $password<br><br>You can now log in to the system.<br><br>- Admin Team"
    );

    // Set success message
    $_SESSION['success_message'] = 'Lecturer Account created successfully!';

} catch (\Exception $e) {
    die("Error: " . $e->getMessage());
}

// Redirect to the PDC management page
redirect('/lecturerManage');

