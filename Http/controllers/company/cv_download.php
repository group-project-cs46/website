<?php

use Models\companyStudent;
use Models\Cv;

$application_id = $_GET['application_id'] ?? null;

if (!$application_id) {
    http_response_code(400);
    dd('Application ID is required');
}

// Fetch the application to get the CV ID and verify company access
$application = companyStudent::getApplicationById($application_id);

if (!$application) {
    http_response_code(404);
    dd('Application not found');
}

// Verify that the application belongs to the company's advertisement
$company_id = auth_user()['id'];
if (!companyStudent::canAccessApplication($application_id, $company_id)) {
    http_response_code(403);
    redirect('/company/students');
}

// Fetch the CV using the cv_id from the application
$cv_id = $application['cv_id'];
$cv = Cv::find($cv_id);

if (!$cv) {
    http_response_code(404);
    dd('CV not found');
}

// Serve the CV file
$filePath = base_path('storage/' . $cv['filename']);
$originalName = $cv['original_name'];

if (file_exists($filePath)) {
    // Set headers for file download
    header('Content-Description: File Transfer');
    header('Content-Type: application/pdf'); // Explicitly set to PDF since we know CVs are PDFs
    header('Content-Disposition: attachment; filename="' . $originalName . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filePath));
    readfile($filePath);
    exit;
} else {
    http_response_code(404);
    dd('CV file not found');
}