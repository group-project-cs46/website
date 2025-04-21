<?php

use Models\TrainingSession;

// Get form data
$id = $_POST['id'];
$name = $_POST['name'];
$date = $_POST['date'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$place = $_POST['place'];

try {
    if (!$id) {
        throw new Exception("Training session ID is required for update.");
    }

    // Call the model's update method
    TrainingSession::update($id, $name, $date, $start_time, $end_time, $place);
} catch (\Exception $e) {
    die($e->getMessage());
}

// Redirect after update
redirect('/trainingSession');
