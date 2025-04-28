<?php 

use Models\AddStudent;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["student_id"] ?? null;
    $name = $_POST["name"] ?? null;
    $index_number = $_POST["index_number"] ?? null;
    $registration_number = $_POST["registration_number"] ?? null;
    $email = $_POST["email"] ?? null;
    $course = $_POST["course"] ?? null;

    try {
        if ($name && $index_number && $registration_number && $email && $course) {

            // Since it's update, skip ctype_digit validation here

            $password = password_hash($index_number, PASSWORD_DEFAULT);
            AddStudent::update_student($registration_number, $course, $email, $name, $index_number, $id);

            header('Location: /PDC/managestudents');
            exit;

        } else {
            throw new Exception("All fields are required.");
        }
    } catch (Exception $e) {
        echo "<script>alert('Error: " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
        exit;
    }
}
?>
