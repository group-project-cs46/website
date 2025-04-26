<?php

// use Models\AddPdc;

// $name = $_POST['name'];
// $email = $_POST['email'];
// $employee_id = $_POST['employee_no'];
// $title = $_POST['title'];
// $contact = $_POST['contact'];
// $password = $_POST['password'];
// $photo = null;


// // move profile image
// $file = $_FILES["profile_image"] ?? null;
// if ($file) {
//     $uploads_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/photos';
//     if (!file_exists($uploads_dir)) {
//         mkdir($uploads_dir, 0777, true);
//     }
//     $tmp_name = $file["tmp_name"];
//     if (!is_dir($uploads_dir) || !is_writable($uploads_dir)) {
//         die("Failed to upload profile image due to an error: uploads_dir is not writable");
//     }

//     $file_name = md5($employee_id) . "." . pathinfo($file['name'], PATHINFO_EXTENSION);
//     if (!move_uploaded_file($tmp_name, "$uploads_dir/$file_name")) {
//         die("Failed to upload profile image due to an error: " . $_FILES["profile_image"]["error"]);
//     }
//     $photo = $file_name;
// }


// try {
//     AddPdc::create($employee_id, $title, $email, $name, $contact, $password, $photo);
// } catch (\Exception $e) {
//     die($e->getMessage());
// }

// redirect('/pdcManage');

use Models\AddPdc;
use Core\App;
use Core\Mail; // ✅ Import the Mail class

$name = $_POST['name'];
$email = $_POST['email'];
$employee_id = $_POST['employee_no'];
$title = $_POST['title'];
$contact = $_POST['contact'];
$password = $_POST['password'];
$photo = null;

// ✅ Move profile image if provided
$file = $_FILES["profile_image"] ?? null;
if ($file) {
    $uploads_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/photos';
    if (!file_exists($uploads_dir)) {
        mkdir($uploads_dir, 0777, true);
    }
    $tmp_name = $file["tmp_name"];
    if (!is_dir($uploads_dir) || !is_writable($uploads_dir)) {
        die("Failed to upload profile image due to an error: uploads_dir is not writable");
    }

    $file_name = md5($employee_id) . "." . pathinfo($file['name'], PATHINFO_EXTENSION);
    if (!move_uploaded_file($tmp_name, "$uploads_dir/$file_name")) {
        die("Failed to upload profile image due to an error: " . $_FILES["profile_image"]["error"]);
    }
    $photo = $file_name;
}

try {
    // ✅ Save PDC user to database
    AddPdc::create($employee_id, $title, $email, $name, $contact, $password, $photo);

    // ✅ Send welcome email
    $mailer = App::resolve(Mail::class);
    $mailer->send(
        $email,
        'Welcome to PDC Admin Panel',
        "Hi $name,<br><br>Your PDC account has been created.<br><strong>Username:</strong> $email<br><strong>Password:</strong> $password<br><br>You can now log in to the system.<br><br>- Admin Team"
    );
} catch (\Exception $e) {
    die("Error: " . $e->getMessage());
}

// ✅ Redirect after success
redirect('/pdcManage');
