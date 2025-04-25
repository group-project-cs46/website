<?php

namespace Http\Forms;

use Core\BaseForm;
use Core\ValidationException;
use Core\Validator;

class AdvertisementUpdate extends BaseForm
{
    protected function validateAttributes($attributes) : void
    {
        if (!Validator::string($this->attributes['internship_role_id'], 1, 255)) {
            $this->error('internship_role_id', 'Internship role is required')->throw();
        }

        if (!Validator::string($this->attributes['responsibilities'], 1, 255)) {
            $this->error('responsibilities', 'Responsibilities are required')->throw();
        }

        if (!Validator::string($this->attributes['qualifications_skills'], 1, 255)) {
            $this->error('qualifications_skills', 'Qualifications skills are required')->throw();
        }

        if (!Validator::string($this->attributes['max_cvs'], 1, 255)) {
            $this->error('max_cvs', 'Max CVs is required')->throw();
        }

        if (!Validator::string($this->attributes['deadline'], 1, 255)) {
            $this->error('deadline', 'Deadline is required')->throw();
        }

        if (!Validator::string($this->attributes['vacancy_count'], 1, 255)) {
            $this->error('vacancy_count', 'Vacancy count is required')->throw();
        }
    }
}
