<?php

use Models\TrainingSession;

// CREATE
    $name = $_POST['name'];
    $date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $venue = $_POST['venue'];
    $attendance_code = $_POST['password'];
    
    try {
        TrainingSession::create($name, $date, $start_time, $end_time,  $venue, $attendance_code);
        
    } catch (\Exception $e) {
        die($e->getMessage());
    }
    redirect('/trainingSession');


    


    
