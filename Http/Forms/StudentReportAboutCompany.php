<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;
use Models\Report;

class StudentReportAboutCompany
{
    protected $errors;

    public function __construct(public array $attributes)
    {
        if (!Validator::file($attributes['pdf'], ['pdf'])) {
            $this->errors['pdf'] = "Invalid file type or size. Please upload a PDF file.";
        }
        if (!Validator::string($attributes['month'])) {
            $this->errors['month'] = "Month is required.";
        }


        $reports = Report::getBySenderId(auth_user()['id']);
        $months = array_map(fn($report) => $report['description'], $reports);
        if (in_array($attributes['month'], $months)) {
            $this->errors['month'] = "You have already submitted a report for this month.";
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