<?php

use Core\Authenticator;
use Http\Forms;
use Models\Cv;
use Models\User;

$form = Forms\CvUpload::validate($attributes = [
    'cv' => $_FILES['cv'],
]);

// Define the target directory
$targetDir = base_path('storage/cvs/');

// Get file details
$fileTmpPath = $attributes['cv']['tmp_name'];
$fileName = $attributes['cv']['name'];
$fileNameCmps = explode(".", $fileName);
$fileExtension = strtolower(end($fileNameCmps));

// Sanitize and hash file name
$newFileName = md5(time() . $fileName) . '.' . $fileExtension;

$user = User::find($_SESSION['user']['email']);
//$existingCv = Cv::findByUserId($user['id']);
//dd($existingCv);
//if ($existingCv) {
//    $existingFilePath = $targetDir . $existingCv['filename'];
//    if (file_exists($existingFilePath)) {
//        unlink($existingFilePath);
//    }
//    Cv::update($existingCv['id'], $newFileName);
//} else {
Cv::create($user['id'], $newFileName, $attributes['cv']['name']);
//}

// Define the target file path
$targetFile = $targetDir . $newFileName;

// Move the uploaded file to the target directory
if (move_uploaded_file($fileTmpPath, $targetFile)) {
//    echo "The file has been uploaded successfully.";
} else {
    $form->error('cv', 'The file has not been uploaded.')->throw();
}

//dd($attributes);

redirect('/account');