<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class CvUpload
{
    protected $errors;

    public function __construct(public array $attributes)
    {
        if (!Validator::file($attributes['cv'], ['pdf'])) {
            $this->errors['cv'] = "Invalid file type or size. Please upload a PDF file.";
        }
        if (!Validator::optionalString($attributes['type'], 1, 255)) {
            $this->errors['type'] = "Type must be a string between 1 and 255 characters.";
        }
    }

    public static function validate($attributes)
    {
        $instance = new static($attributes);

        return $instance->failed() ? $instance->throw() : $instance;
    }

    public function throw()
    {
        ValidationException::throw($this->errors, $this->attributes);
    }

    public function failed()
    {
        return !empty($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }

    public function error($field, $message)
    {
        $this->errors[$field] = $message;
        return $this;
    }
}