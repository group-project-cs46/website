<?php

use Core\Validator;
use Models\editAd;
 echo dd('er');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Log received POST data
        error_log('Received POST data: ' . json_encode($_POST));

        // Call the edit function with the POST data
        editAd::edit($_POST);

        // Return success response
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'id' => $_POST['id'],
            'job_role' => $_POST['job_role'],
            'vacancy_count' => $_POST['vacancy_count'],
            'deadline' => $_POST['deadline']
        ]);
        exit();
    } catch (Exception $e) {
        // Log the error and return an error response
        error_log('Error editing advertisement: ' . $e->getMessage());
        header('Content-Type: application/json', true, 400);
        echo json_encode(['error' => $e->getMessage()]);
        exit();
    }
}

