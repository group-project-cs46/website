<?php

namespace Http\Forms;

use Core\BaseForm;
use Core\Validator;

class StudentComplaint extends BaseForm
{
    protected function validateAttributes($attributes): void
    {
        if (!Validator::string($attributes['subject'], 1)) {
            $this->error('subject', 'Subject is required');
        }

        if (!Validator::string($attributes['description'], 1)) {
            $this->error('description', 'Description is required');
        }
    }
}
