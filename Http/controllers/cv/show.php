<?php

use Models\User;
use Models\Cv;

$cv_id = $_GET['id'];

$cv = Cv::find($cv_id);

if ($cv['user_id'] != auth_user()['id']) {
    redirect('/students/cvs');
}

if ($cv) {
    $filePath = base_path('storage/cvs/' . $cv['filename']);
    $originalName = $cv['original_name'];

    if (file_exists($filePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $originalName . '"');
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