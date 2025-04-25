<?php

use Models\File;

//phpinfo();

$file_id = $_GET['id'] ?? null;

$file = File::getById($file_id);

$auth_user = auth_user();

if ($file['user_id'] !== $auth_user['id']) {
    http_response_code(403);
    echo "You are not authorized to access this file.";
    exit;
}


$targetDir = base_path('storage/');
$filename = $file['filename'];
$filePath = $targetDir . $filename;

if (
    !$filePath ||
    !file_exists($filePath)
) {
    http_response_code(404);
    echo "File not found.";
    exit;
}


// Serve file
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$contentType = finfo_file($finfo, $filePath);
finfo_close($finfo);

header("Content-Type: $contentType");
header('Content-Length: ' . filesize($filePath));
readfile($filePath);
exit;
