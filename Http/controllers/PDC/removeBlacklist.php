<?php

use Models\pdcBlacklistedcompanies;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    http_response_code(405);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['success' => false, 'message' => 'Invalid JSON payload']);
    http_response_code(400);
    exit();
}

if (!isset($data['company_id'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid request: company_id is required']);
    http_response_code(400);
    exit();
}

try {
    pdcBlacklistedcompanies::unblacklist($data['company_id']);
    echo json_encode(['success' => true, 'message' => 'Company removed from blacklist successfully']);
    http_response_code(200);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Failed to remove company from blacklist: ' . $e->getMessage()]);
    http_response_code(500);
}
exit();