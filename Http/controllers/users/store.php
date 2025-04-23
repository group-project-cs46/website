<?php

use Core\App;
use Core\Database;
use Core\Session;
use Http\Forms\Register;

//dd($_POST);

$form = Register::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password'],
    'name' => $_POST['name'],
    'building' => $_POST['building'],
    'street_name' => $_POST['street_name'],
    'address_line_2' => $_POST['address_line_2'],
    'city' => $_POST['city'],
    'postal_code' => $_POST['postal_code'],
    'website' => $_POST['website'],
]);

$db = App::resolve(Database::class);

//dd($attributes);

$user = $db->query('SELECT * FROM users WHERE email = ?', [$attributes['email']])->find();

if ($user) {
    header('location: /');
    die();
}

$db->query('INSERT INTO users (email, password, role, approved, name) VALUES (?, ?, ?, ?, ?)',
    [$attributes['email'], password_hash($attributes['password'], PASSWORD_DEFAULT), 4, 0, $attributes['name']]);

$lastInsertedId = $db->connection->lastInsertId();

$db->query('INSERT INTO companies (id, building, street_name, address_line_2, city, postal_code, website) VALUES (?, ?, ?, ?, ?, ?, ?)',
    [$lastInsertedId, $attributes['building'], $attributes['street_name'], $attributes['address_line_2'], $attributes['city'], $attributes['postal_code'], $attributes['website']]);

//login([
//    'email' => $attributes['email'],
//    'role' => 4
//]);

Session::flash('toast', 'Account created successfully. Please wait for the admin to approve your account.');
redirect('/');