<?php

namespace Http\Forms;

use Core\BaseForm;
use Core\ValidationException;
use Core\Validator;

class AdvertisementStore extends BaseForm
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

        // Validate max_cvs: must be a positive number
        if (!Validator::string($this->attributes['max_cvs'], 1, 255)) {
            $this->error('max_cvs', 'Maximum number of resumes is required')->throw();
        }
        $maxCvs = (int)$this->attributes['max_cvs'];
        if ($maxCvs <= 0) {
            $this->error('max_cvs', 'Maximum number of resumes must be a positive number')->throw();
        }

        // Validate deadline: must not be a past date
        $currentDate = new \DateTime(); // Current date
        $deadlineDate = \DateTime::createFromFormat('Y-m-d', $this->attributes['deadline']);
        if (!Validator::string($this->attributes['deadline'], 1, 255)) {
            $this->error('deadline', 'Deadline is required')->throw();
        }
        if ($deadlineDate === false || $deadlineDate < $currentDate) {
            $this->error('deadline', 'Deadline cannot be a past date')->throw();
        }

        // Validate vacancy_count: must be a positive number
        if (!Validator::string($this->attributes['vacancy_count'], 1, 255)) {
            $this->error('vacancy_count', 'Number of vacancies is required')->throw();
        }
        $vacancyCount = (int)$this->attributes['vacancy_count'];
        if ($vacancyCount <= 0) {
            $this->error('vacancy_count', 'Number of vacancies must be a positive number')->throw();
        }

        if (!Validator::file($this->attributes['file'], ['jpg', 'jpeg', 'png', 'webp'])) {
            $this->error('file', 'An image is required')->throw();
        }
    }
}