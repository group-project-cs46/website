<?php

use Core\Session;
use Models\Qrcode;

//dd('cv show');

$qrcode_id = $_GET['id'];

$qrcode = Qrcode::find($qrcode_id);

$auth_user = auth_user();

//dd($auth_user);

if ($auth_user['id'] !== 1) {
    Session::flash('toast', 'You are not authorized to view this QR code.');
    redirect('/');
}

if ($qrcode) {
    $filePath = base_path('storage/' . $qrcode['filename']);
//    $originalName = $cv['original_name'];

    if (file_exists($filePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $qrcode['training_session_name'] . '.png' . '"');
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
    dd('QR not found');
    // Handle the error, e.g., CV not found
    // redirect('/account');
}