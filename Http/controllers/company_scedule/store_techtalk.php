<?php

use Models\companyTechtalk;
use Core\Validator;

// Check if form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $techtalkSlotId = $_POST['techid'] ?? null;//form ullathu in frontend right side 
    $conductorName = $_POST['conductorName'] ?? null;
    $conductorEmail = $_POST['conductorEmail'] ?? null;
    $description = $_POST['description'] ?? null;
    $companyId = auth_user()['id'];  // Assuming the logged-in user has a company ID

    // Validate the required fields
    if (empty($techtalkSlotId) || empty($conductorName) || empty($conductorEmail) || empty($description)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required']);
        exit();
    }

    // Validate the email format
    if (!filter_var($conductorEmail, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email format']);
        exit();
    }

    // Insert conductor details into techtalks table
    try {
        // Call the insert method from the companyTechtalk model
        companyTechtalk::insertConductorDetails($techtalkSlotId, $companyId, $conductorName, $conductorEmail, $description);

        // Return success response
        header('Location: /company/schedule');
        exit();
    } catch (Exception $e) {
        // Handle any errors that occur during the insert operation
        echo json_encode(['success' => false, 'message' => 'Failed to add conductor details']);
        exit();
    }
}
?>
