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
        $_SESSION['error_message'] = 'Email address already exists!';
        redirect('/pdcAdd');
    }

    // Check if employee number already exists
    if (AddPdc::employeeNoExists($employee_id)) {
        $_SESSION['error_message'] = 'Employee Number already exists!';
        redirect('/pdcAdd');
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

    // Set success message
    $_SESSION['success_message'] = 'PDC Account created successfully!';

} catch (\Exception $e) {
    die("Error: " . $e->getMessage());
}

// Redirect to the PDC management page
redirect('/pdcManage');
