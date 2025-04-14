<?php

use Models\PdcRounds;

// Ensure POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize input
    $roundName = trim($_POST["round_name"] ?? null);
    $startdate = trim($_POST["start_date"] ?? null);
    $enddate = trim($_POST["end_date"] ?? null);

    // Validate fields
    if (!$roundName || !$startdate || !$enddate) {
        die("Error: All fields are required.");
    }

    // Validate date format
    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $startdate) || !preg_match("/^\d{4}-\d{2}-\d{2}$/", $enddate)) {
        die("Error: Invalid date format. Use YYYY-MM-DD.");
    }

    // Create round
    if (PdcRounds::createRound($roundName, $startdate, $enddate)) {
        echo json_encode(["ok" => true, "message" => "Round created successfully"]);
    } else {
        echo json_encode(["ok" => false, "message" => "Failed to create round"]);
    }

    // Redirect after creation
   
}
