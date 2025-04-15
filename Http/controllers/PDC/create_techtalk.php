<?php
use Models\pdc_techtalk;
use Core\App;      // Import the App class
use Core\Database; // Import the Database class

header('Content-Type: application/json'); // Set response type to JSON

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle POST data (from form or AJAX)
    $date = $_POST['date'] ?? null;
    $time = $_POST['time'] ?? null;
    $venue = $_POST['venue'] ?? null;
    $pdc_id = auth_user()['id'] ?? null; // Get current user ID

    if (!$date) {
        echo json_encode(['success' => false, 'error' => 'Date is required']);
        exit;
    }
    if (!$time) {
        echo json_encode(['success' => false, 'error' => 'Time is required']);
        exit;
    }
    if (!$venue) {
        echo json_encode(['success' => false, 'error' => 'Venue is required']);
        exit;
    }
    if (!$pdc_id) {
        echo json_encode(['success' => false, 'error' => 'User authentication failed']);
        exit;
    }

    $success = pdc_techtalk::create_techtalk($date, $time, $venue);
    if ($success) {
        $db = App::resolve(Database::class); // Resolve Database instance
        $id = $db->lastInsertId(); // Get the ID of the newly created record
        echo json_encode([
            'success' => true,
            'id' => $id,
            'pdc_id' => $pdc_id,
            'date' => $date,
            'time' => $time,
            'venue' => $venue,
             ]);
        exit;
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to create tech talk slot']);
        exit;
    }
}

// Fetch existing data for display if not a POST request
// $techtalk = pdc_techtalk::fetchAll();
// view('PDC/Schedule.view.php', [
//     'techtalk' => $techtalk,
//     'error' => $error
// ]);