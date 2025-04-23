<?php 

use Models\pdcCompanyvisit;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"] ?? null;

    if ($id) {
        pdcCompanyvisit::delete_visit($id);
        header('Location: /PDC/schedule');
        exit;
        
    }
    
}