<?php

use Models\TrainingSession;

$id = $_POST['id']; // this matches the <input type="hidden" name="id"> in your form

try {
    TrainingSession::delete($id);
} catch (\Exception $e) {
    die("Error deleting event: " . $e->getMessage());
}

redirect('/trainingSession');
