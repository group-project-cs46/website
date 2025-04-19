<?php

use Models\AddStudent;


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"] ?? null;
    $index_number = $_POST["index_number"] ?? null;
    $registration_number = $_POST["registration_number"] ?? null;
    $email = $_POST["email"] ?? null;
    $course = $_POST["course"] ?? null;

    if ($name && $index_number && $registration_number && $email && $course) {
        $password = password_hash($index_number, PASSWORD_DEFAULT);
        AddStudent::create_student($registration_number, $course, $email, $name, $index_number, $password);
       


    header('Location: /PDC/managestudents');
    exit; // Ensure the script stops after the redirect
} else {
    // Handle missing fields (optional)
    echo "All fields are required.";
    exit;
}
}