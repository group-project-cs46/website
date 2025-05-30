<?php

use Core\App;
use Core\Database;
use Core\Session;
use Http\Forms\ResetPassword;

$db = App::resolve(Database::class);

$file = $_FILES['file'];

// Define the target directory
$targetDir = base_path('public/assets/photos/');

// Get file details
$fileTmpPath = $file['tmp_name'];
$fileName = $file['name'];
$fileNameCmps = explode(".", $fileName);
$fileExtension = strtolower(end($fileNameCmps));

// Sanitize and hash file name
$newFileName = md5(time() . $fileName) . '.' . $fileExtension;

$targetFile = $targetDir . $newFileName;

$user = auth_user();

//$existingCv = Cv::findByUserId($user['id']);
//dd($existingCv);
//if ($existingCv) {
//    $existingFilePath = $targetDir . $existingCv['filename'];
//    if (file_exists($existingFilePath)) {
//        unlink($existingFilePath);
//    }
//    Cv::update($existingCv['id'], $newFileName);
//} else {
//}

// Move the uploaded file to the target directory
if (move_uploaded_file($fileTmpPath, $targetFile)) {
    $db->query('UPDATE users SET photo = ? WHERE id = ?', [$newFileName, $user['id']]);
    $user = auth_user();
    Session::sessionUserRefresh($user);
} else {
    $form->error('file', 'Failed to update the profile photo.')->throw();
}

redirect('/account');

