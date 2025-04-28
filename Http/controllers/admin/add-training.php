<?php

// use Core\Qr;
// use Models\TrainingSession;

// // CREATE
// $name = $_POST['name'];
// $date = $_POST['date'];
// $start_time = $_POST['start_time'];
// $end_time = $_POST['end_time'];
// $venue = $_POST['venue'];
// $attendance_code = $_POST['password'];

// try {
//     $qrcode_id = Qr::generate($attendance_code);
//     TrainingSession::create($name, $date, $start_time, $end_time, $venue, $attendance_code, $qrcode_id);
//     //   dd($qrcode_id);
//     $_SESSION['success_message'] = 'Training session created successfully!';

// } catch (\Exception $e) {
//     die($e->getMessage());
// }

// redirect('trainingSession');
use Core\Qr;
use Models\TrainingSession;

// CREATE
$name = $_POST['name'];
$date = $_POST['date'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$venue = $_POST['venue'];
$attendance_code = $_POST['password'];

try {
    // Check if timeslot is already taken
    if (TrainingSession::isTimeSlotTaken($date, $start_time, $end_time)) {
        $_SESSION['error_message'] = 'Another session already exists at the selected time!';
        redirect('/trainingSessionAdd');
    }

    $qrcode_id = Qr::generate($attendance_code);
    TrainingSession::create($name, $date, $start_time, $end_time, $venue, $attendance_code, $qrcode_id);

    $_SESSION['success_message'] = 'Training session created successfully!';

} catch (\Exception $e) {
    die($e->getMessage());
}

redirect('/trainingSession');


    


    
