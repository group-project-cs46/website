<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class Register
{
    protected $errors;

    public function __construct(public array $attributes)
    {
        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Invalid email';
        }

        if (!Validator::string($attributes['password'])) {
            $this->errors['password'] = "Password can't be empty";
        }

        if (!Validator::string($attributes['name'])) {
            $this->errors['name'] = "Company name can't be empty";
        }

        if (!Validator::string($attributes['building'])) {
            $this->errors['building'] = "Building can't be empty";
        }

        if (!Validator::string($attributes['street_name'])) {
            $this->errors['street_name'] = "Street name can't be empty";
        }

        if (!Validator::string($attributes['city'])) {
            $this->errors['city'] = "City can't be empty";
        }

        if (!Validator::string($attributes['postal_code'])) {
            $this->errors['postal_code'] = "Postal code can't be empty";
        }

        if (!Validator::url($attributes['website'])) {
            $this->errors['website'] = 'Invalid website';
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