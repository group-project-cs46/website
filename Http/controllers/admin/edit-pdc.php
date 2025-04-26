<?php

// use Models\AddPdc;

// $name = $_POST['name'];
// $email = $_POST['email'];
// $employee_id = $_POST['employee-no'];
// $title = $_POST['title'];
// $contact = $_POST['contact'];
// $id = $_POST['id'];
// $password = $_POST['password'];
// $current_image = $_POST['current_image'];
// $photo = null;

// $file = $_FILES['profile_image'] ?? null;
// if ($file) {
//     $uploads_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/photos';
//     if (!is_dir($uploads_dir) || !is_writable($uploads_dir)) {
//         die("Failed to upload profile image due to an error: uploads_dir is not writable");
//     }

//     if ($current_image) {
//         $img =   "$uploads_dir/$current_image";
//         unlink($img);
//     }

//     $tmp_name = $file["tmp_name"];

//     $file_name = md5($employee_id) . "." . pathinfo($file['name'], PATHINFO_EXTENSION);
//     if (!move_uploaded_file($tmp_name, "$uploads_dir/$file_name")) {
//         die("Failed to upload profile image due to an error: " . $_FILES["profile_image"]["error"]);
//     }

//     $photo = $file_name;
// }

// try {
//     AddPdc::update($id, $name, $email, $employee_id, $contact, $title, $password, $photo);
// } catch (\Exception $e) {
//     die($e->getMessage());
// }

// redirect('/pdcManage');

use Models\AddPdc;
use Core\App;
use Core\Mail; // ✅ Import Mail class

$name = $_POST['name'];
$email = $_POST['email'];
$employee_id = $_POST['employee-no'];
$title = $_POST['title'];
$contact = $_POST['contact'];
$id = $_POST['id'];
$password = $_POST['password'];
$current_image = $_POST['current_image'];
$photo = null;

$file = $_FILES['profile_image'] ?? null;
if ($file) {
    $uploads_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/photos';
    if (!is_dir($uploads_dir) || !is_writable($uploads_dir)) {
        die("Failed to upload profile image due to an error: uploads_dir is not writable");
    }

    if ($current_image) {
        $img = "$uploads_dir/$current_image";
        if (file_exists($img)) {
            unlink($img); // ✅ Delete old image if it exists
        }
    }

    $tmp_name = $file["tmp_name"];
    $file_name = md5($employee_id) . "." . pathinfo($file['name'], PATHINFO_EXTENSION);
    if (!move_uploaded_file($tmp_name, "$uploads_dir/$file_name")) {
        die("Failed to upload profile image due to an error: " . $_FILES["profile_image"]["error"]);
    }

    $photo = $file_name;
}

try {
    // ✅ Update PDC profile in database
    AddPdc::update($id, $name, $email, $employee_id, $contact, $title, $password, $photo);

    // ✅ Send welcome/update email
    $mailer = App::resolve(Mail::class);
    $mailer->send(
        $email,
        'Your PDC Account Has Been Created or Updated',
        "Hello $name,<br><br>Your PDC account has been created or updated.<br> <strong>Username:</strong> $email<br>
                                                                               <strong>Password:</strong> $password<br>
                                                                               <strong>Password:</strong> $employee_id<br><br>You can now log in to the system.<br><br>Regards,<br>PDC Admin Team"
    );
} catch (\Exception $e) {
    die("Error: " . $e->getMessage());
}

// ✅ Redirect after successful update
redirect('/pdcManage');
