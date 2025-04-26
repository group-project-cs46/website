<?php

//internship_role_id
//responsibilities
//qualifications_skills
//max_cvs
//deadline
//vacancy_count
//file

use Core\Storage;
use Http\Forms\AdvertisementUpdate;

$advertisement_id = $_POST['id'];

$advertisement = \Models\Ad::getById($advertisement_id);

if ($advertisement['company_id'] !== auth_user()['id']) {
    redirect('/companies/advertisements');
}

$form = AdvertisementUpdate::validate($attributes = [
    'internship_role_id' => $_POST['internship_role_id'],
    'responsibilities' => $_POST['responsibilities'],
    'qualifications_skills' => $_POST['qualifications_skills'],
    'max_cvs' => $_POST['max_cvs'],
    'deadline' => $_POST['deadline'],
    'vacancy_count' => $_POST['vacancy_count'],
    'file' => $_FILES['file'] ?? null,
]);

if ($attributes['file']) {
    $photo_id = Storage::store($attributes['file'], isPublic: true);
    $attributes['photo_id'] = $photo_id;
}

\Models\Ad::update($attributes, $advertisement_id);

redirect('/companies/advertisements');