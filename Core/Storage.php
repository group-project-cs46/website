<?php

namespace Core;

use Models\File;

class Storage
{
    protected static $location = 'storage/';

    static function store($file, $description = '', $isPublic = false)
    {
        $targetDir = base_path(static::$location);
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
                $description,
                $isPublic
            );

        }
        echo "There was an error uploading the file.";
        return null;
    }

    static function delete($id)
    {
        $file = File::getById($id);

        // Define the target directory
        $targetDir = base_path(static::$location);
        $filePath = $targetDir . $file['filename'];

        // Check if the file exists and delete it
        if (file_exists($filePath)) {
            unlink($filePath);
            File::delete($id);
            return $file['id'];
        }

        echo "File not found.";
        return null;
    }
}