<?php

use Core\Qr;
use Models\TrainingSession;

$name = $_POST['name'];
$date = $_POST['date'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$venue = $_POST['venue'];
$attendance_code = $_POST['password'];

try {
    if (TrainingSession::isTimeSlotTaken($date, $start_time, $end_time)) {
        $_SESSION['error_message'] = 'Another session already exists at the selected time!';
        redirect('/trainingAdd');
    }

    $qrcode_id = Qr::generate($attendance_code);
    TrainingSession::create($name, $date, $start_time, $end_time, $venue, $attendance_code, $qrcode_id);

    $_SESSION['success_message'] = 'Training session created successfully!';

} catch (\Exception $e) {
    die($e->getMessage());
}

redirect('/trainingSession');


    


    
