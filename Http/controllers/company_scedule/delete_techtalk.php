<?php

use Models\companyTechtalk;

// Check if form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $techtalkId = $_POST['techtalk_id'] ?? null;

    // Validate the required field
    if (empty($techtalkId)) {
        $_SESSION['error'] = 'Tech talk ID is required';
        header('Location: /company/schedule');
        exit();
    }

    // Delete host details from the techtalks table
    try {
        companyTechtalk::deleteHostDetails($techtalkId);
        $_SESSION['success'] = 'Tech talk deleted successfully';
        header('Location: /company/schedule');
        exit();
    } catch (Exception $e) {
        $_SESSION['error'] = 'Failed to delete tech talk';
        header('Location: /company/schedule');
        exit();
    }
}
?>