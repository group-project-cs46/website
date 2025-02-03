<?php
use Core\Validator;
use Models\storeComplaint;

$complaintType = $_POST['complaint_type'] ?? null;
$complaintDescription = $_POST['complaint_description'] ?? null;
$user_id = auth_user()['id'];
print_r($complaintType); 

if ($complaintType && $complaintDescription) {
    // Call the model to store the complaint

    if (storeComplaint::create($complaintType, $complaintDescription,$user_id)) {
        // Redirect to the complaint form or a success page
        header('Location: /company/complaint');
        exit();
    } else {
        // Redirect back to the form with an error
        header('Location: /company/complaint');
        exit();
    }
} else {
    // Redirect back to the form with an error if data is missing
    header('Location: /complaint/form');
    exit();
}
