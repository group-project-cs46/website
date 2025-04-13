<?php

use Models\AddEventStudent;

$name = $_POST['name'];
$email = $_POST['email'];
$employee_id = $_POST['employee_no'];
$title = $_POST['title'];
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
    AddEventStudent::create($employee_id, $title, $email, $name, $contact, $password);
} catch (\Exception $e) {
    die($e->getMessage());
}

redirect('/pdcManage');
