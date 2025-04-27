<?php

namespace Http\Forms;

use Core\BaseForm;
use Core\ValidationException;
use Core\Validator;

class LecturerVisitReportStore extends BaseForm
{
    protected function validateAttributes($attributes) : void
    {
        if (!Validator::string($this->attributes['id'])) {
            $this->error('id', 'The id is required.');
        }

        if (!Validator::file($this->attributes['pdf'], ['pdf'])) {
            $this->error('pdf', 'The file is required.');
        }
    }
}