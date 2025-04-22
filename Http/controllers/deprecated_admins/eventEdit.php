<?php

use Models\AddEvents;

$event_no = $_GET['id'] ?? null;

if (!$event_no) {
    die('Event ID not specified');
}

$event = AddEvents::get_by_no($event_no);

if (!$event) {
    die('Event not found');
}

view('admin/eventEdit.view.php', ['event' => $event]);

