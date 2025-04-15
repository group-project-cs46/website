<?php
use Models\pdc_techtalk;

header('Content-Type: application/json'); // Set JSON response type

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $date = $_POST['date'] ?? null;
    $time = $_POST['time'] ?? null;
<<<<<<< HEAD
    $venue = $_POST['venue'] ?? null; 

    if ($id && $date && $time) {
        $result = pdc_techtalk::edit_techtalks($id, $date, $time, $venue);
=======

    if ($id && $date && $time) {
        $result = pdc_techtalk::edit_techtalks($id, $date, $time);
>>>>>>> 8b4d7493ee0f8e085c8141bffdabd5fb387be66c
        if ($result) {
            echo json_encode([
                'success' => true,
                'id' => $id,
                'date' => $date,
<<<<<<< HEAD
                'time' => $time,
                'venue' => $venue,
=======
                'time' => $time
>>>>>>> 8b4d7493ee0f8e085c8141bffdabd5fb387be66c
            ]);
            exit;
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update tech talk slot']);
            exit;
        }
    } else {
<<<<<<< HEAD
        echo json_encode(['success' => false, 'error' => 'ID, date, time and venue are required']);
=======
        echo json_encode(['success' => false, 'error' => 'ID, date, and time are required']);
>>>>>>> 8b4d7493ee0f8e085c8141bffdabd5fb387be66c
        exit;
    }
}

// If not POST, fetch data for the view (GET request)
$techtalk = pdc_techtalk::fetchAll();
view('PDC/Schedule.view.php', [
    'techtalk' => $techtalk,
    'error' => null
]);