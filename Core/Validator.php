<?php

namespace Core;

class Validator
{
    public static function string($value, $min = 1, $max = INF)
    {
        $value = trim($value);
        return $min <= strlen($value) && strlen($value) <= $max;
    }

    public static function email(string $value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function file($file, $allowedExtensions = [], $maxSize = INF)
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        $fileSize = $file['size'];
        $fileNameCmps = explode(".", $file['name']);
        $fileExtension = strtolower(end($fileNameCmps));

        if (!in_array($fileExtension, $allowedExtensions)) {
            return false;
        }

        if ($fileSize > $maxSize) {
            return false;
        }

        return true;
    }
}