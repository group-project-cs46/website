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

//dd($application['is_second_round']);

if ($application['is_second_round'] === true) {
    Session::flash('toast', 'You cannot delete this application because it is a second round application');
    redirect('/students/applications');
}

Application::delete($id);

redirect('/students/applications');