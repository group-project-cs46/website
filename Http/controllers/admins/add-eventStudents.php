<?php

use Models\AddEventStudent;

$name = $_POST['name'];
$email = $_POST['email'];
$student_id = $_POST['student_no'];
$title = $_POST['title'];
$course = $_POST['course'];
$contact = $_POST['contact'];
$password = $_POST['password'];

try {
    AddEventStudent::create($student_id, $title, $email, $name, $contact, $password, $course);
} catch (\Exception $e) {
    die($e->getMessage());
}

redirect('/eventStudentsManage');
