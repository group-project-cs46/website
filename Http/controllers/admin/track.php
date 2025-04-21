<?php

use Models\AddEventStudent;

try {
    $data = AddEventStudent::get_all();
    $eventNo = $data[0]['events_no'] ?? ''; // get the first events_no if available
} catch (Exception $e) {
    die($e->getMessage());
}

view('admins/track.view.php', [
    'STUDENT_data' => $data,
    'EVENT_NO' => $eventNo
]);
