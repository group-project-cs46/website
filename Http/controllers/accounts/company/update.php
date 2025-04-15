<?php

use Http\Forms\CompanyUpdate;
use Models\User;

$form = CompanyUpdate::validate($attributes = [
    'name' => $_POST['name'],
    'mobile' => $_POST['mobile'],
    'bio' => $_POST['bio'],
    'linkedin' => $_POST['linkedin'],
    'website' => $_POST['website'],
    'building' => $_POST['building'],
    'street_name' => $_POST['street_name'],
    'address_line_2' => $_POST['address_line_2'],
    'city' => $_POST['city'],
    'postal_code' => $_POST['postal_code']
]);

User::update([
    'mobile' => $attributes['mobile'],
    'bio' => $attributes['bio'],
    'linkedin' => $attributes['linkedin'],
    'name' => $attributes['name'],
], auth_user()['id']);

redirect('/account');