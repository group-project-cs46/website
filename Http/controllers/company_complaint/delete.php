<?php

use Models\companyComplaint;

header('Content-Type: application/json');

try {
    $data = json_decode(file_get_contents('php://input'), true);

    $id = $data['id'] ?? null;

    if (!$id) {
        throw new Exception("Complaint ID is required.");
    }

    if (companyComplaint::delete($id)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to delete complaint']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}