<?php

use Core\Session;
use Models\Cv;
use Models\Application;


//dd($_POST);
$cv_id = $_POST['id'];
$cv = Cv::find($cv_id);

// check if cv is beign used by any application
$cvApplications = Application::getByCvId($cv_id);

if (count($cvApplications) > 0) {
    Session::flash('toast', 'This CV is being used by an application and cannot be deleted');
} else if ($cv) {
    // Define the target directory
    $targetDir = base_path('storage/cvs/');
    $filePath = $targetDir . $cv['filename'];

    // Check if the file exists and delete it
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    // Delete the CV record from the database
    Cv::delete($cv['id']);
}

redirect('/students/cvs');