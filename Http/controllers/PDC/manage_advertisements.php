<?php

use Models\PdcAdvertisements;
use Models\Notification;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET['action'] ?? 'all';
    if ($action === 'approved') {
        $advertisements = PdcAdvertisements::fetchApproved();
    } else {
        $advertisements = PdcAdvertisements::fetchAll();
    }
    echo json_encode($advertisements);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['approve_id'])) {
        $advertisement = PdcAdvertisements::approve($data['approve_id']);
        
        // Send notification to the company about approval
        if (isset($advertisement['company_id'])) {
            Notification::create(
                $advertisement['company_id'],
                'Advertisement Approved',
                'Your internship advertisement titled' . $advertisement['job_role'] . ' has been approved by the PDC.'
            );
        }
        
        echo json_encode(['success' => true, 'message' => 'Advertisement approved successfully']);
        exit();
    }

    if (isset($data['reject_id']) && isset($data['reason'])) {
        $advertisement = PdcAdvertisements::reject($data['reject_id']);
        
        // Send notification to the company about rejection with reason
        if (isset($advertisement['company_id'])) {
            Notification::create(
                $advertisement['company_id'],
                'Advertisement Rejected',
                'Your internship advertisement titled ' . $advertisement['job_role'] . ' was rejected. Reason: ' . $data['reason']
            );
        }
        
        // TODO: Store or log the rejection reason if needed
        echo json_encode(['success' => true, 'message' => 'Advertisement rejected successfully']);
        exit();
    }

    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit();
}
