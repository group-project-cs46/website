<?php

use Models\AddEvents;

$events_no = $_POST['id']; // this matches the <input type="hidden" name="id"> in your form

try {
    AddEvents::delete($events_no);
} catch (\Exception $e) {
    die("Error deleting event: " . $e->getMessage());
}

redirect('/eventmanage');
