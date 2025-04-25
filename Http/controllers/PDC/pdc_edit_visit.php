<?php 

use Models\pdcCompanyvisit;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"] ?? null;
    $date = $_POST["date"] ?? null;
    $time = $_POST["time"] ?? null;
    

    if ($id && $date && $time) {
   
        pdcCompanyvisit::edit_visit($id, $date, $time);
       

        header('Location: /PDC/schedule'); // Redirect to the schedule page after creating the visit
        exit; // Ensure the script stops after the redirect
    } else {
        // Handle missing fields (optional)
        echo "All fields are required.";
        exit;
    }
}