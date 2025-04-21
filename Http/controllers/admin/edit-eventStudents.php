<?php

use Models\AddEventStudent;

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$student_id = $_POST['student_no'];
$contact = $_POST['contact'];
$title = $_POST['title'];
$password = $_POST['password'];
$course = $_POST['course'];


try {
    AddEventStudent::update($id, $name, $email, $student_id, $contact, $title, $password, $course);
} catch (Exception $e) {
    die("Update failed: " . $e->getMessage());
}

redirect('/eventStudentsManage');
