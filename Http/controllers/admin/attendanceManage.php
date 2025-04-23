<?php

use Models\TrainingSessionRegistration;

$id = $_GET['id'] ?? null;

// if (!$id) {
//     // Redirect or show error
//     die("Training_Session_ID is required.");
// }

$training = TrainingSessionRegistration::getAllByTrainingId($id); 
// dd($training);// You’ll add this new method below
view("admin/attendanceManage.view.php", [
    'TRAINING' => $training
]);
