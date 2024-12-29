<?php 

use Models\AddStudent;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["student_id"] ?? null;
    $name = $_POST["name"] ?? null;
    $indexno = $_POST["indexno"] ?? null;
    $regNo = $_POST["regNo"] ?? null;
    $email = $_POST["email"] ?? null;
    $course = $_POST["course"] ?? null;

    if ($name && $indexno && $regNo && $email && $course) {
        $password = password_hash($indexno, PASSWORD_DEFAULT);
        //AddStudent::create_user($name, $email, $password);
        AddStudent::update_student($regNo, $course, $email, $name, $indexno,$id);
       

        header('Location: /PDC/managestudents');
        exit; // Ensure the script stops after the redirect
    } else {
        // Handle missing fields (optional)
        echo "All fields are required.";
        exit;
    }
}