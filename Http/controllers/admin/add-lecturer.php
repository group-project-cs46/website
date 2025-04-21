<?php

use Models\AddLecturer;

$name = $_POST['name'];
$email = $_POST['email'];
$employee_id = $_POST['employee_no'];
$title = $_POST['title'];
$contact = $_POST['contact'];
$password = $_POST['password'];

try {
    AddLecturer::create($employee_id, $title, $email, $name, $contact, $password);
} catch (\Exception $e) {
    die($e->getMessage());
}

redirect('/lecturerManage');
