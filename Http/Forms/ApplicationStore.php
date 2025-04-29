<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class ApplicationStore
{
    protected $errors;

    public function __construct(public array $attributes)
    {

        if (!Validator::string($attributes['ad_id'])) {
            $this->error('ad_id', 'Must select an advertisement');
        }

        if (!Validator::string($attributes['cv_id'])) {
            $this->error('cv_id', 'Must select a CV');
        }

        if (!Validator::number($attributes['rate'], 1,5)) {
            $this->error('rate', "Priority must be from 1 to 5");
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