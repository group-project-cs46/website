<?php

use Models\User;
use Models\Cv;

$user = User::find($_SESSION['user']['email']);
$cv = Cv::findByUserId($user['id']);

if ($cv) {
    $filePath = base_path('storage/cvs/' . $cv['filename']);
    if (file_exists($filePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    } else {
        dd('file not found');
        // Handle the error, e.g., file not found
        // redirect('/account');
    }
} else {
    dd('CV not found');
    // Handle the error, e.g., CV not found
    // redirect('/account');
}