<?php 

use Models\AddStudent;
<<<<<<< HEAD

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
=======
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
>>>>>>> 257ba5b09c1782f963f8d4a1062b3816ef21c153
}
