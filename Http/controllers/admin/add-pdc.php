<?php

use Models\User;

$name = $_POST['name'];
$email = $_POST['email'];
$employee_id = $_POST['lecturerId'];
$title = $_POST['position'];
$contact = $_POST['contact'];
$password = $_POST['password'];

try {
   // Pdc::create($employee_id,$title,$name,$contact,$email);
   User::create(
    [
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'role' => 2,
        'approved' => 1,
    ]
);
} catch (\Exception $e) {
    die($e->getMessage());
}

redirect('/pdcManage');
