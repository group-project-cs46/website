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

if (!isset($data['reason']) || trim($data['reason']) === '') {
    echo json_encode(['success' => false, 'message' => 'Invalid request: reason is required']);
    http_response_code(400);
    exit();
}

try {
    pdcBlacklistedcompanies::blacklistCompany($data['company_id'], trim($data['reason']));
    echo json_encode(['success' => true, 'message' => 'Company blacklisted successfully']);
    http_response_code(200);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Failed to blacklist company: ' . $e->getMessage()]);
    http_response_code(500);
}
exit();