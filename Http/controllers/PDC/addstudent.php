<?php

use Core\App;
use Models\AddStudent;
use Core\Mail;

$name = $_POST["name"] ?? null;
$index_number = $_POST["index_number"] ?? null;
$registration_number = $_POST["registration_number"] ?? null;
$email = $_POST["email"] ?? null;
$course = $_POST["course"] ?? null;

if ($name && $index_number && $registration_number && $email && $course) {
    $password = password_hash($index_number, PASSWORD_DEFAULT);
    
    try {
        AddStudent::create_student($registration_number, $course, $email, $name, $index_number, $password);

        $mailer = App::resolve(Mail::class);
        $mailer->send($email, 'Welcome to LaunchPad', 'Your account has been created. Your password is your index number.');

        header('Location: /PDC/managestudents');
        exit;
    } catch (Exception $e) {
        // Display error message as a JavaScript alert
        echo "<script>alert('Error: " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
        exit;
    }
} else {
    echo "<script>alert('All fields are required.'); window.history.back();</script>";
    exit;
}
