<?php

use Models\AddPdc;
use Core\App;
use Core\Mail;

$name = $_POST['name'];
$email = $_POST['email'];
$employee_id = $_POST['employee_no'];
$title = $_POST['title'];
$contact = $_POST['contact'];
$password = $_POST['password'];

try {
    // Check if email already exists
    if (AddPdc::emailExists($email)) {
        $_SESSION['error_message'] = 'Email already exists! Please use a different email.';
        redirect('/pdcAdd');
        exit;
    }

    // Save PDC user to database
    AddPdc::create($employee_id, $title, $email, $name, $contact, $password);

    // Send welcome email
    $mailer = App::resolve(Mail::class);
    $mailer->send(
        $email,
        'Welcome to PDC Admin Panel',
        "Hi $name,<br><br>Your PDC account has been created.<br><strong>Username:</strong> $email<br><strong>Password:</strong> $password<br><br>You can now log in to the system.<br><br>- Admin Team"
    );

    $_SESSION['success_message'] = 'PDC Account Created Successfully!';
    redirect('/pdcManage');
} catch (\Exception $e) {
    $_SESSION['error_message'] = 'An unexpected error occurred. Please try again.';
    redirect('/pdcAdd');
}
