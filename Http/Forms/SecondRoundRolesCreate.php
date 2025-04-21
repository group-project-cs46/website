<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class SecondRoundRolesCreate
{
    protected $errors;

    public function __construct(public array $attributes)
    {
        if (!Validator::string($attributes['cv'], 1)) {
            $this->errors['cv'] = 'CV is required';
        }

        if (!Validator::string($attributes['role'], 1)) {
            $this->errors['role'] = 'Role is required';
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