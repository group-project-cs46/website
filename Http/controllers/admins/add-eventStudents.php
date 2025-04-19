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
    // Pdc::create($employee_id,$title,$name,$contact,$email);
    // User::create(
    //     [
    //         'name' => $name,
    //         'email' => $email,
    //         'password' => $password,
    //         'role' => 2,
    //         'approved' => 1,
    //     ]
    // );
    AddEventStudent::create($student_id, $title, $email, $name, $contact, $password, $course);
} catch (\Exception $e) {
    die($e->getMessage());
}

redirect('/eventStudentsManage');
