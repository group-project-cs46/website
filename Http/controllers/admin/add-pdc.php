<?php

use Models\AddPdc;

$name = $_POST['name'];
$email = $_POST['email'];
$employee_id = $_POST['employee_no'];
$title = $_POST['title'];
$contact = $_POST['contact'];
$password = $_POST['password'];
$photo = null;


// move profile image
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
    AddPdc::create($employee_id, $title, $email, $name, $contact, $password, $photo);
} catch (\Exception $e) {
    die($e->getMessage());
}

redirect('/pdcManage');
