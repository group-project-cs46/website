<?php

namespace Core;

use Models\File;

class Storage
{
    protected static $location = 'storage/';

    static function store($file, $isPublic, $description = '')
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
                (int)$isPublic
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

    static function download($id)
    {
        $file = File::getById($id);

        if ($file) {
            $filePath = base_path('storage/' . $file['filename']);
            $originalName = $file['original_name'];

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
            }
        } else {
            dd('File not found');
        }

    }
}