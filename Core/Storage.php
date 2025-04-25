<?php

namespace Core;

use Models\File;

class Storage
{
    static function store($file, $description = '')
    {

        $targetDir = base_path('storage/');
        $fileTmpPath = $file['tmp_name'];
        $fileName = $file['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Sanitize and hash file name
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        $user = auth_user();

        // Define the target file path
        $targetFile = $targetDir . $newFileName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($fileTmpPath, $targetFile)) {
        //    echo "The file has been uploaded successfully.";
            return File::create(
                $newFileName,
                $fileName,
                $description
            );

        } else {
            // Handle the error
            echo "There was an error uploading the file.";
            return null;
        }

    }
}