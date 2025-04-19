<?php

use Models\companyTechtalk;
use Core\Validator;

// Check if form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $techtalkId = $_POST['techtalk_id'] ?? null;
    $hostName = $_POST['hostName'] ?? null;
    $hostEmail = $_POST['hostEmail'] ?? null;
    $description = $_POST['description'] ?? null;

    // Validate the required fields
    if (empty($techtalkId) || empty($hostName) || empty($hostEmail) || empty($description)) {
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

    // Update host details in the techtalks table
    try {
        companyTechtalk::updateHostDetails($techtalkId, $hostName, $hostEmail, $description);
        $_SESSION['success'] = 'Tech talk details updated successfully';
        header('Location: /company/schedule');
        exit();
    } catch (Exception $e) {
        $_SESSION['error'] = 'Failed to update host details';
        header('Location: /company/schedule');
        exit();
    }
}
?>