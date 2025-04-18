<?php

use Models\AddStudent;
use Core\App;
use Models\User;

$name = $_POST["name"] ?? null;
$indexno = $_POST["indexno"] ?? null;
$regNo = $_POST["regNo"] ?? null;
$email = $_POST["email"] ?? null;
$course = $_POST["course"] ?? null;

if ($name && $indexno && $regNo && $email && $course) {
    User::create(
        [
            'name' => $name,
            'email' => $email,
            'password' => $indexno,
            'role' => 2,
            'approved' => 1,
        ]
    );
    //AddStudent::create_user($name, $email, $password);
    AddStudent::create_student($regNo, $course, $email, $name, $indexno);


    header('Location: /PDC/managestudents');
    exit; // Ensure the script stops after the redirect
} else {
    // Handle missing fields (optional)
    echo "All fields are required.";
    exit;
}
