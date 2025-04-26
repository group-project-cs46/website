<?php

use Core\Session;
use Core\Storage;
use Models\Ad;
use Models\Application;

$advertisement_id = $_POST['id'];

$advertisement = Ad::getById($advertisement_id);

if ($advertisement['company_id'] !== auth_user()['id']) {
    redirect('/companies/advertisements');
}


$existing_applications = Application::getByAdId($advertisement_id);

if ($existing_applications) {
    Session::flash('toast', 'You cannot delete this advertisement because it has existing applications.');
    redirect('/companies/advertisements');
}

Storage::delete($advertisement['photo_id']);
Ad::delete($advertisement_id);

redirect('/companies/advertisements');