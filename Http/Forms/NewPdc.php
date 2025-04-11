<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;
use Models\User;

class NewPdc
{
    protected $errors;

    public function __construct(public array $attributes)
    {
        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Invalid email';
        }

        if (User::findByEmail($attributes['email'])) {
            $this->errors['email'] = 'Email already exists';
        }

        if (!Validator::string($attributes['password'], 8)) {
            $this->errors['password'] = "Password can't be empty or less than 8 characters";
        }

        if (!Validator::string($attributes['name'])) {
            $this->errors['name'] = "Company name can't be empty";
        }

        if (!Validator::string($attributes['mobile'])) {
            $this->errors['mobile'] = "Mobile can't be empty";
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