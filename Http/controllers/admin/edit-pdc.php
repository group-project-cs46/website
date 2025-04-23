<?php

use Models\AddPdc;

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
        $img =   "$uploads_dir/$current_image";
        unlink($img);
    }

    $tmp_name = $file["tmp_name"];

    $file_name = md5($employee_id) . "." . pathinfo($file['name'], PATHINFO_EXTENSION);
    if (!move_uploaded_file($tmp_name, "$uploads_dir/$file_name")) {
        die("Failed to upload profile image due to an error: " . $_FILES["profile_image"]["error"]);
    }

    $photo = $file_name;
}

try {
    AddPdc::update($id, $name, $email, $employee_id, $contact, $title, $password, $photo);
} catch (\Exception $e) {
    die($e->getMessage());
}

redirect('/pdcManage');
