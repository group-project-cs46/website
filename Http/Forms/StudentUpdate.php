<?php

namespace Http\Forms;

use Core\BaseForm;
use Core\ValidationException;
use Core\Validator;

class StudentUpdate extends BaseForm
{
    protected function validateAttributes($attributes) : void
    {
        if (!Validator::string($this->attributes['mobile'], 10, 10)) {
            $this->errors['mobile'] = 'Mobile is required and must be 10 digits';
        }
        // bio
        if (!Validator::string($this->attributes['bio'], 1, 255)) {
            $this->errors['bio'] = 'Bio is required and must be less than 255 characters';
        }
        // linkedin
        if (!Validator::string($this->attributes['linkedin'])) {
            $this->errors['linkedin'] = 'LinkedIn is required';
        }
        // website
        if (!Validator::string($this->attributes['website'])) {
            $this->errors['website'] = 'Website is required';
        }
    }
}