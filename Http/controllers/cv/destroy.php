<?php

use Models\Cv;


//dd($_POST);

$cv = Cv::find($_POST['id']);

if ($cv) {
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