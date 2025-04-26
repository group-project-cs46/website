<?php
// Http/controllers/PDC/pdc_edit_visit.php
use Models\pdcCompanyvisit;

$id = intval($_POST["id"] ?? 0);
$date = trim($_POST["date"] ?? '');
$time = trim($_POST["time"] ?? '');

if ($id && $date && $time) {
    try {
        $result = pdcCompanyvisit::edit_visit($id, $date, $time);
        
        echo json_encode([
            'success' => true,
            'message' => 'Visit updated successfully'
        ]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'All fields are required']);
}