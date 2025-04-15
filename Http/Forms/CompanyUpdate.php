<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class CompanyUpdate
{
    protected $errors;

    public function __construct(public array $attributes)
    {
        if (!Validator::string($attributes['name'])) {
            $this->errors['name'] = 'Name is required';
        }
        if (!Validator::string($this->attributes['mobile'])) {
            $this->errors['mobile'] = 'Mobile is required';
        }
        // bio
        if (!Validator::string($this->attributes['bio'])) {
            $this->errors['bio'] = 'Bio is required';
        }
        // linkedin
        if (!Validator::string($this->attributes['linkedin'])) {
            $this->errors['linkedin'] = 'LinkedIn is required';
        }
        // website
        if (!Validator::string($this->attributes['website'])) {
            $this->errors['website'] = 'Website is required';
        }
        // building
        if (!Validator::string($this->attributes['building'])) {
            $this->errors['building'] = 'Building is required';
        }
        // street_name
        if (!Validator::string($this->attributes['street_name'])) {
            $this->errors['street_name'] = 'Street name is required';
        }
//        // address_line_2
//        if (!Validator::string($this->attributes['address_line_2'], min: 0)) {
//            $this->errors['address_line_2'] = 'Address line 2 is required';
//        }
        // city
        if (!Validator::string($this->attributes['city'])) {
            $this->errors['city'] = 'City is required';
        }
        // postal_code
        if (!Validator::string($this->attributes['postal_code'])) {
            $this->errors['postal_code'] = 'Postal code is required';
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