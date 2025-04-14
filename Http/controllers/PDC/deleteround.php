<?php

use Models\PdcRounds;

// Ensure POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize input
    $id = trim($_POST["id"] ?? null);

    // Validate ID
    if (!$id) {
        die("Error: Invalid ID.");
    }

    // Delete round
    PdcRounds::deleteRound($id);

    // Redirect after deletion
    header('Location: /dashboard/pdc');
    exit;
}
