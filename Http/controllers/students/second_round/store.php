<?php

use Core\Session;
use Http\Forms\SecondRoundRolesCreate;
use Models\Ad;
use Models\Application;
use Models\SecondRoundRole;


$form = SecondRoundRolesCreate::validate($attributes = [
    'cv' => $_POST['cv'],
    'role' => $_POST['role']
]);

$chosen_roles = SecondRoundRole::getAllByStudentId(auth_user()['id']);

if (count($chosen_roles) >= 3) {
    Session::flash('toast', 'You can only choose 3 roles');
    redirect('/students/second_round');
}


SecondRoundRole::create($attributes['role'], auth_user()['id'], $attributes['cv']);


$related_ads = Ad::getByInternshipRoleIdWithoutAlreadyAppliedInTheFirstRound($attributes['role']);

//dd($related_ads);

foreach ($related_ads as $ad) {
    Application::createWithIsSecondRound(auth_user()['id'], $attributes['cv'], $ad['id'], true);
}

//dd($related_ads);

redirect('/students/second_round');