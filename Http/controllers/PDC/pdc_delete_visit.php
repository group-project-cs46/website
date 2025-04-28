<?php 

use Models\pdcCompanyvisit;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"] ?? null;

    header('Content-Type: application/json'); // Important for AJAX to expect JSON

    if ($id) {
        try {
            pdcCompanyvisit::delete_visit($id);
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'No ID provided']);
    }

    exit;
}
?>
