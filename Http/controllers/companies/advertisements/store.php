<?php


//internship_role_id
//responsibilities
//qualifications_skills
//max_cvs
//deadline
//vacancy_count
//file

use Core\Session;
use Core\Storage;
use Http\Forms\AdvertisementStore;
use Models\Ad;
use Models\Batch;

$form = AdvertisementStore::validate($attributes = [
    'internship_role_id' => $_POST['internship_role_id'] ?? null,
    'responsibilities' => $_POST['responsibilities'] ?? null,
    'qualifications_skills' => $_POST['qualifications_skills'] ?? null,
    'max_cvs' => $_POST['max_cvs'] ?? null,
    'deadline' => $_POST['deadline'] ?? null,
    'vacancy_count' => $_POST['vacancy_count'] ?? null,
    'file' => $_FILES['file'] ?? null,
]);


$currentBatch = Batch::currentBatch();
if (!$currentBatch) {
    Session::flash('toast', "Can't create advertisement. No batch found.");
    redirect('/companies/advertisements');
}
$auth_user = auth_user();

$photo_id = Storage::store($attributes['file'], isPublic: true);

Ad::create(
    $attributes['internship_role_id'],
    $attributes['responsibilities'],
    $attributes['qualifications_skills'],
    $attributes['max_cvs'],
    $attributes['deadline'],
    $attributes['vacancy_count'],
    $photo_id,
    $currentBatch['id'],
    $auth_user['id']
);


redirect('/companies/advertisements');

//dd($form);