<?php 

use Models\AddStudent;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["student_id"] ?? null;

    if ($id) {
        AddStudent::delete_student($id);
        header('Location: /PDC/managestudents');
        exit;
        
    }
    
}