<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class ChangePassword
{
    protected $errors;

    public function __construct(public array $attributes)
    {
        if (!Validator::string($attributes['current_password'])) {
            $this->errors['current_password'] = 'Current password is required';
        }

        if (!Validator::string($attributes['password'])) {
            $this->errors['password'] = 'Password is required';
        }

        if (!Validator::string($attributes['confirm_password'])) {
            $this->errors['confirm_password'] = 'Confirm password is required';
        }

        if (!Validator::string($attributes['password'], 8)) {
            $this->errors['password'] = "Password can't be empty or less than 8 characters";
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