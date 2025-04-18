<?php

use Models\companyComplaint;

header('Content-Type: application/json');

try {
    $data = json_decode(file_get_contents('php://input'), true);

    $id = $data['id'] ?? null;
    $complaintType = $data['complaint_type'] ?? null;
    $subject = $data['subject'] ?? null;
    $complaintDescription = $data['complaint_description'] ?? null;
    $indexNo = $data['index_no'] ?? null;

    if (!$id || !$complaintType || !$subject || !$complaintDescription) {
        throw new Exception("Missing required fields.");
    }

    if (companyComplaint::update($id, $complaintType, $subject, $complaintDescription, $indexNo)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to update complaint - unknown error']);
    }
} catch (Exception $e) {
    error_log('Edit complaint error: ' . $e->getMessage());
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}