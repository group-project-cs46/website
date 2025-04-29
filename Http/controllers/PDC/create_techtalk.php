<?php
use Models\pdc_techtalk;
use Core\App;    
use Core\Database; 
use Models\Notification;

header('Content-Type: application/json');
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $date = $_POST['date'] ?? null;
    $time = $_POST['time'] ?? null;
    $venue = $_POST['venue'] ?? null;
    $pdc_id = auth_user()['id'] ?? null; 

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
        $db = App::resolve(Database::class); 
        $id = $db->lastInsertId(); 

       
    $companies = $db->query("SELECT id FROM companies", [])->get();
    foreach ($companies as $company) {
        Notification::create(
            $company['id'], // 
            'Upcoming Tech Talk Scheduled',
            "A new Tech Talk has been scheduled on $date at $time, Venue: $venue.",
            null, 
            date('Y-m-d H:i:s', strtotime('+1 day')) 
        );
    }

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

