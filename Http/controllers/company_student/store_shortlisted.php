<?php
use Models\companyStudent;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data
    $json = file_get_contents('php://input');
    
    // Decode the JSON data
    $data = json_decode($json, true);
    
    // Extract the search parameters
    $application_id = isset($data['application_id']) ? $data['application_id'] : '';
    
    if( companyStudent::shortedlistStudent($application_id)){
       
        // Return results as JSON
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    }
    
} else {
    // Not a POST request
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}