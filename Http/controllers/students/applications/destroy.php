<?php

use Core\Session;
use Models\Application;

$id = $_POST['id'];

$application = Application::getById($id);

//dd($application);

if ($application['interview_id'] !== null) {
    Session::flash('toast', 'You cannot delete this application because you have already been assigned an interview');
    redirect('/students/applications');
}

Application::delete($id);

redirect('/students/applications');