<?php

use Core\Session;
use Http\Forms\SecondRoundRolesCreate;
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

redirect('/students/second_round');