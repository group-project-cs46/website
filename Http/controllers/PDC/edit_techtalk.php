<?php
use Models\pdc_techtalk;

header('Content-Type: application/json'); // Set JSON response type

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $date = $_POST['date'] ?? null;
    $time = $_POST['time'] ?? null;

    if ($id && $date && $time) {
        $result = pdc_techtalk::edit_techtalks($id, $date, $time);
        if ($result) {
            echo json_encode([
                'success' => true,
                'id' => $id,
                'date' => $date,
                'time' => $time
            ]);
            exit;
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update tech talk slot']);
            exit;
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'ID, date, and time are required']);
        exit;
    }
}

// If not POST, fetch data for the view (GET request)
$techtalk = pdc_techtalk::fetchAll();
view('PDC/Schedule.view.php', [
    'techtalk' => $techtalk,
    'error' => null
]);