<?php

use Models\AddEvents;

try {
    $data = AddEvents:: get_all();
} catch (Exception $e) {
    die("Error loading events: " . $e->getMessage());
}

view('admin/eventsmanage.view.php', [
    'EVENTS_data' => $data
]);
