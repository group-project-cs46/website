<?php

use Models\AddLecturer;

$name = $_POST['name'];
$email = $_POST['email'];
$employee_id = $_POST['employee-no'];
$title = $_POST['title'];
$contact = $_POST['contact'];
$id = $_POST['id'];
$password = $_POST['password'];

try {
    AddLecturer::update($id, $name, $email, $employee_id, $contact, $title, $password);
} catch (\Exception $e) {
    die($e->getMessage());
}

redirect('/lecturerManage');


