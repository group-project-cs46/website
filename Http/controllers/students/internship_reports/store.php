<?php

use Core\Authenticator;
use Core\Session;
use Http\Forms;
use Models\Application;
use Models\Cv;
use Models\Report;
use Models\User;


$form = Forms\StudentReportAboutCompany::validate($attributes = [
    'pdf' => $_FILES['pdf'],
    'month' => $_POST['month']
]);

$sender = auth_user();
$subject = Application::selectedCompanyByStudentId($sender['id']);
if (!$subject) {
    Session::toast('You have not been selected by any company yet.', 'warning');
    redirect('/dashboard/student');
}



// Define the target directory
$targetDir = base_path('storage/');

// Get file details
$fileTmpPath = $attributes['pdf']['tmp_name'];
$fileName = $attributes['pdf']['name'];
$fileNameCmps = explode(".", $fileName);
$fileExtension = strtolower(end($fileNameCmps));

// Sanitize and hash file name
$newFileName = md5(time() . $fileName) . '.' . $fileExtension;

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

// Define the target file path
$targetFile = $targetDir . $newFileName;

// Move the uploaded file to the target directory
if (move_uploaded_file($fileTmpPath, $targetFile)) {
//    echo "The file has been uploaded successfully.";

    Report::create($sender['id'], $subject['id'], $newFileName, $fileName, $attributes['month']);

} else {
    $form->error('pdf', 'The file has not been uploaded.')->throw();
}

//dd($attributes);

redirect('/students/internship_reports');