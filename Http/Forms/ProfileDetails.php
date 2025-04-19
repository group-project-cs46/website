<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class ProfileDetails
{
    protected $errors;

    public function __construct(public array $attributes)
    {
        if (!Validator::string($attributes['bio'])) {
            $this->errors['bio'] = 'Bio is required';
        }

        if (!Validator::url($attributes['linkedin'])) {
            $this->errors['linkedin'] = 'LinkedIn Account is required';
        }

        if (!Validator::string($attributes['mobile'])) {
            $this->errors['mobile'] = 'Mobile is required';
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