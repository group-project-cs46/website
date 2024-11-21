<?php


use Core\Validator;
use Models\deleteAd;

// Get the ID of the advertisement to delete from the POST data


if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    try {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'] ?? null;

        if ($id) {
            deleteAd::delete($id);
           
            http_response_code(200);
            echo json_encode(['message' => 'Ad deleted successfully']);
            
            
        } else {
            throw new Exception('Invalid advertisement ID');
        }
    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode(['message' => $e->getMessage()]);
    }
    // header mean redirect 
    
}

