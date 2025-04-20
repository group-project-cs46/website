<?php

use Models\AddEvents;

$events_no = $_POST['events-no'];
$competition_name = $_POST['competition-name'];
$date = $_POST['date'];
$time = $_POST['time'];
$deadline_date = $_POST['deadline-date'];
$deadline_time = $_POST['deadline-time'];


try {
    AddEvents::create($events_no, $competition_name, $date, $time, $deadline_date, $deadline_time);
} catch (\Exception $e) {
    die($e->getMessage());
}

redirect('/events');
