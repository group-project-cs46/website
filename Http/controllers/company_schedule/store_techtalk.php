<?php

use Models\companyTechtalk;
use Core\Validator;

// Check if form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $techtalkSlotId = $_POST['techid'] ?? null;
    $hostName = $_POST['hostName'] ?? null;
    $hostEmail = $_POST['hostEmail'] ?? null;
    $description = $_POST['description'] ?? null;
    $companyId = auth_user()['id'];  // Assuming the logged-in user has a company ID

    // Validate the required fields
    if (empty($techtalkSlotId) || empty($hostName) || empty($hostEmail) || empty($description)) {
        $_SESSION['error'] = 'All fields are required';
        header('Location: /company/schedule');
        exit();
    }

    // Validate the email format
    if (!filter_var($hostEmail, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Invalid email format';
        header('Location: /company/schedule');
        exit();
    }

    // Insert host details into techtalks table
    try {
        companyTechtalk::insertHostDetails($techtalkSlotId, $companyId, $hostName, $hostEmail, $description);
        $_SESSION['success'] = 'Tech talk details saved successfully';
        header('Location: /company/schedule');
        exit();
    } catch (Exception $e) {
        $_SESSION['error'] = 'Failed to add host details';
        header('Location: /company/schedule');
        exit();
    }
}
?>