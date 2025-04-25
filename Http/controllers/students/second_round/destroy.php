<?php

use Core\Session;
use Models\Ad;
use Models\Application;
use Models\SecondRoundRole;
use Models\SecondRoundShortlistedStudents;

//dd($_POST);

$second_round_role_id = $_POST['id'];

$second_round_role = SecondRoundRole::getById($second_round_role_id);


$matching_ads = Ad::getByInternshipRoleIdWithoutAlreadyAppliedInTheFirstRound($second_round_role['internship_role_id']);

$delete_allowed = true;
$application_ids_to_be_deleted = [];
foreach ($matching_ads as $ad) {
    $application = Application::findByStudentIdAndAdId(auth_user()['id'], $ad['id']);
    $application_ids_to_be_deleted[] = $application['id'];

    if ($application['interview_id'] !== null) {
        $delete_allowed = false;
        break;
    }
}

if (!$delete_allowed) {
    Session::flash('toast', 'You cannot delete this role because you have already been assigned an interview');
    redirect('/students/second_round');
}

//dd($application_ids_to_be_deleted);

foreach ($application_ids_to_be_deleted as $item) {
    Application::delete($item);
}

SecondRoundRole::delete($second_round_role_id);
Session::flash('toast', 'Selected role deleted successfully');

redirect('/students/second_round');