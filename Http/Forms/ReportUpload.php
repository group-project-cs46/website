<?php
namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class ReportUpload
{
    protected $errors;

    public function __construct(public array $attributes)
    {
        if (!Validator::file($attributes['report'], ['pdf'])) {
            $this->errors['report'] = "Invalid file type or size. Please upload a PDF file.";
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