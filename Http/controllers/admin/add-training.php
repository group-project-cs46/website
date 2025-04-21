<?php

use Models\TrainingSession;

// CREATE
    $name = $_POST['name'];
    $date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $place = $_POST['place'];
    
    try {
        TrainingSession::create($name, $date, $start_time, $end_time,  $place);
        
    } catch (\Exception $e) {
        die($e->getMessage());
    }
    redirect('/trainingSession');


    


    
